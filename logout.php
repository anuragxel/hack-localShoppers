<?php

require_once('/var/www/html/init.php');
session_unset();
session_destroy();

header('Location: '.$base_url.'/index.html');
exit();
?>