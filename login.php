<?php 
  session_start();
  include 'header.php';
  //Autenticación de usuario
  if(isset($_POST['submit'])) {
      if($_POST["guardar_clave"]=="remember-me") {
        setcookie('name',$_POST['user'],time()+365,'/','localhost',0);
        setcookie('pass',$_POST['pwd'],time()+365,'/','localhost',0);
        //REFRESCA AL INSTANTE
        header("Refresh:0");
      }
      else {
        setcookie('name',"",time()+365,'/','localhost',0);
        setcookie('pass',"",time()+365,'/','localhost',0); 
      }
        if(!empty($_POST['user']) && !empty($_POST['pwd'])) {
          $user = $_POST['user'];
          $pwd = $_POST['pwd'];

        }
      }
  
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

  <h1 class="h3 mb-3 font-weight-normal">Por favor inicie sesion</h1>
    <form class="form-signin" method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
  <label for="inputName" class="sr-only"></label>
  <input type="text" id="inputName" name="user" class="form-control" placeholder="Nombre" required autofocus>
  <label for="inputPassword" class="sr-only"></label>
  <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Contraseña"  required>
    <div class="checkbox mb-3">
    <label>
      <input type="checkbox" name="guardar_clave" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Iniciar sesion</button>
</form>

<?php 
  include 'footer.php';
 ?>
</body>
</html>
