<?php
date_default_timezone_set("Asia/Taipei");

//$BASEDIR=$_SERVER['DOCUMENT_ROOT'];  //這個適合伺服器只有單一網站

//__DIR__適合伺服器上有多個網站的狀況
$BASEDIR=__DIR__;
session_start();

include_once __DIR__."/controller/Ad.php";
include_once __DIR__."/controller/Admin.php";
include_once __DIR__."/controller/Bottom.php";
include_once __DIR__."/controller/Image.php";
include_once __DIR__."/controller/Menu.php";
include_once __DIR__."/controller/Mvim.php";
include_once __DIR__."/controller/News.php";
include_once __DIR__."/controller/Title.php";
include_once __DIR__."/controller/Total.php";

$Ad= new Ad;
$Admin= new Admin;
$Bottom= new Bottom;
$Image= new Image;
$Menu= new Menu;
$Mvim= new Mvim;
$News= new News;
$Title= new Title;
$Total= new Total;









//除錯用
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

//用在客製化的查詢SQL
function q($sql){
    $pdo=new PDO("mysql:host=localhost; charset=utf8; dbname=db01", 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

?>