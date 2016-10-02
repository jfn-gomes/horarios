<!DOCTYPE html>
<?php
    $page = $_SERVER['PHP_SELF'];
    $sec = "30";
    date_default_timezone_set("Europe/Lisbon"); 
    $currentTime = date('H:i', gmdate('U'));    
    $connect = connectDatabase();
?>
<html lang="PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Horario Transportes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="">
    
    <!--[if IE]>   

//VER GOOGLE ALERT
//VER GOOGLE ALERT
//VER GOOGLE ALERT
//VER GOOGLE ALERT
//VER GOOGLE ALERT

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body> 
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table">
                    <td>
                        <center><h2 class="alignright text-info"> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Próximas Partidas 
                        </h2>
                        </center>
                    </td>
                    <td>
                        <h2 class="alignmiddle text-info">
                        <?php
                            date_default_timezone_set("Europe/Lisbon"); 
                            $currentSeconds = date('s', gmdate('U')); 
                            if($currentSeconds%2==0){
                              $currentTime = date('H i', gmdate('U'));    
                            }
                            else{
                                $currentTime = date('H:i', gmdate('U'));
                            }
                            echo $currentTime  
                        ?> 
                        </h2>
                    </td>  
            </table>
        </div>
    </div>
   
    <div class="col-xs-6">
        <div class="table-responsive">
            <table class="table table-bordered table-inverse">
                <thead>
                   <td colspan="3" class="bg-info">
                        <div class="media">
                            <div class="media-middle">
                               <center><img class="img-responsive" src="img/mtsLogo.jpg" width="80px";><h3 class="text-info">Universidade-Cacilhas</h3></center>
                            </div>

                        </div>
                    </td>
                </thead>
                <tbody>
                    <tr>
                       <?php
                            
                            $results= nextTransports("1-Cacilhas", $connect, $currentTime);
                            printHorario($results[0], $currentTime, "00:10","00:05");
                            printHorario($results[1], $currentTime, "00:10","00:05");
                            printHorario($results[2], $currentTime, "00:10","00:05");
                           
                        ?>
                        
                        
                    </tr>    
                </tbody>
            </table>
        </div>
    </div>

    <?php 
        //Get Current Time and looks for next transports
        function nextTransports($destino, $connect, $currentTime) {
            $sql = "SELECT * FROM horarios WHERE destino='".$destino."' and hhmmPartida>='".$currentTime."' ORDER BY hhmmPartida"; 
            $result = mysqli_query($connect, $sql) or die('A consulta falhou!: ' .mysqli_error($connect));
            //Get the three first values from the query.
            $vector = array(mysqli_fetch_array($result), mysqli_fetch_array($result), mysqli_fetch_array($result));
            return $vector;
        }
        /* PrintHorario - Passando uma entrada da tabela, o tempo actual, e os respectivos intervalos de tempo
        Imprime consoante com a cor dependente do tempo que falta para o transporte.
        */
        function printHorario($row, $currentTime, $intervaloAmarelo, $intervaloVermelho){
            $timeleft=$row[3]-$currentTime;
            if($timeleft>$intervaloAmarelo){
               echo '<td class="bg-success">'.$row[3].'</td>';
            }
            if($timeleft<=$intervaloAmarelo){
               echo '<td class="bg-danger">'.$row[3].'</td>';
            }
            
            
             
        }
        //conecta á database.
        function connectDatabase(){
            $connect = mysqli_connect('localhost', 'root', '') or die('Não foi possível conectar: '.mysql_error());            
            mysqli_select_db($connect, 'transporthorarios') or die('Não foi possivel selecionar o banco de dados');
            return $connect;
        }    
        function closeDatabase($connect){
             mysqli_close($connect);
        }    
    
    ?>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php
     closeDatabase($connect);

?>