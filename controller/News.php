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

    function show(){
        //將sh=1的資料撈出來, 存在$rows。加上條件只能5筆
        $rows = $this->all(['sh'=>1], " LIMIT 5 ");

        foreach($rows as $row){
            echo "<li>";    
            echo mb_substr($row['text'], 0, 20);
            echo "<span class='all' style='display:none'>";
            echo $row['text'];
            echo "</span>";
            echo "</li>";   
        }
        return;

    }

    function more(){
        //若最新消息有超過5則，
        // if($this->count(['sh'=>1] >5)){
        if($this->count(['sh'=>1])>5){
            echo "<a href='?do=news' style='float:right'>";
            echo "More...";
            echo "</a>";
        }
    }

    //改自$News->show()
    function moreNews(){
        //將sh=1的資料撈出來, 存在$rows。加上條件只能5筆
        $rows = $this->paginate(5, ['sh'=>1]);
        $start=$this->links['start']+1;

        echo "<ol start='$start'>";

        foreach($rows as $row){
            echo "<li>";    
            echo mb_substr($row['text'], 0, 20);
            echo "<span class='all' style='display:none'>";
            echo $row['text'];
            echo "</span>";
            echo "</li>";   
        }
        echo "</ol>";
        echo "<div class='cent'>";
        echo $this->links();
        echo "</div>";

    }
      
      





}


?>

