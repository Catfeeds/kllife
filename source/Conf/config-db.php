<?php
$config = array();
$config['db']['default']['host']        = '127.0.0.1';
$config['db']['default']['port']        = '3306';
$config['db']['default']['charset']     = 'utf8';
$config['db']['default']['tablepre']    = 'kl_';

$config['common']['cookiepre']          = 'd62a_';
$config['common']['authkey']            = 'c504a686';

// local test
//$config['db']['default']['username']    = 'root';
//$config['db']['default']['password']    = 'root';
//$config['db']['default']['database']    = 'kllife';

// online test
$config['db']['default']['username']    = 'managekllife';
$config['db']['default']['password']    = 'B8QRKSDrVHE8HUFb';
$config['db']['default']['database']    = 'managekllife';

// online
//$config['db']['default']['username']    = 'kllife';
//$config['db']['default']['password']    = 'kuaile1@#3';
//$config['db']['default']['database']    = 'kllife';

// lechikeji
//$config['db']['default']['username']    = 'root';
//$config['db']['default']['password']    = 'LEchi868*';
//$config['db']['default']['database']    = 'db_kllife';

return $config;
?>