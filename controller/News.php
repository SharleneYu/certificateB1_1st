<?php  include_once "DB.php";

class News extends DB{

    function __construct(){
        parent::__construct('news');
    }

    function backend(){
        $view=['header'=>'最新消息資料管理',
                'table'=>$this->table,
                'rows'=>$this->paginate(5),
                'links'=>$this->links(),
                'addBtn'=>'新增最新消息',
                'modal'=> "./view/modal/news.php",
              ];
        return $this->view('./view/backend/news.php', $view);
    }


}


?>