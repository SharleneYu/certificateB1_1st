<?php  include_once "DB.php";



class Mvim extends DB{

    function __construct(){
        parent::__construct('mvim');
    }

    function backend(){
        $view=['header'=>'動畫圖片管理',
                'table'=>$this->table,
                'rows'=>$this->all(),
                'addBtn'=>'新增動畫圖片',
                'modal'=> "./view/modal/mvim.php",
                'updateModal'=>"./view/modal/updateMvim.php",
                'updateBtn'=>"更換動畫"
              ];
        return $this->view('./view/backend/mvim.php', $view);
    }

    function show(){
        //將sh=1的資料撈出來, 存在$rows
        $rows = $this->all(['sh'=>1]);

        foreach($rows as $row){
            //每則影片都要執行以下處理
            ?>
                lin.push("./upload/<?=$row['img'];?>");
            <?php

        }

    }

}


?>