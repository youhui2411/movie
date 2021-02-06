<?php
function getConnect(){
    $config = array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'movie',
        'charset' => 'utf8'
    );
    $link = mysqli_connect($config['host'], $config['user'], $config['password'], $config['dbname']);
    mysqli_set_charset($link, $config['charset']);
    return $link;
}
