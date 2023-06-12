<?php
include_once "../base.php";

$data=[];
if(!empty($_FILES['img']['tmp_name'])){
    $data['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],'../upload/'.$_FILES['img']['name']);
}

$data['text']=$_POST['text'];
$data['sh']=0;

$Title->save($data);

to("../backend.php?do=title");