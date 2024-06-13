<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tarefas</title>
</head>
<body>

	<?php include 'header.php'; ?>

	<div class="content">

		<?php 

			$tr = $_GET['tr'];

        	$sqltarefas = "SELECT IDTarefa, IDReg, TituloTarefa, DescTarefa, DataPub, DataFim, TrancarEntrega,Anexo FROM tarefas WHERE IDTarefa = '$tr'";
        	$resulttarefas = $conn->query($sqltarefas);
        
        
        	if ($resulttarefas->num_rows > 0) {
        		$rowtarefas = $resulttarefas->fetch_assoc();

        	   	$idtarefa = $rowtarefas['IDTarefa'];
        	   	$reg = $rowtarefas['IDReg'];
        	   	$titulo = $rowtarefas['TituloTarefa'];
        	   	$desc = $rowtarefas['DescTarefa'];
        	   	$pub = $rowtarefas['DataPub'];
        	   	$fim = $rowtarefas['DataFim'];
        	   	$tranca = $rowtarefas['TrancarEntrega'];
        	   	$anexo = $rowtarefas['Anexo'];

        	   }

        	$sqldisciplinas = "SELECT IDDisciplina, IDProf FROM turma_disciplina WHERE IDReg = '$reg'";
        	$resultdisciplinas = $conn->query($sqldisciplinas);
        
        
        	if ($resultdisciplinas->num_rows > 0) {
        			$rowdisciplinas = $resultdisciplinas->fetch_assoc();
        	       	$disciplina = $rowdisciplinas['IDDisciplina'];
        	       	$idprof = $rowdisciplinas['IDProf'];

        	        $sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        			$resultdisciplinas2 = $conn->query($sqldisciplinas2);
        			
        			if ($resultdisciplinas2->num_rows > 0) {

        				$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();

        				$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        			}
        	    }

        	    $sqlprof = "SELECT Nome FROM utilizadores WHERE NProcesso = '$idprof'";
				$resultprof = $conn->query($sqlprof);

        		if ($resultprof->num_rows > 0) {
				$rowprof = $resultprof->fetch_assoc();
	   			$nomeprof = $rowprof['Nome'];
	   		}

        ?>

		<h1><?php echo $titulo; ?></h1>
		<div class="info">
			<p><?php echo $nomedisciplina ;?> • <?php echo $nomeprof ;?> • <?php echo substr($pub, 8, 2) . "/" . substr($pub, 5, 2) . "/" . substr($pub, 0, 4); ?></p>
			<div class="conclusao">
				<?php 

          					$f = substr($fim, 0, 4) . substr($fim, 5, 2) . substr($fim, 8, 2) . substr($fim, 11, 2) . substr($fim, 14, 2);

          					$dataatual = date("YmdHi");
          					//echo "atual: " . $dataatual . " - ";

          					if ($f == 0) { ?>
          						<p style="color: green;"><b>Sem data de conclusão</b></p>
          					<?php } else {

          					if (($f - $dataatual) > 0) {
          						if (($f - $dataatual) <= 1000) { ?>

          							<p><b>Data de conclusão:</b></p>
          							<p style="color: #e6c80b;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          						<?php } else { ?>

          							<p><b>Data de conclusão:</b></p>
          							<p style="color: green;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          					<?php	}

          					} else { ?>

          						<p><b>Data de conclusão:</b></p>
          						<p style="color: red;"><b><?php echo substr($fim, 8, 2) . "/" . substr($fim, 5, 2) . "/" . substr($fim, 0, 4) . " - " . substr($fim, 10, 6) ; ?></b></p>

          				<?php	}}

          				?>
			</div>
		</div>
		<div class="alinhar">
		
		<p class="desc"><?php echo $desc; ?></p>

		<?php if ($anexo != "") { ?>

		<div class="download">
			<?php $nanexo = substr($anexo, 8); ?>

			<div class="gallery">
			  <a target="_blank" href="<?php echo $anexo; ?>">
			    <img src="icons/page-file-icon.png" alt="Cinque Terre" width="200" height="256">
			  </a>
			    <div class="desc"><?php echo $nanexo; ?></div>
			</div>
			
		</div> 	<?php } ?>
		
		<?php if ($tipo == 2) { ?>

			<br>
			<button class="btn btn-secondary" onclick="location.href = 'entregas?t=<?php echo $reg; ?>&et=<?php echo $idtarefa; ?>'">Ver entregas</button>
			<br><br>
			<form class="form-inline my-2 my-lg-0" action="elt.php">
				<input type="hidden" name="id" value="<?php echo $idtarefa; ?>">
				<input type="hidden" name="reg" value="<?php echo $reg; ?>">
            	<button class="btn btn-danger" type="submit">Eliminar tarefa</button>
         	</form>
		
		<?php

			}

			$np = $_SESSION["username"];

			$sqlcheck = "SELECT * FROM entrega_tarefa WHERE IDTarefa = '$idtarefa' AND NProcesso = '$np';";
        	$resultcheck = $conn->query($sqlcheck);
        
        
        	if ($resultcheck->num_rows > 0) {
        		$rowcheck = $resultcheck->fetch_assoc();
        		$ficheiroentrega = $rowcheck['Ficheiro'];
        		$dataentrega = $rowcheck['DataEntrega'];

        		$de = substr($dataentrega, 0, 4) . substr($dataentrega, 5, 2) . substr($dataentrega, 8, 2) . substr($dataentrega, 11, 2) . substr($dataentrega, 14, 2);

        		if (($f - $de) < 0) {
        			echo "<h3 style='color: #e6c80b;'>Tarefa entregue com atraso</h3>";
        		} else {

        	   		echo "<h3 style='color: green;'>Tarefa entregue</h3>";

        		}

        	   	?>

        	   	<div class="download">
			<?php $nficheiroentrega = substr($ficheiroentrega, 8); ?>

			<a class="nav-link" href="<?php echo $ficheiroentrega; ?>" target="_blank"><img src="icons/page-file-icon.png" class="rounded float-left" alt="<?php echo $nficheiroentrega; ?>" style="width: 5%;"><?php echo $nficheiroentrega; ?></a>
			
		</div>
		 	<?php } else {

				if ($tipo != 2) { 

					if (($f - $dataatual) < 0 && $tranca == 1) {
          			
					?>

			<div class="ficheiro">
				<h3 style="color: red;"><b>O prazo de entrega da tarefa expirou</b></h3>
			</div>

			<?php } else { ?>
			
			<div class="ficheiro">
				<form method="post" enctype="multipart/form-data" action="et?idt=<?php echo $idtarefa; ?>?">
				<div class="mb-3">
				  <input class="form-control" type="file" name="ficheiro">
				</div>
				<input type="submit" name="entregar" class="form-control">
				</form>
			</div>

		<?php }} } ?>
		
		</div>
		
	</div>

	<?php include 'footer.php'; ?>
	
</body>
</html>