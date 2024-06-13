<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver sumários</title>
</head>
<body>

    <?php 
        include 'header.php'; 

        if ($tipo != 2) {
                header('Location: nacess');
            }
    ?>


    <style type="text/css">
        .card-text {
            text-align: left;
        }
    </style>

    <div class="content">

        <h1>Resultados</h1><br>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        
        <?php 
        
            include 'dbcon.php';
        
        
            $reg = $_POST['reg'];
            $data = $_POST['data'];
            //$ntempos = $_POST['tempos'];
            //$sumario = $_POST['sumario'];
        
            
            if ($data == "") {
                $sumarios = "SELECT * FROM aulas WHERE IDReg = '$reg' ORDER BY NumAula DESC";
            } else {
                $sumarios = "SELECT * FROM aulas WHERE IDReg = '$reg' AND Data LIKE '$data' ORDER BY NumAula DESC";
            }

                $result = $conn->query($sumarios);
                
                if ($result->num_rows > 0) {
                    while ($rowsumarios = $result->fetch_assoc()) {
                        $id = $rowsumarios['NumAula'];
                        $regconsulta = $rowsumarios['IDReg'];
                        $inicial = $rowsumarios['LInicial'];
                        $final = $rowsumarios['LFinal'];
                        $dataresult = $rowsumarios['Data'];
                        $sumario = $rowsumarios['Sumario']; 

                        $d = substr($dataresult, 8, 2) . "/" . substr($dataresult, 5, 2) . "/" . substr($dataresult, 0, 4);



                        ?>
        
                


                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-text"><a class="hiperligacoesInicio" href="es?id=<?php echo $id; ?>"><?php echo $d; ?></a></h3>
                                    <p class="card-text"><b>Aula <?php echo $inicial . " - " . $final; ?></b></p>
                                    <p class="card-text"><?php echo substr($sumario, 0, 29); if (strlen($sumario) > 28) { echo "..."; } ?></p>
                                </div>
                            </div>      
                        </div>



        
                <?php }} else { ?>

                    <h3>Não foram encontrados resultados.</h3>

                <?php }
        
        
            $conn->close();
        
        
            //header('Location: aulas');
                
        
        ?>
        
        </div>
        
    </div>
    


    <?php include 'footer.php'; ?>


</body>
</html>