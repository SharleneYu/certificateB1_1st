<?php include_once "../base.php";
//從add.php複製修改

$table=$_POST['table'];
$id=$_POST['id'];
$db=ucfirst($table);
$row=$$db->find($id);

if(!empty($_FILES['img']['tmp_name'])){
    $row['img']=$_FILES['img']['name'];

    move_uploaded_file($_FILES['img']['tmp_name'], "../upload/".$_FILES['img']['name']);
}

$$db->save($row);
to("../backend.php?do=".$table);