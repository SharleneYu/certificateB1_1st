<?php  include_once "DB.php";

class Title extends DB{

    function __construct(){
        parent::__construct('title');
    }

    function backend(){
        $view=['header'=>'網站標題管理',
                'table'=>$this->table,
                'rows'=>$this->all(),
                'addBtn'=>'新增網站標題圖片',
                'modal'=> "./view/modal/title.php",
                'updateModal'=>"./view/modal/updateTitle.php",
                'updateBtn'=>"更新圖片"
              ];
        return $this->view('./view/backend/title.php', $view);
    }

    function show(){
        //將sh=1的資料撈出來, 存在$row。傳值是單筆陣列，要在前端使用時再加上['key']
        return $this->find(['sh'=>1]);
    }

}


?>