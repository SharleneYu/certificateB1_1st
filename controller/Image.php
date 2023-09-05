<?php  include_once "DB.php";

class Image extends DB{

    function __construct(){
        parent::__construct('image');
    }

    function backend(){
        $view=['header'=>'校園映象資料管理',
                'table'=>$this->table,
                'rows'=>$this->paginate(3),
                'links'=>$this->links(),
                'addBtn'=>'新增校園映象圖片',
                'modal'=> "./view/modal/image.php",
                'updateModal'=>"./view/modal/updateImage.php",
                'updateBtn'=>"更換圖片"
              ];
        return $this->view('./view/backend/image.php', $view);
    }

    function num(){
        return $this->count(['sh'=>1]);
    }

    function show(){
        //將sh=1的資料撈出來, 存在$rows
        $rows = $this->all(['sh'=>1]);

        foreach($rows as $idx => $row){
            ?>
                <div class="im" id="ssaa<?=$idx;?>">
                    <img src="./upload/<?=$row['img'];?>" style="width:150px; height:103px;">
                </div>
            <?php
        }
    }
}
