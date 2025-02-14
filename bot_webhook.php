<?php
include 'config.php';

$token = "7966392487:AAG0OablonMETZEKiZFXSwQAmcmG_x2ZA8o"; // Ganti dengan token bot Anda
$update = json_decode(file_get_contents("php://input"), TRUE);

if ($conn->connect_error) {
    file_put_contents("log.txt", "Koneksi ke database gagal: " . $conn->connect_error . "\n", FILE_APPEND);
}

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $nama = isset($update['message']['chat']['first_name']) ? $update['message']['chat']['first_name'] : "Unknown";
    $text = $update['message']['text'];

    file_put_contents("log.txt", "Pesan diterima: $text\n", FILE_APPEND);

    if (strpos($text, "/start") === 0) {
        $message = "Selamat datang, $nama!\n\nBerikut adalah daftar perintah yang tersedia:\n\n" .
            "✅ <b>/lapor | Nomor HP | Nomor Modem | Deskripsi</b> - Buat laporan gangguan\n" .
            "✅ <b>/cek_ticket | Ticket ID</b> - Cek status laporan\n" .
            "✅ <b>/selesai | Ticket ID</b> - Selesaikan laporan\n\n" .
            "Silakan gunakan perintah sesuai format yang diberikan.";
        sendMessage($chat_id, $message);
        exit;
    }

    // Pecah teks berdasarkan "|"
    $data = explode("|", trim($text));

    if (count($data) < 4 || strpos($text, "/lapor") !== 0) {
        sendMessage($chat_id, "Format salah! Gunakan: /lapor | Nomor HP | Nomor Modem | Deskripsi\nContoh: /lapor | 082236816460 | 2232324343 | Jaringan tidak dapat digunakan.");
        exit;
    }

    // Bersihkan input dengan trim dan hapus hanya spasi
    $nomor_hp = isset($data[1]) ? trim($data[1]) : '';
    $nomor_modem = isset($data[2]) ? trim($data[2]) : '';
    $deskripsi = isset($data[3]) ? trim($data[3]) : '';

    // Hapus karakter selain angka tetapi tetap mempertahankan format yang benar
    $nomor_hp = preg_replace('/\D/', '', $nomor_hp);
    $nomor_modem = preg_replace('/\D/', '', $nomor_modem);

    file_put_contents("log.txt", "Nomor HP yang diterima: $nomor_hp\n", FILE_APPEND);
    file_put_contents("log.txt", "Nomor Modem yang diterima: $nomor_modem\n", FILE_APPEND);

    if (empty($nomor_hp) || empty($nomor_modem)) {
        sendMessage($chat_id, "Nomor HP atau Nomor Modem tidak boleh kosong.");
        exit;
    }

    // Cek apakah nomor HP ada di database
    $stmt = $conn->prepare("SELECT users.user_id, users.nama, users.nomor_hp, users.pd, users.role, tickets.* FROM users LEFT JOIN tickets ON tickets.user_id = users.user_id WHERE users.nomor_hp = ?");
    $stmt->bind_param("s", $nomor_hp);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || $user['role'] !== "pelapor") {
        sendMessage($chat_id, "Anda tidak memiliki izin untuk melaporkan gangguan.");
        exit;
    }

    // Cek apakah nomor HP sudah melaporkan hari ini
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM tickets WHERE nomor_hp_pelapor = ? AND DATE(created_at) = CURDATE()");
    $stmt->bind_param("s", $nomor_hp);
    $stmt->execute();
    $result = $stmt->get_result();
    $cekLaporan = $result->fetch_assoc();

    if ($cekLaporan['total'] > 0) {
        sendMessage($chat_id, "Anda sudah melakukan pengaduan hari ini. Mohon tunggu hingga pengaduan sebelumnya diproses.");
        exit;
    }

    // Generate ticket_id berdasarkan waktu sekarang
    $ticket_id = generateTicketId();

    // Masukkan laporan ke dalam database
    $stmt = $conn->prepare("INSERT INTO tickets (ticket_id, user_id, nomor_hp_pelapor, nomor_modem, deskripsi, status, created_at) 
                        VALUES (?, (SELECT user_id FROM users WHERE nomor_hp = ? LIMIT 1), ?, ?, ?, 'baru', NOW())");
    $stmt->bind_param("sssss", $ticket_id, $nomor_hp, $nomor_hp, $nomor_modem, $deskripsi);

    if ($stmt->execute()) {
        // Ambil data PD dari users setelah tiket berhasil dibuat
        $stmt_pd = $conn->prepare("SELECT users.user_id, users.nama, users.nomor_hp, users.pd, users.role, tickets.* 
FROM users 
LEFT JOIN tickets ON tickets.user_id = users.user_id 
WHERE users.nomor_hp = ? LIMIT 1");
        $stmt_pd->bind_param("s", $nomor_hp);
        $stmt_pd->execute();
        $result = $stmt_pd->get_result();

        if ($row = $result->fetch_assoc()) {
            $pd = $row['pd'];
        } else {
            $pd = "Tidak Diketahui"; // Jika tidak ditemukan
        }

        // Kirim pesan dengan data lengkap
        sendMessage($chat_id, "✅ Laporan berhasil dibuat!\n" .
            "Ticket ID: $ticket_id\n" .
            "Nomor HP: $nomor_hp\n" .
            "Perangkat Daerah: $pd\n" . // Tambahkan PD
            "Nomor Modem: $nomor_modem\n" .
            "Deskripsi: $deskripsi");
    } else {
        sendMessage($chat_id, "⚠️ Gagal membuat laporan. Silakan coba lagi.");
    }
}

function generateTicketId()
{
    $random_number = rand(1000, 9999);
    return 'EBOK' . date('is') . $random_number;
}

function sendMessage($chat_id, $message)
{
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}
