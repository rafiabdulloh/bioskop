<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
    
return array(
    // ...
    'db' => array(
    'driver' => 'Pdo',
    //'dsn' => 'mysql:dbname=labs;host=192.168.1.9', //source tutorial2
    'dsn' => 'mysql:dbname=ian;host=127.0.0.1:33064',
    //'username' => 'labs',
    'username' => 'root',
    //'password' => 'makeiteasy',
    'password' => 'Comrobal23',
    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
    ),
    'service_manager' => array(
    'aliases' => array(
        'db' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

);
?>