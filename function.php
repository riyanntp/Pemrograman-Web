<?php
// Penulis Kode CR69 - Januari 2017

function encrypt( $q ) {
	$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
}

function EncryptQi($text) {
  $satu = base64_encode(md5($text));
  return $satu;
}

function curl($link, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    //echo $chresult;
    curl_close($ch);
    $json_result = json_decode($chresult, true);
    return $json_result;
}
function followers_count($data){
	$id = file_get_contents("https://instagram.com/web/search/topsearch/?query=".$data);
	$id = json_decode($id, true);
  	$count = $id['users'][0]['user']['follower_count'];
  	return $count;
}

function likes_count($data){
    $id = file_get_contents("".$data."?&__a=1");
   	$id = json_decode($id, true);
   	$count = $id['graphql']['shortcode_media']['edge_media_preview_like']['count'];
   	return $count;
}

function views_count($data){
    $id = file_get_contents("".$data."?&__a=1");
   	$id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['video_view_count'];
    return $count;
}
function random($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_text($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_text_capital($length) {
	$str = "";
	$characters = array_merge(range('A','B'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function random_text_capital_first($length) {
	$str = "";
	$characters = array_merge(range('H','I'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function random_text_capital_second($length) {
	$str = "";
	$characters = array_merge(range('R','S'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function random_text_capital_third($length) {
	$str = "";
	$characters = array_merge(range('M','N'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_number($length) {
	$str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_number_pembayaran($length) {
	$str = "";
	$characters = array_merge(range('0','3'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_code($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function check_bug($variable, $adicionaBarras = false) {
    $variable = preg_replace("/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i","".random(8)."", $variable);
    $variable = trim($variable);
    $variable = strip_tags($variable);
    if($adicionaBarras)
    $variable = addslashes($variable);
    return $variable;
}

function user_order($tabel, $limit) {
    global $db;
    $check_data = mysqli_query($db, "SELECT price, SUM(price) FROM ".$tabel." WHERE ".$limit);
    $get_data = mysqli_fetch_array($check_data);
    $result_data = $get_data['SUM(price)'];
    return $result_data;
}
    
function count_order($tabel, $limit) {
    global $db;
    $check_data = mysqli_query($db, "SELECT * FROM ".$tabel." WHERE ".$limit);
    $count_data = mysqli_num_rows($check_data);
    $result_data = $count_data;
    return $result_data;
}

function check_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP Tidak Dikenali';
 
    return $ipaddress;
}

function format_date($date){
	$month = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $date);
	return $pecahkan[2] . ' ' . $month[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function format_datetime($string){
    $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
 
    $date = explode(" ", $string)[0];
    $time = explode(" ", $string)[1];
    
    $tanggal = explode("-", $date)[2];
    $bulan = explode("-", $date)[1];
    $tahun = explode("-", $date)[0];
    
    
 
    return $tanggal . " " . $bulanIndo[abs($bulan)] . " " . $tahun . " " . $time;
}
function format_datetime_to_date($string){
    $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
 
    $date = explode(" ", $string)[0];
    $time = explode(" ", $string)[1];
    
    $tanggal = explode("-", $date)[2];
    $bulan = explode("-", $date)[1];
    $tahun = explode("-", $date)[0];
    
    
 
    return $tanggal . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
}