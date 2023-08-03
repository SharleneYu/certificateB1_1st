<?php
//將DB.php中的class DB繼承為不同功能用的class

include_once "DB.php";

// 
class Ad extends DB{

    function __construct()
    {
        parent::__construct('ad');
        // echo "Hello";
    }

}


?>