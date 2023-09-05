<?php include_once "../base.php";

//傳值內容會有2類：
// $_POST['text'] , $_POST['href']    => update
// $_POST['text2'], $_POST['href2']   => insert into


if(isset($_POST['text'])){
    foreach($_POST['text'] as $id=>$text){
        // 如果有陣列中有del，且$id存在於$_POST['del']中，要刪除該筆資料
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){
            $Menu->del($id);
        // 若非刪除，就是要做更新。先把資料撈出來
        }else{
            $row= $Menu->find($id);
            $row['text']=$text;
            $row['href']=$_POST['href'][$id];

            $Menu->save($row);
        }
    }
}


if(isset($_POST['text2'])){
    foreach($_POST['text2'] as $idx=>$text){
        if($text!=''){
            $Menu->save([
                'text'=>$text,
                'href'=>$_POST['href2'][$idx],
                'sh'=>1,
                'main_id'=> $_POST['main_id']
            ]);

        }
    }
}

to("../backend.php?do=".$_POST['table']);