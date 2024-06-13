<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EscoGEST - Página Inicial</title>
  </head>
   <body>

   <?php include 'header.php'; ?>

   <div class="content">
      
      <h1>Bem-vindo <?php echo $row2['Nome']; ?></h1>
      <br>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <?php 

        if ($tipo == 1) { ?>

      <div class="col">
         <div class="card shadow-sm">
            <!-- imagem bootstrap  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="logo.png" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>!-->
         <div class="card-body">
            <h1 class="card-text"><a class="hiperligacoesInicio" href="chat/" onclick="openPopup(this.href); return false;">Chat</a></h1>
         </div>
         <!--<img class="bd-placeholder-img card-img-bottom" width="100%" height="225" src="chat.png" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">!--><title>Chat</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></img>
          </div>
        </div>
      <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <h1 class="card-text"><a class="hiperligacoesInicio" href="tarefas">Tarefas</a></h1>
            </div>
          </div>
        </div>
      <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <h1 class="card-text"><a class="hiperligacoesInicio" href="horario">Horário</a></h1>
            </div>
          </div>
        </div>

        <!--fim if tipo!-->

    <?php }

          if ($tipo == 2) {
      ?>

    </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <!--inicio if tipo!-->

      <div class="col">
         <div class="card shadow-sm">
            <!-- imagem bootstrap  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="logo.png" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>!-->
         <div class="card-body">
            <h1 class="card-text"><a class="hiperligacoesInicio" href="chat/" onclick="openPopup(this.href); return false;">Chat</a></h1>
         </div>
         <!--<img class="bd-placeholder-img card-img-bottom" width="100%" height="225" src="chat.png" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">!--><title>Chat</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></img>
          </div>
        </div>
      <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <h1 class="card-text"><a class="hiperligacoesInicio" href="turmas">Turmas</a></h1>
            </div>
          </div>
        </div>
      <div class="col">
          <div class="card shadow-sm">
            <div class="card-body">
              <h1 class="card-text"><a class="hiperligacoesInicio" href="aulas">Aulas</a></h1>
            </div>
          </div>
        </div>

        <!--fim if tipo!-->

      <?php } ?>

      </div>
         
      </div>
      
      <div style="padding-top: 10%;">
      <?php include 'footer.php'; ?>
      </div>
   </body>
</html>
