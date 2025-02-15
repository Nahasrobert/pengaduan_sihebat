    <?php
    $title = 'Home Pengaduan SiHebat';
    include 'header.php';
    include 'config.php';
    // Ambil data profil dari database
    $result = $conn->query("SELECT *  from tbl_profil Limit 1");
    $profil = mysqli_fetch_assoc($result);

    $conn->close();
    ?>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container d-flex flex-column align-items-center">
            <h2 data-aos="fade-up" data-aos-delay="100">Manual Book SiHebat</h2>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="stats" class="stats section light-background py-5">
        <div class="container">
            <div class="row gy-4">
                <embed src="uploads/<?= $profil['manual_book'] ?>" type="application/pdf" width="100%" height="600px" />

            </div>
        </div>
    </section>

    <!-- Stats Section -->



    <?php
    include('footer.php')
    ?>