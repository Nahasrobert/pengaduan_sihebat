    <?php
    $title = 'Home Pengaduan SiHebat';
    include 'header.php';
    include 'config.php';
    // Ambil data profil dari database
    $result = $conn->query("SELECT *  from tbl_profil Limit 1");
    $profil = mysqli_fetch_assoc($result);
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbl_perangkat_daerah");
    $row = $result->fetch_assoc();
    $jumlahPerangkatDaerah = $row['total'];

    // Menghitung jumlah pengaduan
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbl_pengaduan");
    $row = $result->fetch_assoc();
    $jumlahPengaduan = $row['total'];

    // Menghitung jumlah pegawai
    // Query untuk mengambil data pegawai
    $result = $conn->query("SELECT tbl_pegawai.*, tbl_perangkat_daerah.nama_perangkat_daerah 
                        FROM tbl_pegawai 
                        JOIN tbl_perangkat_daerah ON tbl_pegawai.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah");

    // Query untuk menghitung jumlah pegawai
    $countResult = $conn->query("SELECT COUNT(*) AS total FROM tbl_pegawai");
    $countRow = $countResult->fetch_assoc();
    $jumlahPegawai = $countRow['total'];


    // Menghitung jumlah pengaduan dengan status "selesai"
    $result = $conn->query("SELECT COUNT(*) AS total FROM tbl_pengaduan WHERE status = 'selesai'");
    $row = $result->fetch_assoc();
    $jumlahPengaduanSelesai = $row['total'];

    $conn->close();
    ?>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container d-flex flex-column align-items-center">
            <h2 data-aos="fade-up" data-aos-delay="100"><?= $profil['nama'] ?></h2>
            <p data-aos="fade-up" data-aos-delay="200"><?= $profil['keterangan'] ?>
            </p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="#about" class="btn-get-started">Get Started</a>
                <a href="https://youtu.be/sUpRArvazwY" class="glightbox btn-watch-video d-flex align-items-center"><i
                        class="bi bi-play-circle"></i><span>Watch
                        Video</span></a>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3>Visi</h3>
                    <!-- <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt=""> -->
                    <p>
                        <?= $profil['visi'] ?>
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="content ps-0 ps-lg-5">
                        <h3>Misi</h3>

                        <p>
                            <?= $profil['misi'] ?>
                        </p>

                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-buildings color-blue flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jumlahPerangkatDaerah ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Perangkat Daerah</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-file-earmark-text color-orange flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jumlahPengaduan ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Pengaduan</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-person-badge color-green flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jumlahPegawai ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Pegawai</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-check-circle color-pink flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $jumlahPengaduanSelesai ?>"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Pengaduan Selesai</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <!-- <p>Necessitatibus eius consequatur</p> -->
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                <div class="col-lg-6 ">
                    <div class="row gy-4">

                        <!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Nomor Handphone</h3>
                                <p><?= $profil['nomor_hp'] ?></p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Email </h3>
                                <p><?= $profil['email'] ?></p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>
                </div>

                <div class="col-lg-6">


                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3927.3319479582183!2d123.60754857447512!3d-10.153649509546304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569cc916f42e43%3A0x43e680021135126d!2sDinas%20Komunikasi%20dan%20Informatika%20Kota%20Kupang!5e0!3m2!1sid!2sid!4v1739582117277!5m2!1sid!2sid"
                        width="100%" height="170" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
    <?php
    include('footer.php')
    ?>