<!DOCTYPE html>
<html lang="PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Starter Template for Bootstrap 4.0.0-alpha.4</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap-theme.min.css">

    <!--[if IE]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>    
    <table>
        <tr>
            <th>Companhia&nbsp;</th>
            <th>Horario&nbsp;</th>
            <th>Destino:&nbsp;</th>
        </tr>
        <tr>
            <td>TST</td>
            <td>14:20</td>
            <td>1 - Cacilhas</td>
        </tr>
        </table>
    <?php   
        $connect = mysqli_connect('localhost', 'root', '')
        or die('Não foi possível conectar: '.mysql_error());            
        mysqli_select_db($connect, 'transporthorarios')
        or die('Não foi possivel selecionar o banco de dados');
    
        $sql = 'SELECT * FROM horarios WHERE 1';
        
        $result = mysqli_query($connect, $sql) or die('A consulta falhou!: ' .mysqli_error($connect));
        while($row =mysqli_fetch_array($result)){
            for($i = 0; $i<4;$i++){
                if( $i == 0){
                    echo(" "."<br>"." "); 
                }
                else{
                    echo $row[$i];
                    echo '   '; 
                }
            }
        }   
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js"></script>
</body>
</html>