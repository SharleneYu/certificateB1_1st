<?php  include_once "DB.php";

class Image extends DB{

    function __construct(){
        parent::__construct('image');
    }

    function backend(){
        $view=['header'=>'校園映象資料管理',
                'table'=>$this->table,
                'rows'=>$this->all(),
                'addBtn'=>'新增校園映象圖片',
                'modal'=> "./view/modal/image.php",
                'updateModal'=>"./view/modal/updateImage.php",
                'updateBtn'=>"更換圖片"
              ];
        return $this->view('./view/backend/image.php', $view);
    }



}


?>