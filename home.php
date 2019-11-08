<?php 
  session_start();
  include 'header.php';
  echo "<h1> BIENVENIDO " . $_SESSION['user'] . "</h1>";
  if( isset($_COOKIE['name']) )
         echo "El valor de la Cookie 'nombre' es [".$_COOKIE['name']."]";
    else
        echo "No existe la Cookie";
 ?>


<a href = "logout.php">Desconectar</a>

<?php 
  include 'footer.php';
 ?>
</body>
</html>