<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	
	<?php include 'header.php'; ?>

	<div class="content">
		
				<?php

		$turmaid = $_GET['t'];
		$tarefaid = $_GET['et'];

		$getidturma = "SELECT `IDTurma` FROM `turma_disciplina` WHERE IDReg = '$turmaid' AND IDProf = '$nproc'";

            $resultidturma = $conn->query($getidturma);
                
                if ($resultidturma->num_rows > 0) {
                    $rowidt = $resultidturma->fetch_assoc();
                    $idt = $rowidt['IDTurma'];
                    

                } else {
                    header('Location: nacess');
                }


		$sqlturmas = "SELECT IDTurma, IDReg, IDDisciplina FROM turma_disciplina WHERE IDProf = '$nproc'";
      	$resultturmas = $conn->query($sqlturmas);
        
        
        	if ($resultturmas->num_rows > 0) {
        	    	$rowturmas = $resultturmas->fetch_assoc();
        	      $reg = $rowturmas['IDReg'];
        	      $turma = $rowturmas['IDTurma'];
        	      $disciplina = $rowturmas['IDDisciplina'];

        	      $sqlturmas2 = "SELECT AnoLetra, IDDiretor FROM turmas WHERE IDTurma = '$idt'";
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

        					$sqltarefa = "SELECT TituloTarefa, DataFim FROM tarefas WHERE IDTarefa = '$tarefaid'";
      						$resulttarefa = $conn->query($sqltarefa);
        					
        					
        						if ($resulttarefa->num_rows > 0) {
        						    $rowtarefas = $resulttarefa->fetch_assoc();
        						   	$titulot = $rowtarefas['TituloTarefa'];
        						   	$fim = $rowtarefas['DataFim'];
        						   }
	?>

		<h1><?php echo $titulot; ?></h1>
		<h3><?php echo $nometurma, " - ", $nomedisciplina;?></h3>
		<br>
		<div class="alunos">
		<?php

			$sqlalunos = "SELECT NProcesso, Nome FROM utilizadores WHERE Turma = '$idt'";
        	$resultalunos = $conn->query($sqlalunos);

			if ($resultalunos->num_rows > 0) {
        	    while ($rowalunos = $resultalunos->fetch_assoc()) {
        	        $npaluno = $rowalunos['NProcesso'];
        	        $nomealuno = $rowalunos['Nome'];



			$np = $_SESSION["username"];

			$sqlcheck = "SELECT * FROM entrega_tarefa WHERE IDTarefa = '$tarefaid' AND NProcesso = '$npaluno';";
        	$resultcheck = $conn->query($sqlcheck);
        
        
        	if ($resultcheck->num_rows > 0) {
        		$rowcheck = $resultcheck->fetch_assoc();
        		$ficheiroentrega = $rowcheck['Ficheiro'];
        		$dataentrega = $rowcheck['DataEntrega'];

        		$fim = $rowtarefas['DataFim'];

        		$f = substr($fim, 0, 4) . substr($fim, 5, 2) . substr($fim, 8, 2) . substr($fim, 11, 2) . substr($fim, 14, 2);


        		$de = substr($dataentrega, 0, 4) . substr($dataentrega, 5, 2) . substr($dataentrega, 8, 2) . substr($dataentrega, 11, 2) . substr($dataentrega, 14, 2);


        	   	?>

        	   	


		<div class="col">
         <div class="card shadow-sm">
         <div class="card-body">
            <h3 class="card-text"><a class="hiperligacoesInicio" href="chat/" onclick="openPopup(this.href); return false;"><?php echo $nomealuno; ?></a></h3>
            <div class="download">
			<?php $nficheiroentrega = substr($ficheiroentrega, 8); ?>

			<a class="nav-link" href="<?php echo $ficheiroentrega; ?>" target="_blank"><img src="icons/page-file-icon.png" class="rounded float-left" alt="<?php echo $nficheiroentrega; ?>" style="width: 20%;"><?php echo $nficheiroentrega; ?></a>

			<?php 

			if (($f - $de) < 0) {
        			echo "<h3 style='color: #e6c80b;'>Entregue com atraso</h3>";
        		}
        		
			?>

		</div>
         </div>

          </div>
        </div><br>

         <?php	} else { ?>

         	<div class="col">
         <div class="card shadow-sm">
         <div class="card-body">
            <h3 class="card-text"><a class="hiperligacoesInicio" href="chat/" onclick="openPopup(this.href); return false;"><?php echo $nomealuno; ?></a></h3>
            <div class="download">
			<p style="color: red;"><b>Não entregue</b></p>
			
		</div>
         </div>

          </div>
        </div><br>

         <?php
         }


      } ?>
         <?php }

		?>
	
	</div>

		<?php include 'footer.php'; ?>
		
	</div>


</body>
</html>