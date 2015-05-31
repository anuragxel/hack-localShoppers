<?php

require_once('/var/www/html/cps_simple.php');
require_once('/var/www/html/init.php');
$cps = new CPS_Simple($cpsConn);
$login_query = CPS_Term($_POST['user_name'],'user_name').CPS_Term($_POST['password'],'password');
$records = $cps->search($login_query);


if(sizeof($records) == 1) {
	foreach($records as $id => $record) {
		$_SESSION['user_name'] = (string)$record->user_name;
		$_SESSION['user_is_logged'] = true;
		$_SESSION['user_id'] = (string)$record->id;
		$_SESSION['user_shop_name'] = (string)$record->shop_name;
	}
	//session_regenerate_id(true);
	//session_write_close();
	header('Location: '.'http://localhost/profile.php');
	exit;
}
else {
	header('Location: '.$base_url.'/index.html');
	exit;
}

?>
