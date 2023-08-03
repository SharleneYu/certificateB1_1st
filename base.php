<?php   // base.php 決定主要的目錄

// $BASEDIR = $_SERVER['DOCUMENT_ROOT'];   //會出現 C:/Users/sharl/Documents/PHP_files/web01
$BASEDIR=__DIR__;                          //會出現 C:\Users\sharl\Documents\PHP_files\web01
session_start();

include_once $BASEDIR . "/controller/Ad.php";
include_once $BASEDIR . "/controller/Admin.php";
include_once $BASEDIR . "/controller/Bottom.php";
include_once $BASEDIR . "/controller/Image.php";
include_once $BASEDIR . "/controller/Menu.php";
include_once $BASEDIR . "/controller/Mvim.php";
include_once $BASEDIR . "/controller/News.php";
include_once $BASEDIR . "/controller/Title.php";
include_once $BASEDIR . "/controller/Total.php";

function to($url){
    header("location:" .$url);
}

//用在客製化的查詢 (無法用class DB中的all())
function q($sql){
    $pdo=new PDO("mysql:host=localhost; charset=utf8; dbname=db01", 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

//除錯用，若很熟可以不用寫
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Ad= new Ad;
$Admin= new Admin;
$Bottom= new Bottom;
$Image= new Image;
$Menu= new Menu;
$Mvim= new Mvim;
$News= new News;
$Title= new Title;
$Total= new Total;




?>