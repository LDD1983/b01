<?php
include_once "../base.php";

$data=[];

$data['text']=$_POST['text'];
$data['sh']=1;

$Ad->save($data);

to("../backend.php?do=ad");