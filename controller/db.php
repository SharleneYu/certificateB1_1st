<?php

class DB{
    protected $table;
    protected $pdo;
    protected $dsn="mysql:host=localhost; charset=utf8; dbname=db01";
    protected $links;

    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn, 'root', '');   
    }


    //STEP3: functions 給外面使用的

    function all(...$arg){
        $sql=" SELECT * FROM $this->table  ";
        $sql= $this->sql_all($sql, ...$arg);    //將上述句子，透過sql_all()重組句子
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function find($arg){
        $sql = " SELECT * FROM $this->table ";

        if(is_array($arg)){
            $tmp=$this->a2s($arg);
            $sql=$sql ." WHERE ". join(" && ", $tmp);
        }else{
            $sql=$sql. " WHERE `id` = '$arg' ";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function count(...$arg){
        $sql=" SELECT (*) FROM $this->table  ";
        $sql= $this->sql_all($sql, ...$arg);    //將上述句子，透過sql_all()重組句子
        return $this->pdo->query($sql)->fetchColumn();
    }

    function save($arg){   //有id為更新、沒id為新增
        if(isset($arg['id'])){
            $sql = " UPDATE $this->table SET ";
            $tmp = $this->a2s($arg);
            $sql=$sql .join(" , " ,$tmp);
            $sql=$sql . " WHERE `id`= '{$arg['id']}' ";
        }else{
            $keys= array_keys($arg);
            $values= $arg;
            $sql=" INSERT INTO $this->table (`".join("`,`",$keys)."`) VALUE ('".join("','",$values)."') ";
        }
        return $this->pdo->exec($sql);
    }

    function del($arg){
        $sql = " DELETE * FROM $this->table ";

        if(is_array($arg)){
            $tmp=$this->a2s($arg);
            $sql=$sql ." WHERE ". join(" && ", $tmp);
        }else{
            $sql=$sql. " WHERE `id` = '$arg' ";
        }
        return $this->pdo->exec($sql);
    }

    function max($col, ...$arg){
        return $this->math('max',$col,...$arg);
    }
    function min($col, ...$arg){
        return $this->math('min',$col,...$arg);
    }
    function sum($col, ...$arg){
        return $this->math('sum',$col,...$arg);
    }

    //STEP2: tools 工具型方法，只供內部使用
    
    //將陣列轉為[key=value, key=value, ...]
    protected function a2s($array){
        foreach($array as $key => $value){
            if($key!='id'){     //只處理不是id的，因為id是auto increment，不需要轉為key=value
                $tmp[] = "`$key`='$value'";
            }
        }
        return $tmp;   //將key=value的結果在$tmp，回傳給需要的地方
    }

    protected function sql_all($sql,...$arg){         //將sql語句組好，提供給all()用，丟到資料庫做執行
        if(!empty($arg)){      //$arg非空值，再檢查是陣列、還是值
            if(is_array($arg[0])){
                $tmp= $this->a2s($arg[0]);
                $sql= $sql ." WHERE ".join(" && ",$tmp);
            }else{
                $sql = $sql . $arg[0];    //$arg[0]非字串，就直接加在$sql句後
            }
            if(isset($arg[1])){           //通常有$arg[1]時會是非字串，就會直接加在$sql句後
                $sql=$sql. $arg[1];
            }
        }
        return $sql;           //$arg為空值，直接回傳$sql
    }
    protected function sql_one(...$arg){
    }

    protected function math($math,$col,...$arg){
        $sql = " SELECT $math($col) FROM $this->table ";

        $sql = $this->sql_all($sql,...$arg);

        return $this->pdo->query($sql)->fetchColumn();
    }


    //STEP4: view 畫面資料方法

    //用來載入資料
    function view($path, $arg){
        extract($arg);
        include($path);
    
    }

    function paginate($num, $arg=[]){
        $total= $this->count($arg);  //count($arg)取得資料庫表中的總筆數，做為分頁用
        $pages= ceil($total/$num);
        $now=$_GET['p']??1;          //$_GET['p']取得目前的頁碼，若未取得就當成第1頁
        $start=($now-1)*$num;        //透過$now，取得目前頁要從第幾筆開始撈資料

        $rows=$this->all($arg, " LIMIT $start, $num ");
        $this->links=[              //將paginate()中取得的資料存在links[]中，供links()使用
            'total' => $total,
            'pages' => $pages,
            'now' => $now,
            'start' => $start,
            'rows' => $rows,
            'table' => $this->table
        ];
        return $rows;
    }

    function links(){
        // 當頁為page2以上，出現" < "
        if($this->links['now']-1  >=1){
            $prev = $this->links['now']-1;
            echo "<a href='?do=$this->table&p=$prev'> &lt; </a>";
        }

        //將每頁頁碼印出
        for($i=1; $i<=$this->links['pages']; $i++){
            // 以三元運算式判斷是否為當前頁，T存24px到$size變數、F存16px到$size變數
            $size=($this->links['now']==$i)?'24px':'16px';
            echo "<a href='?do=$this->table&p=$i' style='font-size=$size'> $i </a>";
        }

        //當頁碼不是最後一頁，會出現 " > "
        if($this->links['now']+1 <= $this->links['pages']){
            $next = $this->links['now']+1;
            echo "<a href='?do=$this->table&p=$next'> &gt; </a>";
            
        }
    }

}


?>