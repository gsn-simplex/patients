<?php
require_once('../../opsworks.php');
$owdata	= new OpsWorks();

$config['debug'] = 2;

$config['App.database'] = array(
        'host'       => $owdata->db->host,
        'login'      => $owdata->db->username,
        'password'   => $owdata->db->password,
        'database'   => $owdata->db->database
);

$config['App.phpunit_db'] = array(
        'database'   => 'PHPUnit_TestDB',
);
