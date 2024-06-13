   <?php  
      include 'auth_session.php'; 
      include 'dbcon.php';
   ?>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
   <script src="js/jquery-3.4.1.min.js"></script>
   
   <!-- Include all compiled plugins (below), or include individual files as needed --> 
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap-4.4.1.js"></script>

   <link href="css/bootstrap-4.4.1.css" rel="stylesheet">
   <link href="styles.css" rel="stylesheet">

   <script>
        function openPopup(url) {

            var width = 1280;
            var height = 720;
            var left = (window.innerWidth - width) / 2;
            var top = (window.innerHeight - height) / 2;
            var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;

            window.open(url, 'Popup', options);
        }
   </script>

   <?php 

            $nproc = $_SESSION['username'];

            $sql2 = "SELECT Nome, Foto, Turma, Tipo FROM utilizadores WHERE NProcesso = '$nproc'";
            $result2 = $conn->query($sql2); //esta query vai buscar o nome do utilizador, juntamente com o seu tipo de permissões

            $row2 = $result2->fetch_assoc();

            $alunoblob = $row2['Foto'];
            $tipo = $row2['Tipo'];

            $path = 'pPics/' . $nproc . '.png';
            
            if (file_put_contents($path, $alunoblob) !== false) {
                // gravado c sucesso
            } else {
                // erro
                echo "Erro ao gravar - $path";
            }

            $turma = $row2['Turma'];

         ?>

   
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <img src="logo.png" width="10%" alt="EscoGest"/>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto" style="">
             <!--<li class="nav-item active"> tratar disto!-->
             <li class="nav-item">
                <a class="nav-link" href="http://localhost/pap/">Inicio<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="chat/" onclick="openPopup(this.href); return false;">Chat</a>
             </li>


             <!--inicio do if para o tipo de utilizador!-->

             <?php if ($tipo == 1) { ?>

           <li class="nav-item">
                <a class="nav-link" href="horario">Horário</a>
             </li>
           <li class="nav-item">
                <a class="nav-link" href="tarefas">Tarefas</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="faltas">Faltas</a>
             </li>
             <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Meu menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="faltas">Faltas</a>               
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="info">Minha informação</a>
                </div>
             </li>!-->
         </ul>

            <?php } elseif ($tipo == 2) { ?>

           <li class="nav-item">
                <a class="nav-link" href="turmas">Turmas</a>
             </li>
         <li class="nav-item">
                <a class="nav-link" href="aulas">Aulas</a>
             </li>
             
         </ul>

         <?php } else { header('Location: nacess'); } ?>

         <!--fim do if para o tipo de utilizador!-->

         <!--Pfp e botão de logout-->
         <form class="form-inline my-2 my-lg-0" action="sair.php">
            <button class="btn btn-danger" type="submit">Sair</button>
         </form>
         <p>&nbsp;&nbsp;</p>
         <img src="pPics/<?php echo $nproc; ?>.png" width="5%" alt=""/>

       </div>
    </nav>
