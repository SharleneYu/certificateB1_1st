<?php include_once "../base.php";

//$_POST裡有以下資料：$_POST['text'][]、$_POST['text'][]、$_POST['sh']

$table=$_POST['table'];
$db=ucfirst($table);

$rows='';

//大部分的資料表都有text欄位，以default來處理，其他的各別處理：admin->acc, mvim & image->id
switch($talbe){
    case "admin":
        $rows=$_POST['acc'];
        break;
    case "image":
    case "mvim":
        $rows=$_POST['id'];
        break;
    default:
        $rows=$_POST['text'];
}

//因為是多筆資料來源，所以用foreach處理
foreach($rows as $id=>$row){
    //如果傳值內容有del，且del[]中有id，代表要刪除整筆；若del[]中沒有id，代表要更新文字
    //判斷刪除什麼、送到del()執行
    if(isset($_POST['del']) && in_array($id, $_POST['del'])){
        $$db->del($id);
    //依不同功能的修改需求，執行修改內容
    }else{
        $data=$$db->find($id);  //查詢修改文字的id

        switch($table){
            case "title":
                $data['text']=$row;
                $data['sh']=($_POST['sh']==$id)?1:0;
                break;
            case "admin":
                $data['acc']=$row;
                $data['pw']=$_POST['pw']['id'];
                break;
            case "menu":
                $data['text']=$row;
                $data['href']=$_POST['href']['id'];
                $data['sh']=(isset($_POST['sh']) && in_array($id, $_POST['sh']))?1:0;
                break;
            //POST中沒text的會用id顯示；有text會是ad或menu資料表，沒有text會是mvim或image
            default:
                if(isset($_POST['text'])){
                    $data['text']=$row;
                }
                $data['sh']=(isset($_POST['sh']) && in_array($id, $_POST['sh']))?1:0;
        }

        $$db->save($data);
    }
}

to("../backend.php?do=".$table);