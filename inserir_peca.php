<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


// CONECTA AO BANCO DE DADOS
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] == "POST") { 

 try {
      // INSERE DE ACORDO COM AS INFORMACOES PREENCHIDAS NO FORMULARIO
      $query = "INSERT INTO Peca (id_peca, nome_peca, preco, quantidade_estoque, fornecedor)
                                 VALUES ('','".$_POST['peca']."','".$_POST['preco']."','".$_POST['quantidade']."','".$_POST['fornecedor']."') ";

      //echo $query;

      $insere = $conn->prepare($query); 
      $insere->execute();
      
      header("Location:consulta_estoque.php"); 
  }
  catch(PDOException $e) { echo $conn . "<br>" . $e->getMessage(); }

}


    // FORNECEDORES PARA MOSTRAR NO DROPDOWN MENU QUANDO EDITAR UM PECA
    $forn = $conn->prepare("SELECT id_fornecedor,nome_fornecedor  FROM Fornecedor"); //seleciona todos fornecedores
    $forn->execute();
    $result_f = $forn->fetchAll(); // guarda em 'result_f' todas as linhas(forncedores) de resultado da selecao


function lista_fornecedor(){ //mostra a lista de fornecedores no dropdown menu pra editar.

    $i=0; //contador de linha
    $temp = $GLOBALS['result_f'];
    foreach ($temp as $info) {
      echo '<option value="'.$temp[$i][0].'">Fornecedor ' . $temp[$i][1] . '</option>';
      $i++;
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
      <img src= "0-auto.jpg" width="150" alt="automais" class="img-responsive center-block" style="margin-top:40px;" />
    </div>
</div>


 
<h1> FORMULARIO - INSERIR PECA </h1> <br />


<div class="container">

<div id="Form_peca" class="jumbotron" >


<h4>INSIRA OS DADOS DA PECA:</h4>        

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-group">
  <label>Nome da Peça:</label>
  <input name="peca" class="form-control" required>
</div>

<div class="form-group">
  <label>Quantidade em estoque:</label>
  <input type="number" min="1" max="1000" name="quantidade" class="form-control"required>
</div>

<div class="form-group">
  <label>Preço:</label>
  <input type="number" step="0.01" min="0.01" max="3000.00" name="preco" class="form-control" required>
</div>

<div class="form-group">
  <label>Fornecedor:</label>
  <select name="fornecedor" class="form-control" required>
       <option value="" disabled="disabled" selected></option>
       <?php lista_fornecedor();?>
  </select>
</div>

<button type="submit" class="btn btn-danger">Inserir</button>

</form>

</div>

</div>



<script src="myscript.js"></script>
</body>
</html>