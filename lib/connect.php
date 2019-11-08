<?php 



  //var_dump($_POST);
  //Proveedor de datos: MySQL
  $config=['user'=>'db0',
      'pwd'=>'linuxlinux'];
  //Abrir conexion
  try{
    $dbh = new PDO('mysql:host=localhost;dbname=DB0', $config['user'], $config['pwd']);   
  }
  catch(PDOException $e) {
    //echo 'Error de conexion';
    echo $e->getMessage();
  }
  //Hacer una consulta
  $stmt = $dbh -> prepare("SELECT user, pwd FROM users WHERE user = :user AND pwd = :pwd");
  $stmt -> bindParam(':user', $user);
  $stmt -> bindParam(':pwd', $pwd);
  $result = $stmt -> execute();
  if ($stmt -> rowCount() == 1) {
    //Coincidencias de usuario
    $_SESSION['user'] = $user;
    header('Location:home.php');
  }
  //$result = $stmt -> execute([$user, $pwd)];
  $arr = $stmt -> fetchAll(/*PDO::FETCH_CLASS*/);
 ?>