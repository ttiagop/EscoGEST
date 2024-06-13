<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>EscoGEST · Entrar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

<link href="css/bootstrap-4.4.1.css" rel="stylesheet">


</head>
<body>
	
	
<?php
  include 'dbcon.php';
  session_start();
    if(isset($_SESSION["username"])) {
        header("Location: /pap");
        exit();
    }
?>
	
	
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <form id="login-form" action="login.php">
    <img src="logo.png" width="60%" alt="EscoGest"/>
    <p>
    <input type="text" id="username" name="username" placeholder="Número de processo" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="password" id="password" name="password" placeholder="Password" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" id="login" value="Entrar">
    </p>
  </form>
  <div id="create-account-wrap">
    <br>
    <p>Esqueceu-se da sua Password? <a href="#">Contactar Suporte</a><p>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
  <?php 

    include 'footer.php';


  ?>
  

</body>
</html>
