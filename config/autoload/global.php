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
    'dsn' => 'mysql:dbname=ian99;host=127.0.0.1:33064',
    'username' => 'root',
    'password' => 'Test123',
    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
    ),
    'service_manager' => array(
    'aliases' => array(
        'db' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

);
?>