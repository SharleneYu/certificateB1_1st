<?php
class DB{

    //STEP1
    protected $table;
    protected $pdo;
    protected $dsn="mysql: host=localhost; charset=utf8; dbname=db01";
    protected $links;

    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn, 'root', '');
    }


//STEP2: protected function用來組SQL字串
protected function a2s($array){
    foreach($array as $key=>$value){
        if($key!='id'){
            $tmp[]="`$key`='$value'";
        }
    }
    return $tmp;
}

//提供給all(), count() 接用
protected function sql_all($sql, ...$arg){
    if(isset($arg[0])){

        if(is_array($arg[0])){
            $tmp=$this->a2s($arg[0]);
            $sql = $sql . " WHERE ".join(" && ",$tmp);
        }else{
            $sql=$sql . $arg[0];
        }
    }
    if(isset($arg[1])){
        $sql=$sql . $arg[1];
    }
    return $sql;
}

protected function sql_one($sql,$arg){
    if(is_array($arg)){
        $tmp=$this->a2s($arg);
        $sql = $sql . " WHERE " . join(" && ",$tmp);
    }else{
        $sql = $sql. " WHERE `id`='$arg' ";
    }
    return $sql;
}

protected function math($math, $col, ...$arg){
    $sql= " SELECT $math($col) FROM $this->table ";
    $sql = $this->sql_all($sql, ...$arg);
    return $this->pdo->query($sql)->fetchColumn();
}

    
    //STEP3
    function all(...$arg){
        $sql=" SELECT * FROM $this->table ";
        $sql= $this->sql_all($sql, ...$arg);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count(...$arg){
        $sql=" SELECT COUNT(*) FROM $this->table ";
        $sql= $this->sql_all($sql, ...$arg);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function find($arg){
        $sql = " SELECT * FROM $this->table ";

        if(is_array($arg)){
            $tmp=$this->a2s($arg);
            $sql = $sql. " WHERE ".join(" && ",$tmp);
        }else{
            $sql= $sql. " WHERE `id`=$arg";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($arg){
        if(isset($arg['id'])){
            $tmp=$this->a2s($arg);
            $sql = " UPDATE $this->table SET " .join(",",$tmp);
            $sql=$sql . " WHERE `id`='{$arg['id']}' ";
        }else{
            $keys=join("`,`",array_keys($arg));
            $values=join("','",$arg);
            $sql = " INSERT INTO $this->table (`".$keys."`) VALUES ('".$values."') ";
        }
        return $this->pdo->exec($sql);
    }

    function del($arg){
        $sql =  " DELETE FROM $this->table ";
        $sql =  $this->sql_one($sql, $arg);
        return $this->pdo->exec($sql);
    }

    function max($col,...$arg){
        return $this->math('max', $col, ...$arg);
    }

    function min($col,...$arg){
        return $this->math('min', $col, ...$arg);
    }

    function sum($col,...$arg){
        return $this->math('sum', $col, ...$arg);
    }


    //$path是路徑，$arg是相關參數的陣列 (允許是空值)
    function view($path, $arg=[]){
        extract($arg);    //先解包陣列，將裡面的參數供頁面使用
        include($path);   //引入$path來使用參數
    }

    //$num分頁筆數，$arg[]放其他相關條件
    function paginate($num, $arg=[]){
        //算共有幾筆$total、要分成幾頁$pages
        $total=$this->count($arg);
        $pages=ceil($total/$num);
        //從Get取得目前頁數$now、再算要從第幾筆開始取資料$start
        $now=$_GET['p']??1;
        $start=($now-1)*$num;
        // 以all帶入取資料的條件，放入資料庫取資料後回傳$rows
        $rows=$this->all($arg," LIMIT $start, $num");
        
        // 將要提供給links()的資料存在陣列$links
        $this->links=[
            'total'=>$total,
            'pages'=>$pages,
            'now'=>$now,
            'start'=>$start,
            'table'=>$this->table           
        ];
        return $rows;
    }

    //
    function links(){
        if($this->links['now']-1 >=1){
            $prev=$this->links['now']-1;
            echo "<a href='?do=$this->table&p=$prev'>&lt;</a>";
        }

        for($i=1; $i<=$this->links['pages'];$i++){
            $size=($this->links['now']==$i)?'24px':'18px';
            echo "<a href='?do=$this->table&p=$i' style='font-size:$size'> $i </a>";
        }

        if($this->links['now']+1 <= $this->links['pages']){
            $next=$this->links['now']+1;
            echo "<a href='?do=?do=$this->table&p=$next'>&gt;</a>";
        }

    }





}





?>
