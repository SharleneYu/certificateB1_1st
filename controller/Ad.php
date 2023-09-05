<?php  include_once "DB.php";



class Ad extends DB{

    function __construct(){
        parent::__construct('ad');
    }

    function backend(){
        $view=['header'=>'動態文字廣告管理',
                'table'=>$this->table,
                'rows'=>$this->all(),
                'addBtn'=>'新增動態文字廣告',
                'modal'=> "./view/modal/ad.php",
              ];
        return $this->view('./view/backend/ad.php', $view);
    }

    function show(){
        //將sh=1的資料撈出來, 存在$rows
        $rows = $this->all(['sh'=>1]);

        //將撈出的陣列組成一個長字串。可用foreach，或用array_columns取出特定key的值、再join成長字串
        $marquee = join(" &nbsp;&nbsp ", array_column($rows, 'text'));
        return $marquee;

    }


}


