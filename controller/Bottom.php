<?php
//將DB.php中的class DB繼承為不同功能用的class

include_once "DB.php";

// 
class Bottom extends DB{

    function __construct()
    {
        parent::__construct('bottom');
    }

}


?>