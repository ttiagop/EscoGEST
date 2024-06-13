<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faltas</title>
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

        if ($tipo != 1) {
                header('Location: nacess');
            }
    ?>


    <style type="text/css">
        .card-text {
            text-align: left;
        }
    </style>

    <div class="content">

        <h1>Faltas</h1><br>
        
        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Data</th>
                              <th scope="col">Disciplina</th>
                              <th scope="col">Tempo</th>
                              <th scope="col">Tipo</th>
                              <th scope="col">Estado</th>
                              <th scope="col">Detalhes</th>
                            </tr>
                          </thead>
        <?php 
        
            include 'dbcon.php';
        
            
                $faltas = "SELECT * FROM `falta_aluno` WHERE NPAluno = '$nproc'";
            

                $result = $conn->query($faltas);
                
                if ($result->num_rows > 0) {
                    while ($rowfaltas = $result->fetch_assoc()) {
                        $idfalta = $rowfaltas['IDFalta'];
                        $aula = $rowfaltas['AulaFalta'];
                        $tempo = $rowfaltas['Tempo'];
                        $tipo = $rowfaltas['TipoFalta'];
                        $desc = $rowfaltas['DescFalta'];
                        $just = $rowfaltas['Just'];

                        if ($tipo == 1) {
                            $tipo = "Presença";
                        }

                        if ($tipo == 2) {
                            $tipo = "Atraso";
                        }

                        if ($tipo == 3) {
                            $tipo = "Material";
                        }

                        if ($tipo == 4) {
                            $tipo = "Ocorrência";
                        }

                        if ($tipo == 5) {
                            $tipo = "Disciplinar";
                        }

                        $infoaula = "SELECT * FROM aulas WHERE NumAula = '$aula'";
            

                        $resultinfoaula = $conn->query($infoaula);
                        
                        if ($resultinfoaula->num_rows > 0) {
                                $rowinfo = $resultinfoaula->fetch_assoc();
                                $id = $rowinfo['NumAula'];
                                $regconsulta = $rowinfo['IDReg'];
                                $inicial = $rowinfo['LInicial'];
                                $final = $rowinfo['LFinal'];
                                $dataresult = $rowinfo['Data'];
                                $sumario = $rowinfo['Sumario']; 

                        $d = substr($dataresult, 8, 2) . "/" . substr($dataresult, 5, 2) . "/" . substr($dataresult, 0, 4);

                        //vai buscar o tempo a primeira query
                        if ($tempo == 0) {
                            $tempo = $inicial . " - " . $final;
                        }

                    }
                    
                    $sqlturmas = "SELECT IDDisciplina FROM turma_disciplina WHERE IDReg = '$regconsulta'";
                    $resultturmas = $conn->query($sqlturmas); 

                    if ($resultturmas->num_rows > 0) {
                            $rowturmas = $resultturmas->fetch_assoc();
                            $disciplina = $rowturmas['IDDisciplina'];

                  

                        $sqldisciplinas2 = "SELECT NomeDisciplina FROM disciplinas WHERE IDDisciplina = '$disciplina'";
                        $resultdisciplinas2 = $conn->query($sqldisciplinas2);
                            
                            if ($resultdisciplinas2->num_rows > 0) {
    
                                $rowdisciplinas2 = $resultdisciplinas2->fetch_assoc();
    
                            $nomedisciplina = $rowdisciplinas2['NomeDisciplina']; }}

                        ?>


                        
                          <tbody>
                            <tr>
                              <td><b><?php echo $d; ?></b></td>
                              <td><?php echo $nomedisciplina; ?></td>
                              <td><?php echo $tempo; ?></td>
                              <td><?php echo $tipo; ?></td>
                              <td>

                                <?php 
                                    if ($just == "") { ?>


                                        <p style="color: red;"><b>Injustificada</b></p>

                                <?php    
                                    } else { ?>

                                        <p style="color: green;"><b>Justificada</b></p>

                                <?php } ?>
                                  
                              </td> <!--copiar para as outras paginas de faltas!-->
                              <td>

                                <button class="btn btn-secondary" onclick="openPopupFaltas('detalhesf?f=<?php echo $idfalta; ?>'); return false;">Ver detalhes</button>

                              </td>
                            </tr>

        
                <?php }} else { ?>

                    <h3>Não foram encontrados resultados.</h3>

                <?php }
        
        
            $conn->close();
        
        
            //header('Location: aulas');
                
        
        ?>

          </tbody>
        </table>
        
        </div>
            


    <?php include 'footer.php'; ?>


</body>
</html>