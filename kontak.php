    <?php
    $title = 'Home Pengaduan SiHebat';
    include 'header.php';
    include 'config.php';
    // Ambil data profil dari database
    // Ambil data profil dari database
    $result = $conn->query("SELECT *  from tbl_profil Limit 1");
    $profil = mysqli_fetch_assoc($result);
    $conn->close();
    ?>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container d-flex flex-column align-items-center">
            <h2 data-aos="fade-up" data-aos-delay="100">Kontak</h2>

        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->


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