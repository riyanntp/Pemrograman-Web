<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_email = $_SESSION['user']['email'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE email = '$sess_email'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
    }
}    

$value = $data_user['value'];
unset($_SESSION['user']);
session_unset();
session_destroy();
setcookie('id', '', time()-$value);
setcookie('log_key', '', time()-$value);

$ip_address = check_ip();
header("Location: ".$cfg_baseurl."");