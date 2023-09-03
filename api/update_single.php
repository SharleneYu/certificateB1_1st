<?php
    include_once "../base.php";

    $table=$_POST['table'];
    $db=ucfirst($table);
    
    //total & bottom資料表中只會有1筆資料
    $row=$$db->find(1);
    //將$_POST[$talbe]，存到$row的陣列
    $row[$table]=$_POST[$table];

    $$db->save($row);
    
    to("../backend.php?do=".$table);
?>