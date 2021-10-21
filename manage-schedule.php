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
            $post_kelas = $_POST['kelas'];
            $post_kode_matkul = $_POST['kode_matkul'];
            $post_date = $_POST['date'];
            $post_start_time = $_POST['start_time'];
            $post_end_time = $_POST['end_time'];

            $checkdb_jadwal_matakuliah = mysqli_query($db, "SELECT * FROM jadwal_matakuliah WHERE kode_matkul = '$post_kode_matkul'");
            $datadb_jadwal_matakuliah = mysqli_fetch_assoc($checkdb_jadwal_matakuliah);
            if (empty($post_kelas) || empty($post_kode_matkul) || empty($post_date) || empty($post_start_time) || empty($post_end_time)) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mohon masukan semua input.";
            } else if (mysqli_num_rows($checkdb_jadwal_matakuliah) > 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Mata kuliah : $post_kode_matkul Sudah terdata di database.";
            } else {
                $insert_provider = mysqli_query($db, "INSERT INTO jadwal_matakuliah (kelas, kode_matkul, date, start_time, end_time) VALUES ('$post_kelas', '$post_kode_matkul', '$post_date', '$post_start_time', '$post_end_time')");
                if ($insert_provider == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Jadwal berhasil disimpan";
                } else {
                    $msg_type = "error";
                    $msg_content = "<b>Failed:</b> Gagal menyimpan data.";
                }
            }
        } else if (isset($_POST['edit'])) {
                    $post_id = $_GET['id'];
                    $post_kelas = $_POST['kelas'];
                    $post_kode_matkul = $_POST['kode_matkul'];
                    $post_date = $_POST['date'];
                    $post_start_time = $_POST['start_time'];
                    $post_end_time = $_POST['end_time'];
                    if (empty($post_id)) {
                        $msg_type = "error";
                        $msg_content = "<b>Failed:</b> Data tidak ditemukan.";
                    } else {
                        $update_jadwal_matakuliah = mysqli_query($db, "UPDATE jadwal_matakuliah SET kelas = '$post_kelas', kode_matkul = '$post_kode_matkul', date = '$post_date', start_time = '$post_start_time', end_time = '$post_end_time' WHERE id = '$post_id'");
                        if ($update_jadwal_matakuliah == TRUE) {
                            $msg_type = "success";
                            $msg_content = "<b>Berhasil:</b> Jadwal berhasil diperbarui.";
                        } else {
                            $msg_type = "error";
                            $msg_content = "<b>Failed:</b> Gagal melakukan pembaruan.";
                        }
                    }
        } else if (isset($_POST['delete'])) {
            $post_id = $_GET['id'];
            $checkdb_jadwal_matakuliah = mysqli_query($db, "SELECT * FROM jadwal_matakuliah WHERE id = '$post_id'");
            if (mysqli_num_rows($checkdb_jadwal_matakuliah) == 0) {
                $msg_type = "error";
                $msg_content = "<b>Gagal:</b> Data tidak ditemukan.";
            } else {
                $delete_jadwal_matakuliah = mysqli_query($db, "DELETE FROM jadwal_matakuliah WHERE id = '$post_id'");
                if ($delete_jadwal_matakuliah == TRUE) {
                    $msg_type = "success";
                    $msg_content = "<b>Berhasil:</b> Jadwal berhasil dihapus.";
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
                            <p class="text-center"><u>Manage schedule page</u></p>
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
                                                <label>Kelas</label>
                                                    <input type="text" name="kelas" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Matkul</label>
                                                    <input type="text" name="kode_matkul" class="form-control" placeholder="example : ABCD">
                                            </div>
                                            <div class="form-group">
                                                <label>Hari</label>
                                                    <select class="form-control" name="date">
                                                        <option value="">Pilih hari...</option>
                                                        <option value="Minggu">Minggu</option>
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jumat</option>
                                                        <option value="Sabtu">Sabtu</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Waktu Mulai Kuliah</label>
                                                    <input type="time" name="start_time" class="form-control" placeholder="example : 07:00">
                                            </div>
                                            <div class="form-group">
                                                <label>Waktu Selesai Kuliah</label>
                                                    <input type="time" name="end_time" class="form-control" placeholder="example : 10:00">
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
                                        <button data-toggle="modal" data-target="#myModal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Jadwal</button>
                                    </div>

                            <div class="table-responsive col-lg-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-uppercase text-center alert alert-primary text-primary">
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Matkul</th>
                                            <th>Hari</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Berakhir</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_jadwal = mysqli_query($db, "SELECT * FROM jadwal_matakuliah ORDER BY id ASC");
                                        while ($data_jadwal = mysqli_fetch_assoc($query_jadwal)) {
                                            ?>
                                            <tr class="text-uppercase">
                                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_jadwal['id']; ?>" class="form-inline" role="form" method="POST">
                                                        <td><input type="number" class="form-control" name="id" value="<?php echo $data_jadwal['id']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="kelas" value="<?php echo $data_jadwal['kelas']; ?>"></td>
                                                        <td><input type="text" class="form-control" name="kode_matkul" value="<?php echo $data_jadwal['kode_matkul']; ?>"></td>
                                                        <td><select class="form-control" name="date">
                                                            <option value="<?php echo $data_jadwal['date']; ?>"><?php echo $data_jadwal['date']; ?> (Selected)</option>
                                                            <option value="Minggu">Minggu</option>
                                                            <option value="Senin">Senin</option>
                                                            <option value="Selasa">Selasa</option>
                                                            <option value="Rabu">Rabu</option>
                                                            <option value="Kamis">Kamis</option>
                                                            <option value="Jumat">Jumat</option>
                                                            <option value="Sabtu">Sabtu</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="time" class="form-control" name="start_time" value="<?php echo $data_jadwal['start_time']; ?>"></td>
                                                        <td><input type="time" class="form-control" name="end_time" value="<?php echo $data_jadwal['end_time']; ?>"></td>
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