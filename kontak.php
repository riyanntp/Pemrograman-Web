<?php
session_start();
require("mainconfig.php");

    if (isset($_POST['login'])) {
        $post_email = trim($_POST['email']);
        $post_password = trim($_POST['password']);
        
        if (empty($post_email) || empty($post_password)) {
            $msg_type = "error";
            $msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
        } else {
            
            $check_user = mysqli_query($db, "SELECT * FROM users WHERE email = '$post_email'");
            if (mysqli_num_rows($check_user) == 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> email tidak ditemukan.";
            } else {
                $data_user = mysqli_fetch_assoc($check_user);
                if ($post_password <> $data_user['password']) {
                    $msg_type = "error";
                    $msg_content = "<b>Gagal:</b> Password salah.";
                } else {
                    $msg_type = "success";
                    $msg_content = 'Login berhasil !<br /> Anda akan dialihkan ke halaman dashboard secara otomatis.<script>swal("Login Berhasil!", "Anda akan dialihkan ke halaman dashboard secara otomatis.", "success");</script>';
                    $ip_address = check_ip();
                    $_SESSION['user'] = $data_user;
                    $sess_email = $_SESSION['user']['email'];
                }
            }
        }
    }
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
                        <a href="<?php echo $cfg_baseurl; ?>" class="nav-item nav-link">Home</a>
                        <a href="<?php echo $cfg_baseurl; ?>" class="nav-item nav-link">About</a>
                        <a href="<?php echo $cfg_baseurl; ?>jadwal.php" class="nav-item nav-link">Jadwal Matkul</a>
                        <a href="<?php echo $cfg_baseurl; ?>" class="nav-item nav-link">Portfolio</a>
                        <a href="<?php echo $cfg_baseurl; ?>hoby.php" class="nav-item nav-link">Hoby</a>
                        <a href="<?php echo $cfg_baseurl; ?>kontak.php" class="nav-item nav-link active">Contact</a>
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
                    <div class="col-lg-12">
                        <div class="hero-text">
                            <p class="text-center"><u>Contact page</u></p>
                            <div class="row col-lg-12">
                                <?php
                                $query_contact = mysqli_query($db, "SELECT * FROM contact ORDER BY id ASC LIMIT 1");
                                while ($data_contact = mysqli_fetch_assoc($query_contact)) {
                                ?>
                                <div class="card-body text-left">
                                    <h3 class="text-white"><?php echo $data_contact['name']; ?></h3><hr>
                                    <h5 class="text-white">Hubungi melalui : </h5>
                                    <p class="card-body"><img src="https://www.kccomms.co.uk/wp-content/uploads/2017/08/Facebook-2.jpg" width="4%"> <a href="https://facebook.com/<?php echo $data_contact['fb']; ?>" target="block" class="text-primary">Klik disini</a></p>
                                    <p class="card-body"><img src="https://th.bing.com/th/id/R.c5ddecc677d10dd4ae1a9216bf75dff7?rik=6nNaZIUE7nrPJg&riu=http%3a%2f%2fpluspng.com%2fimg-png%2finstagram-png-instagram-png-icon-1024.png&ehk=g%2ffN9f%2bnGvDVPmZQMVTHWRh5%2bvzaZK5iHv1a%2bcmGVkg%3d&risl=&pid=ImgRaw&r=0" width="4%"> <a href="https://instagram.com/<?php echo $data_contact['ig']; ?>" class="text-primary" target="block">Klik disini</a></p>
                                    <p class="card-body"><img src="https://th.bing.com/th/id/R.27f8fb6f8e5980b4b4f28263db1e557b?rik=gHiMXZVs6xRdBw&riu=http%3a%2f%2fegov.eletsonline.com%2fwp-content%2fuploads%2f2014%2f10%2fwhatsapp-logo-hd-2.png&ehk=rUBqCPMXRW2z23gWV%2f03gIl3OkAS2dSVJT7gC8XhEP8%3d&risl=&pid=ImgRaw&r=0" width="4%"> <a href="https://api.whatsapp.com/send?phone=<?php echo $data_contact['wa']; ?>" class="text-primary" target="block">Klik disini</a></p>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        
        
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
<?php ?>