<?php  include_once "DB.php";



class Menu extends DB{

    function __construct(){
        parent::__construct('menu');
    }

    function backend(){
        //在controller裡取得次選單數量供前端用：先取得所有的主選單
        $rows=$this->all(['main_id'=>0]);

        foreach($rows as $idx=>$row){
                    // 次選單的數量= 與主選單id相同的main_id筆數
                    $row['subs']=$this->count(['main_id'=>$row['id']]);
                    // 把迴圈中取出的資料，搭配$idx再放回到$rows陣列裡
                    $rows[$idx]=$row;
                }      

        $view=['header'=>'選單管理',
                'table'=>$this->table,
                'rows'=>$rows,
                'addBtn'=>'新增主選單',
                'modal'=> "./view/modal/menu.php",
                'updateModal'=>"./view/modal/subMenu.php",
                'updateBtn'=>"編輯次選單"
              ];
        return $this->view('./view/backend/menu.php', $view);
    }

    
   function show(){
        //先撈出主選單的資料陣列存在$rows (main_id=0)
        $rows=$this->all(['main_id'=>0]);
        // 在每個主選單裡再塞入次選單的資料
        foreach($rows as $idx=>$row){
            //撈出符合$row['id']主選單條件的次選單資料陣列，存入$row['subs']
            $row['subs']=$this->all(['main_id'=>$row['id']]);
            $rows[$idx]=$row;
        }
        return $rows;
    }
        
    


}


?>