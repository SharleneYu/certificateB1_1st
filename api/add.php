<?php include_once "../base.php";

//從view/front/title.php中hidden取得table:title
$table=$_POST['table'];
//引用$Title命名為$db
$db=ucfirst($table);

$data=[];
// 判斷是否上傳成功：error code=0, tmp_name有值
if(!empty($_FILES['img']['tmp_name'])){
    $data['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "../upload/".$_FILES['img']['name']);
}

// 根據$table狀況，來決定把哪些資料寫入資料庫
switch($table){
    case 'title':
        $data['text']=$_POST['text'];
        $data['sh']=0;  //因為題目要求預設不顯示  
        break;
    case 'admin':
        $data['acc']=$_POST['acc'];
        $data['pw']=$_POST['pw'];
        break;
    case 'menu':
        $data['text']=$_POST['text'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
        break;
    default:
        if(isset($_POST['text'])){        
            $data['text']=$_POST['text'];
        }    
        $data['sh']=1;
}

$$db->save($data);
to("../backend.php?do=".$table);
