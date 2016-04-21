<?php

// Doctrine (db)

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'selldreams',
    'user'     => 'selldreams_user',
    'password' => 'MonSecret',
);

/*
// MySQL config for OpenShift
$app['db.options'] = array(
    'charset'  => 'utf8',
    'host'     => getenv('OPENSHIFT_MYSQL_DB_HOST'),
    'dbname'   => getenv('OPENSHIFT_GEAR_NAME'),
    'user'     => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
    'password' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
);
 * 
 */
