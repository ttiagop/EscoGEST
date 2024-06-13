<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Direção de Turma</title>
</head>
<body>
	
	<?php 

		include 'header.php'; 

		$getidturma = "SELECT `IDTurma` FROM `turmas` WHERE IDDiretor = '$nproc'";

            $resultidturma = $conn->query($getidturma);
                
                if ($resultidturma->num_rows > 0) {
                    $rowidt = $resultidturma->fetch_assoc();
                    $idt = $rowidt['IDTurma'];
                    

                } else {
                    header('Location: nacess');
                }

		$sqlturmas = "SELECT IDTurma, IDReg, IDDisciplina FROM turma_disciplina WHERE IDReg = '$idt'";
      	$resultturmas = $conn->query($sqlturmas);
        
        
        	if ($resultturmas->num_rows > 0) {
        	    	$rowturmas = $resultturmas->fetch_assoc();
        	      $reg = $rowturmas['IDReg'];
        	      $turma = $rowturmas['IDTurma'];
        	      $disciplina = $rowturmas['IDDisciplina'];

        	      $sqlturmas2 = "SELECT AnoLetra, IDDiretor FROM turmas WHERE IDTurma = '$turma'";
        			$resultturmas2 = $conn->query($sqlturmas2);
        			
        			if ($resultturmas2->num_rows > 0) {

        				$rowturmas2 = $resultturmas2->fetch_assoc();

        				$nometurma = $rowturmas2['AnoLetra'];
        				$dt = $rowturmas2['IDDiretor'];

        				$sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        				$resultdisciplinas2 = $conn->query($sqldisciplinas2);
	        				
	        				if ($resultdisciplinas2->num_rows > 0) {
	
	        					$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
	
        					$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        					
        						$sqldt = "SELECT Nome FROM utilizadores WHERE NProcesso = '$dt'";
        						$resultdt = $conn->query($sqldt);
	        				
	        					if ($resultdt->num_rows > 0) {
	
	        						$rowdt = $resultdt->fetch_assoc();
        							$nomedt = $rowdt['Nome']; 

        						}}
        					}}
	?>

	<div class="content">

		<h2><?php echo $nometurma; ?> - Direção de turma</h2>
		<br>
		<nav class="navbar navbar-expand-lg rounded">
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		
		  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="faltasdt"><b>Ver faltas</b></a>
		      </li>
		    </ul>
		  </div>
		</nav>
		<br>
		<div class="alunos">
		<?php

			$sqlalunos = "SELECT NProcesso, Nome FROM utilizadores WHERE Turma = '$turma'";
        	$resultalunos = $conn->query($sqlalunos);

			if ($resultalunos->num_rows > 0) {
        	    while ($rowalunos = $resultalunos->fetch_assoc()) {
        	        $npaluno = $rowalunos['NProcesso'];
        	        $nomealuno = $rowalunos['Nome'];

		?>

			<div class="gallery">
			    <img src="pPics/<?php echo $npaluno;?>.png" alt="">
			  <div class="descf"><?php echo $nomealuno; ?></div>
			</div>
		

         <?php	}} ?>

     </div></div>


</body>
</html>