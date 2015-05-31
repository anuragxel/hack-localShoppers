<?php
session_start();

require_once('/var/www/html/cps_simple.php');
require_once('/var/www/html/prod_init.php');

if(!isset($_SESSION['user_is_logged'])) {
	header('Location: '.$base_url.'/index.html');
}

$cps = new CPS_Simple($cpsProdConn);

$query = CPS_Term($_SESSION[user_id],'shop_id').CPS_Term($_GET['prod_id'],'id');

$records = $cps->search($query);

if(sizeof($records) > 0) {
	$cps->delete($_GET['prod_id']);
}

header('Location: '.$base_url.'/profile.php');
exit();

?>