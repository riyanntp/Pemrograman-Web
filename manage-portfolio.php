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
            $post_nama_portfolio = $_POST['nama_portfolio'];
            $post_tipe = $_POST['tipe'];
            $nama_file_gambar = $_FILES['gambar']['name'];
            $ukuran_file_gambar = $_FILES['gambar']['size'];
            $tipe_file_gambar = $_FILES['gambar']['type'];
            $tmp_file_gambar = $_FILES['gambar']['tmp_name'];

            $checkdb_portfolio = mysqli_query($db, "SELECT * FROM portfolio WHERE nama_portfolio = '$post_nama_portfolio'");
            $datadb_portfolio = mysqli_fetch_assoc($checkdb_portfolio);
            if (empty($post_nama_portfolio) || empty($post_tipe)) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mohon masukan semua input.";
            } else if (mysqli_num_rows($checkdb_portfolio) > 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Portfolio : $post_nama_portfolio Sudah terdata di database.";
            } else {
                $path_gambar = "img/".$nama_file_gambar;
                if(move_uploaded_file($tmp_file_gambar, $path_gambar)){
                    $insert_portfolio = mysqli_query($db, "INSERT INTO portfolio (nama_portfolio, tipe, gambar) VALUES ('$post_nama_portfolio', '$post_tipe', '$nama_file_gambar')");
                    if ($insert_portfolio == TRUE) {
                        $msg_type = "success";
                        $msg_content = "<b>Berhasil:</b> Portfolio berhasil disimpan";
                    } else {
                        $msg_type = "error";
                        $msg_content = "<b>Failed:</b> Gagal menyimpan data.";
                    }
                } else {
                    $msg_type = "error";
                    $msg_content = "<b>Failed:</b> Gagal menyimpan gambar";
                }
            }
        } else if (isset($_POST['edit'])) {
                    $post_id = $_GET['id'];
                    $post_nama_portfolio = $_POST['nama_portfolio'];
                    $post_tipe = $_POST['tipe'];
                    $nama_file_gambar = $_FILES['gambar']['name'];
                    $ukuran_file_gambar = $_FILES['gambar']['size'];
                    $tipe_file_gambar = $_FILES['gambar']['type'];
                    $tmp_file_gambar = $_FILES['gambar']['tmp_name'];
                    if (empty($post_id)) {
                        $msg_type = "error";
                        $msg_content = "<b>Failed:</b> Data tidak ditemukan.";
                    } else {
                        $path_gambar = "img/".$nama_file_gambar;
                        if(move_uploaded_file($tmp_file_gambar, $path_gambar)){
                            $update_portfolio = mysqli_query($db, "UPDATE portfolio SET nama_portfolio = '$post_nama_portfolio', tipe = '$post_tipe', gambar = '$nama_file_gambar' WHERE id = '$post_id'");
                            if ($update_portfolio == TRUE) {
                                $msg_type = "success";
                                $msg_content = "<b>Berhasil:</b> Portfolio berhasil diperbarui.";
                            } else {
                                $msg_type = "error";
                                $msg_content = "<b>Failed:</b> Gagal melakukan pembaruan.";
                            }
                        } else {
                            $update_portfolio = mysqli_query($db, "UPDATE portfolio SET nama_portfolio = '$post_nama_portfolio', tipe = '$post_tipe'WHERE id = '$post_id'");
                            if ($update_portfolio == TRUE) {
                                $msg_type = "success";
                                $msg_content = "<b>Berhasil:</b> Portfolio berhasil diperbarui.";
                            } else {
                                $msg_type = "error";
                                $msg_content = "<b>Failed:</b> Gagal melakukan pembaruan.";
                            }
                        }
                    }
        } else if (isset($_POST['delete'])) {
            $post_id = $_GET['id'];
            $checkdb_portfolio = mysqli_query($db, "SELECT * FROM portfolio WHERE id = '$post_id'");
            $datadb_portfolio = mysqli_fetch_assoc($checkdb_portfolio);
            $gambar = $datadb_portfolio['gambar'];
            if (mysqli_num_rows($checkdb_portfolio) == 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Data tidak ditemukan.";
            } else {
                $files=glob('img/'.$gambar.'');
                foreach ($files as $file) {
                    if (is_file($file))
                    unlink($file); // hapus file
                }
                $delete_portfolio = mysqli_query($db, "DELETE FROM portfolio WHERE id = '$post_id'");
                if ($delete_portfolio == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Portfolio berhasil dihapus.";
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
                            <p class="text-center"><u>Manage portfolio page</u></p>
                                    <!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                                            <div class="alert alert-info"> Periksa seluruh kolom sebelum menyimpan.</div>
                                            <div class="form-group">
                                                <label>Nama Portfolio</label>
                                                    <input type="text" name="nama_portfolio" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe</label>
                                                    <select class="form-control" name="tipe">
                                                        <option value="">Pilih tipe...</option>
                                                        <option value="Photographer">Photographer</option>
                                                        <option value="Designer">Designer</option>
                                                        <option value="Content Creator">Content Creator</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Gambar</label>
                                                    <input type="file" name="gambar" class="form-control">
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
                                        <button data-toggle="modal" data-target="#myModal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah portfolio</button>
                                    </div>

                            <div class="table-responsive col-lg-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-uppercase text-center alert alert-primary text-primary">
                                            <th>No</th>
                                            <th>Nama Portfolio</th>
                                            <th>Tipe</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_portfolio = mysqli_query($db, "SELECT * FROM portfolio ORDER BY id ASC");
                                        while ($data_portfolio = mysqli_fetch_assoc($query_portfolio)) {
                                            ?>
                                            <tr class="text-uppercase">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_portfolio['id']; ?>" class="form-inline" role="form" method="POST" enctype="multipart/form-data">
                                                        <td><input type="number" class="form-control" name="id" value="<?php echo $data_portfolio['id']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="nama_portfolio" value="<?php echo $data_portfolio['nama_portfolio']; ?>"></td>
                                                        <td><select class="form-control" name="tipe">
                                                            <option value="<?php echo $data_portfolio['tipe']; ?>"><?php echo $data_portfolio['tipe']; ?> (Selected)</option>
                                                            <option value="Photographer">Photographer</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Content Creator">Content Creator</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center"><div class="col-lg-12">
                                                                <img src="<?php echo $cfg_baseurl; ?>img/<?php echo $data_portfolio['gambar']; ?>" width="70%">
                                                                <hr>
                                                                <h6 class="text-white">Pilih Gambar Untuk Mengubah</h6>
                                                                <input type="file" class="form-control" name="gambar" title="Ganti Gambar">
                                                            </div>
                                                        </td>
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