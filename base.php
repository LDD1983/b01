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
        if(isset($arg['id'])){
            //update
            foreach($arg as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql="update $this->table set ".join(',',$tmp)." where `id`='{$arg['id']}'";
        }else{
            //insert

            $cols=array_keys($arg);

            $sql="insert into  $this->table (`".join("`,`",$cols)."`) 
                                      values('".join("','",$arg)."')";
        }

        return $this->pdo->exec($sql);
    }
    function del($arg){
        $sql="delete from $this->table ";

            if(is_array($arg)){

                foreach($arg as  $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql=$sql . " where " . join(" && " ,$tmp);
            }else{
                $sql=$sql . $arg;
            }

        return $this->pdo->exec($sql);
    }

    function count(...$arg){
        $result=$this->all(...$arg);
        return count($result);
    }

    function sum($col,...$arg){
        return $this->math('sum',$col,...$arg);
    }
    function max($col,...$arg){
        return $this->math('max',$col,...$arg);
    }
    function min($col,...$arg){
        return $this->math('min',$col,...$arg);
    }
    function avg($col,...$arg){
        return $this->math('avg',$col,...$arg);
    }

    function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";

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

        return $this->pdo->query($sql)->fetchColumn();
    }

}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
 header("location:".$url);
}

function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db77",'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


$Total=new DB('total');
$Bottom=new DB("bottom");
$Title=new DB("title");
$Ad=new DB("ad");