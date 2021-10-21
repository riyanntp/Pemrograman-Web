<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
    $sess_email = $_SESSION['user']['email'];
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE email = '$sess_email'");
    $data_user = mysqli_fetch_assoc($check_user);
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
    } else {

    if (isset($_POST['add'])) {
            $post_name = $_POST['name'];
            $post_fb = $_POST['fb'];
            $post_ig = $_POST['ig'];
            $post_wa = $_POST['wa'];

            $checkdb_contact_pribadi = mysqli_query($db, "SELECT * FROM contact WHERE name = '$post_name'");
            $datadb_contact_pribadi = mysqli_fetch_assoc($checkdb_contact_pribadi);
            if (empty($post_name) || empty($post_fb) || empty($post_ig) || empty($post_wa)) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mohon masukan semua input.";
            } else if (mysqli_num_rows($checkdb_contact_pribadi) > 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Kontak : $post_name Sudah terdata di database.";
            } else {
                $insert_contact = mysqli_query($db, "INSERT INTO contact (name, fb, ig, wa) VALUES ('$post_name', '$post_fb', '$post_ig', '$post_wa')");
                if ($insert_contact == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Contact berhasil disimpan";
                } else {
                    $msg_type = "error";
                    $msg_content = "<b>Failed:</b> Gagal menyimpan data.";
                }
            }
        } else if (isset($_POST['edit'])) {
                    $post_id = $_GET['id'];
                    $post_name = $_POST['name'];
                    $post_fb = $_POST['fb'];
                    $post_ig = $_POST['ig'];
                    $post_wa = $_POST['wa'];
                    if (empty($post_id)) {
                        $msg_type = "error";
                        $msg_content = "<b>Failed:</b> Data tidak ditemukan.";
                    } else {
                        $update_contact_pribadi = mysqli_query($db, "UPDATE contact SET name = '$post_name', fb = '$post_fb', ig = '$post_ig', wa = '$post_wa' WHERE id = '$post_id'");
                        if ($update_contact_pribadi == TRUE) {
                            $msg_type = "success";
                            $msg_content = "<b>Berhasil:</b> Contact berhasil diperbarui.";
                        } else {
                            $msg_type = "error";
                            $msg_content = "<b>Failed:</b> Gagal melakukan pembaruan.";
                        }
                    }
        } else if (isset($_POST['delete'])) {
            $post_id = $_GET['id'];
            $checkdb_contact_pribadi = mysqli_query($db, "SELECT * FROM contact WHERE id = '$post_id'");
            if (mysqli_num_rows($checkdb_contact_pribadi) == 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Data tidak ditemukan.";
            } else {
                $delete_contact_pribadi = mysqli_query($db, "DELETE FROM contact WHERE id = '$post_id'");
                if ($delete_contact_pribadi == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Contact berhasil dihapus.";
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
                        <a href="<?php echo $cfg_baseurl; ?>admin-page.php" class="nav-item nav-link">Home</a>
                        <a href="<?php echo $cfg_baseurl; ?>" class="nav-item nav-link">About</a>
                        <a href="<?php echo $cfg_baseurl; ?>jadwal.php" class="nav-item nav-link">Jadwal Matkul</a>
                        <a href="<?php echo $cfg_baseurl; ?>" class="nav-item nav-link">Portfolio</a>
                        <a href="<?php echo $cfg_baseurl; ?>hoby.php" class="nav-item nav-link">Hoby</a>
                        <a href="<?php echo $cfg_baseurl; ?>kontak.php" class="nav-item nav-link">Contact</a>
                        <a href="<?php echo $cfg_baseurl; ?>history-education.php" class="nav-item nav-link">Riwayat Pendidikan</a>
                        <?php
                        if (isset($_SESSION[ 'user'])) {
                        ?>
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


          <!-- Admin Menu Start -->
        <div class="hero" id="home">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12">
                        <div class="hero-content">
                            <div class="row card-body col-lg-12">
                                <a class="col-lg-1"></a>
                                <a class="btn col-lg-2" href="<?php echo $cfg_baseurl; ?>manage-portfolio.php">Kelola Portfolio</a>
                                <a class="btn col-lg-2" href="<?php echo $cfg_baseurl; ?>manage-hoby.php">Kelola Hoby</a>
                                <a class="btn col-lg-2" href="<?php echo $cfg_baseurl; ?>manage-schedule.php">Kelola Schedule</a>
                                <a class="btn col-lg-2" href="<?php echo $cfg_baseurl; ?>manage-contact.php">Kelola Contact</a>
                                <a class="btn col-lg-2" href="<?php echo $cfg_baseurl; ?>manage-pendidikan.php">Kelola Pendidikan</a>
                                <a class="col-lg-1"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!-- Admin Menu End -->
        <hr>

        <!-- Hero Start -->
        <div class="hero" id="home">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="hero-text">
                            <p class="text-center"><u>Manage contact page</u></p>
                                    <!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="POST">
                                            <div class="alert alert-info"> Periksa seluruh kolom sebelum menyimpan.</div>
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                    <input type="text" name="name" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Username Facebook</label>
                                                    <input type="text" name="fb" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Username Instagram</label>
                                                    <input type="text" name="ig" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                    <input type="number" name="wa" class="form-control" placeholder="example : 628123456789">
                                            </div>
                                        <div class="modal-footer">
                                            <div class="pull-left">
                                            <button type="button" class="btn btn-info btn-bordered waves-effect w-md waves-light" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-left"></i> Batal </button>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="add"><i class="fa fa-plus"></i> Simpan </button>
                                        </div>
                                        </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                                    <div class="col-lg-12">
                                        <?php if ($msg_type == "success") {
                                        ?>
                                        <div class="alert alert-success">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <i class="fa fa-check-circle"></i>
                                            <?php echo $msg_content; ?>
                                        </div>
                                        <?php
                                        } else if ($msg_type == "error") {
                                        ?>
                                        <div class="alert alert-danger">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <i class="fa fa-times-circle"></i>
                                            <?php echo $msg_content; ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <button data-toggle="modal" data-target="#myModal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Hoby</button>
                                    </div>

                            <div class="table-responsive col-lg-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-uppercase text-center alert alert-primary text-primary">
                                            <th>Nama</th>
                                            <th>Username Facebook</th>
                                            <th>Username Instagram</th>
                                            <th>Nomor Whatsapp</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_contact = mysqli_query($db, "SELECT * FROM contact ORDER BY id ASC LIMIT 1");
                                        while ($data_contact = mysqli_fetch_assoc($query_contact)) {
                                            ?>
                                            <tr class="text-uppercase">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_contact['id']; ?>" class="form-inline" role="form" method="POST">
                                                        <td><input type="text" class="form-control" name="name" value="<?php echo $data_contact['name']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="fb" value="<?php echo $data_contact['fb']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="ig" value="<?php echo $data_contact['ig']; ?>"></td>
                                                        <td><input type="number" class="form-control" name="wa" value="<?php echo $data_contact['wa']; ?>"></td>
                                                        <td class="text-center">
                                                            <button type="submit" name="edit" class="btn"><i class="fa fa-edit" title="Ubah"></i></button>
                                                            <button type="submit" name="delete" class="btn"><i class="fa fa-trash" title="Hapus"></i></button>
                                                        </td>
                                                        </form>
                                                    </tr>
                                        </tbody>
                                    <?php } ?>
                                </table>
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
<?php 
    }
} else {
    header("Location: ".$cfg_baseurl);
}
?>