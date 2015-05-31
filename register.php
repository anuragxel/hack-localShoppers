<?php

session_start();

require_once('/var/www/html/cps_simple.php');
require_once('/var/www/html/init.php');

if(isset($_SESSION['user_is_logged'])) {
	header('Location: '.$base_url.'/profile.php');
	exit();
}

$cps = new CPS_Simple($cpsConn);
$last_docs = $cps->listLast(array('document' => 'yes'),0,0);

$new_id = 0;
foreach($last_docs as $id => $last) {
	$new_id = $last->id + 1;
}

$user_name_query = CPS_Term($_POST['user_name'],'user_name');
$same_user_name = $cps->search($user_name_query);

if(sizeof($same_user_name) > 0 || strcmp($_POST['password'],$_POST['re_password']) != 0) {
	header('Location: '.$base_url.'/register.html');	
	exit();
}

$document = array(
	'user_name' => $_POST['user_name'],
	'shop_name' => $_POST['shop_name'],
	'password'  => $_POST['password'],
	'category'  => $_POST['category'],
	'coordinates' => array(
		'lat' => $_POST['lat'],
		'long' => $_POST['lon'],
	)
);

$cps->insertSingle($new_id, $document);
header('Location: '.$base_url.'/index.html');
exit();

?>
