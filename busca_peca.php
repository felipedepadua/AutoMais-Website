<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


  if ($_SERVER["REQUEST_METHOD"] == "POST") { 

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query_busca = "SELECT P.id_peca, P.nome_peca, P.preco, P.quantidade_estoque, F.nome_fornecedor  
                             FROM Peca AS P, Fornecedor AS F
                             WHERE P.fornecedor=F.id_fornecedor";


      if(isset($_POST['id_busca'])) { 
            if($_POST['id_busca'] != "") { $query_busca .= " AND P.id_peca='" . $_POST['id_busca'] . "'"; }
       }

      if(isset($_POST['forn_busca'])) {  
            if($_POST['forn_busca'] != "") { $query_busca .= " AND F.id_fornecedor='" . $_POST['forn_busca'] . "'"; }
      }

      if(isset($_POST['peca_busca'])) {  
            if($_POST['peca_busca'] != "") { $query_busca .= " AND P.nome_peca LIKE '%" . $_POST['peca_busca'] . "%'"; }
      } 

      //echo $query_busca . "<br>";

      // FAZ A BUSCA DE ACORDO COM AS INFORMACOES PREENCHIDAS NA BUSCA
      $busca = $conn->prepare($query_busca); 
      $busca->execute();

      $result_busca = $busca->fetchAll(); // guarda em 'result_busca' todas as linhas de resultado da busca (se houver)
      //print_r($result_busca);

      $vazio = NULL;
      if(empty($result_busca)) { $vazio = "Nenhuma peca foi encontrada para essa busca!"; }

  }
  catch(PDOException $e) { echo $conn . "<br>" . $e->getMessage(); }

}


function imprime_resultado_busca(){

          $x=0; //contador de linha
          $temp = $GLOBALS['result_busca'];
          foreach ($temp as $a) {
                 echo  "<tr>";
                 echo  "<td>" . $temp[$x][1] . "</td>"; //  1: coluna do nome da peca
                 echo  "<td>" . $temp[$x][2] . "</td>"; //  2: coluna do preco 
                 echo  "<td>" . $temp[$x][3] . "</td>"; //  3: coluna da  quantidade
                 echo  "<td>" . $temp[$x][4] . "</td>"; //  4: coluna do fornecedor
                 echo  "</tr>";
            $x++;
          }
}

?>


<!DOCTYPE html>
<html>

<head>
  <title> .: Auto Mais .: </title>
   <!-- BOOTSTRAP -->
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

      <style>
          .btn-lg { margin-top: 10px; }
          h1,h3 { text-align: center;  color: #f4511e; }
      </style>

</head>


<body>

<div class="container">
    <div class="row">
      <a href="logout.php" class="btn btn-danger btn-md" style="margin-top:10px; float:right;">Logout</a>
      <a href="menu.php" class="btn btn-danger btn-md" style="float:right; margin-top:10px; margin-right:10px;">Voltar ao Menu Principal</a>
      <a href="consulta_estoque.php" class="btn btn-danger btn-md" style="float:right; margin-top:10px; margin-right:10px;">Voltar a Consulta de Estoque</a>
      <br /><br /><br />
    </div>
</div>


<div class="alert alert-warning"> 
<h1> RESULTADO - BUSCA </h1> <br />
</div>

<div class="container">

<!-- TABELA -->
<table class="table table-striped table-bordered">
  <tr>
    <th>Peca</th>
    <th>Preco</th>
    <th>Quantidade</th>    
    <th>Fornecedor</th>   
  </tr> 
  <?php imprime_resultado_busca(); ?>
</table>

</div>

<h3 id="demo"><?php echo $GLOBALS['vazio']; ?></h3>


</body>
</html>