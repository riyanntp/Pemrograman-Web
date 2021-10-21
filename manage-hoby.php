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
            $post_hoby_name = $_POST['hoby_name'];
            $post_detail_hoby = $_POST['detail_hoby'];

            $checkdb_hoby_pribadi = mysqli_query($db, "SELECT * FROM hoby WHERE hoby_name = '$post_hoby_name'");
            $datadb_hoby_pribadi = mysqli_fetch_assoc($checkdb_hoby_pribadi);
            if (empty($post_hoby_name) || empty($post_detail_hoby)) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mohon masukan semua input.";
            } else if (mysqli_num_rows($checkdb_hoby_pribadi) > 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Hoby : $post_hoby_name Sudah terdata di database.";
            } else {
                $insert_provider = mysqli_query($db, "INSERT INTO hoby (hoby_name, detail_hoby) VALUES ('$post_hoby_name', '$post_detail_hoby')");
                if ($insert_provider == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Hoby berhasil disimpan";
                } else {
                    $msg_type = "error";
                    $msg_content = "<b>Failed:</b> Gagal menyimpan data.";
                }
            }
        } else if (isset($_POST['edit'])) {
                    $post_id = $_GET['id'];
                    $post_hoby_name = $_POST['hoby_name'];
                    $post_detail_hoby = $_POST['detail_hoby'];
                    if (empty($post_id)) {
                        $msg_type = "error";
                        $msg_content = "<b>Failed:</b> Data tidak ditemukan.";
                    } else {
                        $update_hoby_pribadi = mysqli_query($db, "UPDATE hoby SET hoby_name = '$post_hoby_name', detail_hoby = '$post_detail_hoby' WHERE id = '$post_id'");
                        if ($update_hoby_pribadi == TRUE) {
                            $msg_type = "success";
                            $msg_content = "<b>Berhasil:</b> Hoby berhasil diperbarui.";
                        } else {
                            $msg_type = "error";
                            $msg_content = "<b>Failed:</b> Gagal melakukan pembaruan.";
                        }
                    }
        } else if (isset($_POST['delete'])) {
            $post_id = $_GET['id'];
            $checkdb_hoby_pribadi = mysqli_query($db, "SELECT * FROM hoby WHERE id = '$post_id'");
            if (mysqli_num_rows($checkdb_hoby_pribadi) == 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Data tidak ditemukan.";
            } else {
                $delete_hoby_pribadi = mysqli_query($db, "DELETE FROM hoby WHERE id = '$post_id'");
                if ($delete_hoby_pribadi == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Hoby berhasil dihapus.";
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
                            <p class="text-center"><u>Manage hoby page</u></p>
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
                                                <label>Hoby</label>
                                                    <input type="text" name="hoby_name" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan Hoby</label>
                                                    <textarea name="detail_hoby" class="form-control" placeholder="example : ABCD"></textarea>
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
                                            <th>No</th>
                                            <th>Hobi</th>
                                            <th>Keterangan Hobi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_hoby = mysqli_query($db, "SELECT * FROM hoby ORDER BY id ASC");
                                        while ($data_hoby = mysqli_fetch_assoc($query_hoby)) {
                                            ?>
                                            <tr class="text-uppercase">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_hoby['id']; ?>" class="form-inline" role="form" method="POST">
                                                        <td><input type="number" class="form-control" name="id" value="<?php echo $data_hoby['id']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="hoby_name" value="<?php echo $data_hoby['hoby_name']; ?>"></td>
                                                        <td><textarea class="form-control" name="detail_hoby"><?php echo $data_hoby['detail_hoby']; ?></textarea></td>
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