<?php
session_start();

require_once('/var/www/html/cps_simple.php');
require_once('/var/www/html/prod_init.php');

if(!isset($_SESSION['user_is_logged'])) {
	header('Location: '.$base_url.'/index.html');
}


$cps = new CPS_Simple($cpsProdConn);

$last_docs = $cps->listLast(array('document' => 'yes'),0,0);
$new_id = 1;
foreach($last_docs as $id => $last) {
	$new_id = $last->id + 1;
}

$document = array(
	'prod_name' => $_POST['prod_name'],
	'price'  => $_POST['price'],
	'shop_id'  => $_SESSION['user_id'],
);

$cps->insertSingle($new_id, $document);

header('Location: '.$base_url.'/profile.php');
exit();

?>