<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

$cfg_mt = 0; // Maintenance? 1 = ya 0 = tidak
if($cfg_mt == 1) {
    die("Website sedang dalam pengembangan");
}


// database
$db_server = "localhost";
$db_user = "utsriyan_database";
$db_password = "utsriyan_database"; // real pass
$db_name = "utsriyan_database";

// date & time
$date = date("Y-m-d");
$date_convert = date("d-m-Y");
$date_ori = date("d-m-Y");
$tanggalan = date("d/m");
$time = date("H:i:s");

// require
require("database.php");
require("function.php");

// config website
$check_web = mysqli_query($db, "SELECT * FROM website");
$data_web = mysqli_fetch_assoc($check_web);

$cfg_webname = $data_web['name'];
$cfg_webkeyword = $data_web['keyword'];
$cfg_webdesc = $data_web['description'];
$cfg_webauthor = $data_web['author'];
$cfg_webcontact = $data_web['contact'];
$cfg_baseurl = "https://uts-riyan.my.id/";
$cfg_registerurl = "".$cfg_baseurl."signup";

// Other
$operating_system = $_SERVER['HTTP_USER_AGENT'];