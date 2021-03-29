<?php
include 'bd/BD.php';
header("Access-Control-Allow-Origin: *");

if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(isset($_get['id'])){
        $query="SELECT * from frameworks where id=".$_get["id"];
        $resultados=metodoGet($query);
            echo json_encode($resultados->fetch(PDO::FETCH_ASSOC));
        
    }else{
        $query="select from frameworks";
        $resultados=metodoGet($query);
            echo json_encode($resultados->fetchAll());
    }
    header("HTTP/1.1 200 ok");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre'];
    $lanzamiento=$_POST['lanzamiento'];
    $desarrollador=$_POST['desarrollador'];
   $query="INSERT into frameworks(nombre, lanzamiento, desarrollador) values('$_nombre', '$lanzamiento', '$_desarrollador')";
   $queryAutoIncrement="select MAX(id) as id from frameworks";
   $resultados=metodoPost($query, $queryAutoIncrement);
   echo json_encode($resultados);
   header("HTTP/1.1 200 ok");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nombre=$_POST['nombre'];
    $lanzamiento=$_POST['lanzamiento'];
    $desarrollador=$_POST['desarrollador'];
   $query="UPDATE into frameworks SET nombre = '$_nombre', lanzamiento ='$lanzamiento', desarrollador = '$_desarrollador' where id='$id'";
   $resultados=metodoPut($query);
   echo json_encode($resultados);
   header("HTTP/1.1 200 ok");
    exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
   $query="DELETE into frameworks where id='$id'";
   $resultados=metodoDelete($query);
   echo json_encode($resultados);
   header("HTTP/1.1 200 ok");
    exit();
}
header("HTTP/1.1 400 Request");

?>