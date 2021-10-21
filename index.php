<?php
session_start();
require("mainconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $cfg_webname; ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="<?php echo $cfg_baseurl; ?>lib/animate/animate.min.css" rel="stylesheet">
        <link href="<?php echo $cfg_baseurl; ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo $cfg_baseurl; ?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?php echo $cfg_baseurl; ?>css/style.css" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="51">
        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-light navbar-light">
            <div class="container-fluid">
                <a href="<?php echo $cfg_baseurl; ?>" class="navbar-brand"><?php echo $cfg_webname; ?></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="<?php echo $cfg_baseurl; ?>jadwal.php" class="nav-item nav-link">Jadwal Matkul</a>
                        <a href="#portfolio" class="nav-item nav-link">Portfolio</a>
                        <a href="<?php echo $cfg_baseurl; ?>hoby.php" class="nav-item nav-link">Hoby</a>
                        <a href="<?php echo $cfg_baseurl; ?>kontak.php" class="nav-item nav-link">Contact</a>
                        <a href="<?php echo $cfg_baseurl; ?>history-education.php" class="nav-item nav-link">Riwayat Pendidikan</a>
                        <?php
                        if (isset($_SESSION[ 'user'])) {
                        ?>
                        <a href="<?php echo $cfg_baseurl; ?>admin-page.php" class="nav-item nav-link">Kelola Website</a>
                        <a href="<?php echo $cfg_baseurl; ?>logout.php" class="nav-item nav-link">Logout</a>
                        <?php 
                        }else{
                        ?>
                        <a href="<?php echo $cfg_baseurl; ?>login.php" class="nav-item nav-link">Login</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Hero Start -->
        <div class="hero" id="home">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6">
                        <div class="hero-content">
                            <div class="hero-text">
                                <p>I'm</p>
                                <h1><?php echo $cfg_webauthor; ?></h1>
                                <h2></h2>
                                <div class="typed-text">Photographer, Cameraman, Designer, Content Creator</div>
                            </div>
                            <div class="hero-btn">
                                <a class="btn" href="https://api.whatsapp.com/send?phone=<?php echo $cfg_webcontact; ?>&text=Halo%20<?php echo $cfg_webauthor; ?>">Contact Me</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-none d-md-block">
                        <div class="hero-image">
                            <img src="<?php echo $cfg_baseurl; ?>img/hero.jpg" alt="Hero Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- About Start -->
        <div class="about wow fadeInUp" data-wow-delay="0.1s" id="about">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                        	<?php
                        	$query_la = mysqli_query($db, "SELECT * FROM learn_about_me ORDER BY id ASC LIMIT 1");
                    		$data_la = mysqli_fetch_assoc($query_la);
                    		?>
                            <img src="<?php echo $cfg_baseurl; ?>img/<?php echo $data_la['gambar']; ?>" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="section-header text-left">
                                <p>Learn About Me</p>
                                <h2>My Experience</h2>
                            </div>
                            <div class="skills">
                            	<?php
                    			$query_learn_about = mysqli_query($db, "SELECT * FROM learn_about_me ORDER BY id ASC");
                    			while ($data_learn_about = mysqli_fetch_assoc($query_learn_about)) {
                    			?>
                                <div class="skill-name">
                                    <p><?php echo $data_learn_about['experience_name'] ;?></p><p><?php echo $data_learn_about['persentage'] ;?>%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data_learn_about['persentage'] ;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            	<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Portfolio Start -->
        <div class="portfolio" id="portfolio">
            <div class="container">
                <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                    <p>My Portfolio</p>
                    <h2>My Excellent Portfolio</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul id="portfolio-filter">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-1">Photographer</li>
                            <li data-filter=".filter-2">Designer</li>
                            <li data-filter=".filter-3">Content Creator</li>
                        </ul>
                    </div>
                </div>
                <div class="row portfolio-container">
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                    	<?php
                    	$query_1 = mysqli_query($db, "SELECT * FROM portfolio WHERE tipe = 'Photographer' ORDER BY id ASC");
                    	while ($data_1 = mysqli_fetch_assoc($query_1)) {
                    	?>
                        <div class="portfolio-wrap">
                            <div class="portfolio-img">
                                <img src="<?php echo $cfg_baseurl; ?>img/<?php echo $data_1['gambar'];?>" alt="Image">
                            </div>
                            <div class="portfolio-text">
                                <h3><?php echo $data_1['nama_portfolio'];?></h3>
                                <a class="btn" href="<?php echo $cfg_baseurl; ?>img/<?php echo $data_1['gambar'];?>" data-lightbox="portfolio">+</a>
                            </div>
                        </div>
                    	<?php } ?>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item filter-2 wow fadeInUp" data-wow-delay="0.2s">
                    	<?php
                    	$query_2 = mysqli_query($db, "SELECT * FROM portfolio WHERE tipe = 'Designer' ORDER BY id ASC");
                    	while ($data_2 = mysqli_fetch_assoc($query_2)) {
                    	?>
                        <div class="portfolio-wrap">
                            <div class="portfolio-img">
                                <img src="<?php echo $cfg_baseurl; ?>img/<?php echo $data_2['gambar'];?>" alt="Image">
                            </div>
                            <div class="portfolio-text">
                                <h3><?php echo $data_2['nama_portfolio'];?></h3>
                                <a class="btn" href="<?php echo $cfg_baseurl; ?>img/<?php echo $data_2['gambar'];?>" data-lightbox="portfolio">+</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item filter-3 wow fadeInUp" data-wow-delay="0.4s">
                    	<?php
                    	$query_3 = mysqli_query($db, "SELECT * FROM portfolio WHERE tipe = 'Content Creator' ORDER BY id ASC");
                    	while ($data_3 = mysqli_fetch_assoc($query_3)) {
                    	?>
                        <div class="portfolio-wrap">
                            <div class="portfolio-img">
                                <img src="<?php echo $cfg_baseurl; ?>img/<?php echo $data_3['gambar'];?>" alt="Image">
                            </div>
                            <div class="portfolio-text">
                                <h3><?php echo $data_3['nama_portfolio'];?></h3>
                                <a class="btn" href="<?php echo $cfg_baseurl; ?>img/<?php echo $data_3['gambar'];?>" data-lightbox="portfolio">+</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio End -->


        <!-- Footer Start -->
        <div class="footer wow fadeIn" data-wow-delay="0.3s">
            <div class="container-fluid">
                <div class="container copyright">
                    <p>&copy; <a href="#"><?php echo $cfg_webname; ?></a>, All Right Reserved</p>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        
        <!-- Back to top button -->
        <a href="#" class="btn back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/easing/easing.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/wow/wow.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/waypoints/waypoints.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/typed/typed.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/isotope/isotope.pkgd.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>lib/lightbox/js/lightbox.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="<?php echo $cfg_baseurl; ?>mail/jqBootstrapValidation.min.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="<?php echo $cfg_baseurl; ?>js/main.js"></script>
    </body>
</html>