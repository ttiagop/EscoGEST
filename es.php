<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sumários</title>
</head>

<script type="text/javascript">
	function openPopupFaltas(url) {

            var width = 1100;
            var height = 600;
            var left = (window.innerWidth - width) / 2;
            var top = (window.innerHeight - height) / 2;
            var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;

            window.open(url, 'Popup', options);
        }
</script>

<body>

	<?php 
		include 'header.php'; 

		if ($tipo != 2) {
				header('Location: nacess');
			}
	?>
	
	<div class="content">
	
		<h1>Editar sumário</h1><br>

		<?php 

			$naula = $_GET['id'];


		?>

		<form action="esg.php" method="POST">
		
		<div>
			<h3>Turma/Disciplina</h3>
			<select class="form-control" name="reg">

				<?php

				
				$sumarios = "SELECT * FROM aulas WHERE NumAula = '$naula'";
            

                $result = $conn->query($sumarios);
                
                if ($result->num_rows > 0) {
                    	$rowsumarios = $result->fetch_assoc();
                        $id = $rowsumarios['NumAula'];
                        $regconsulta = $rowsumarios['IDReg'];
                        $inicial = $rowsumarios['LInicial'];
                        $final = $rowsumarios['LFinal'];
                        $dataresult = $rowsumarios['Data'];
                        $sumario = $rowsumarios['Sumario']; 

                        $d = substr($dataresult, 8, 2) . "/" . substr($dataresult, 5, 2) . "/" . substr($dataresult, 0, 4);


                    }
                      


			$sqlturmas = "SELECT IDTurma, IDReg, IDDisciplina FROM turma_disciplina WHERE IDProf = '$nproc'";
        	$resultturmas = $conn->query($sqlturmas);
        
        
        	if ($resultturmas->num_rows > 0) {
        	    while ($rowturmas = $resultturmas->fetch_assoc()) {
        	        $reg = $rowturmas['IDReg'];
        	        $turma = $rowturmas['IDTurma'];
        	        $disciplina = $rowturmas['IDDisciplina'];

        	        $sqlturmas2 = "SELECT AnoLetra FROM turmas WHERE IDTurma = '$turma'";
        			$resultturmas2 = $conn->query($sqlturmas2);
        			
        			if ($resultturmas2->num_rows > 0) {

        				$rowturmas2 = $resultturmas2->fetch_assoc();

        				$nometurma = $rowturmas2['AnoLetra'];

        				$sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
        				$resultdisciplinas2 = $conn->query($sqldisciplinas2);
	        				
	        				if ($resultdisciplinas2->num_rows > 0) {
	
	        					$rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
	
        					$nomedisciplina = $rowdisciplinas2['NomeDisciplina'];

        	?>

				<option <?php if ($reg == $regconsulta) { ?> selected <?php } else { ?> disabled <?php } ?> value="<?php echo $reg; ?>"><?php echo $nometurma . " - " . $nomedisciplina ; ?></option>



				<?php        			
     				}}
        	    }}
        	?>

			</select>
		</div><br>
		<button class="btn btn-secondary" onclick="openPopupFaltas('mf?t=<?php echo $regconsulta; ?>&n=<?php echo $naula; ?>'); return false;">Marcar faltas</button>
		<br><br>

		<h3>Data</h3>
		<input class="form-control" type="date" name="data" value="<?php echo $dataresult; ?>"><br>

		<h3>N.º de tempos</h3>
		<input disabled class="form-control" type="number" name="tempos" value="<?php echo (($final - $inicial) + 1); ?>" min="1" max="4" maxlength="1" oninput="validarEntradaNumerica(event)"><br>

		<script type="text/javascript">
			function validarEntradaNumerica(event) {
			    let valorAtual = event.target.value;
			
			    let valorNumerico = valorAtual.replace(/[^1-4]/g, '1');
			
			    event.target.value = valorNumerico;
			}
		</script>
		
		<h3>Sumário</h3>
		<div class="input-group">
			<textarea class="form-control" aria-label="With textarea" placeholder="Escrever sumário..." name="sumario"><?php echo $sumario; ?></textarea>
		</div>
		<br>
		<input type="hidden" name="id" value="<?php echo $naula; ?>">
		<input type="submit" class="form-control" value="Guardar">

		</form>
		<br>

		<form action="ds.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $naula; ?>">
			<button class="btn btn-danger" type="submit">Eliminar sumário</button>
		</form>



	</div>

    <?php include 'footer.php'; ?>


</body>
</html>