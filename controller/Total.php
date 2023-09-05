<?php  include_once "DB.php";



class Total extends DB{

    function __construct(){
        parent::__construct('total');
    }

    function backend(){
        $view=['header'=>'進站總人數管理',
                'table'=>$this->table,
                'total'=>$this->find(1)['total']
              ];
        return $this->view('./view/backend/total.php', $view);
    }

    //老師做法多一個show()，SYU做法，直接在前台$Total->find(1)['total']
    function show(){
        return $this->find(1)['total'];
    }

}


?>