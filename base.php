<?php

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db77";
    protected $table;
    protected $user="root";
    protected $pw="";
    protected $pdo;

    function __construct($table)
    {
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        $this->table=$table;
    }

    function all(...$arg){
        $sql="select * from $this->table ";

        if(!empty($arg)){
            if(is_array($arg[0])){

                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql=$sql . " where " . join(" && " ,$tmp);
            }else{
                $sql=$sql . $arg[0];
            }

            if(isset($arg[1])){
                $sql=$sql . $arg[1];
            }
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($arg){
        $sql="select * from $this->table ";

            if(is_array($arg)){

                foreach($arg as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql=$sql . " where " . join(" && " ,$tmp);
            }else{

                $sql=$sql . " where `id`='$arg'";
            }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function save($arg){

    }
    function del(...$arg){

    }
    function count(...$arg){

    }
    function math($math,$cols,...$arg){

    }



}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


$total=new DB('total');

dd($total->find(['id'=>1]));