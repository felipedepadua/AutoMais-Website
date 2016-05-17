<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // PECAS PARA MOSTRAR NO DROPDOWN MENU QUANDO EDITAR UM PECA
    $peca = $conn->prepare("SELECT nome_peca  FROM Peca"); //seleciona todos fornecedores
    $peca->execute();
    $result = $peca->fetchAll(); // guarda em 'result' todas as pecas  

  }
  catch(PDOException $e)  {
    echo $conn . "<br>" . $e->getMessage();
  }


function lista_pecas(){ //mostra a lista de fornecedores no dropdown menu pra editar.

    $i=0; //contador de linha
    $temp = $GLOBALS['result'];
    foreach ($temp as $a) {
      echo '<option value="'.$temp[$i][0].'">' . $temp[$i][0] . '</option>';
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
      	h1 { text-align: center;  color: #f4511e; }
      	.container-fluid { padding: 30px 25px; }
      	.bg-grey { background-color: #f6f6f6; padding: 20px 40px; border-radius: 10px; }
      </style>

</head>


<body>

<div class="container">

    <div class="row">
      <a href="logout.php" class="btn btn-danger btn-md" style="margin-top:10px; float:right;">Logout</a>
      <a href="menu.php" class="btn btn-danger btn-md" style="float:right; margin-top:10px; margin-right:10px;">Voltar ao Menu Principal</a>
      <img src= "0-auto.jpg" width="150" alt="automais" class="img-responsive center-block" />
    </div>
</div>


<h1> FORMULARIO - FAZER PEDIDO </h1> <br />


<div class="container">

<div id="Form_peca" class="jumbotron" >


<h4>FAÇA O PEDIDO DE UMA PEÇA:</h4>        

<form method="" action="">

<div class="form-group">
  <label>Selecione uma peça:</label>
  <select name="" class="form-control" required>
       <option value="" disabled="disabled" selected></option>
       <?php lista_pecas();?>
  </select>
</div>

<div class="form-group">
  <label>Selcione a quantidade:</label>
  <input type="number" min="1" max="1000" name="" class="form-control" required>
</div>

<div class="form-group">
  <label>Por segurança, digite seu CPF:</label>
  <input type="number" min="1" max="100000000000" name="" class="form-control" required>
</div>

<button type="submit" class="btn btn-danger">INCLUIR MAIS PEÇAS NO PEDIDO</button>

</form>

<br /><br />
<a href="menu.php" class="btn btn-danger btn-lg" style="display: block;">FINALIZAR PEDIDO</a>

</div>

</div>


<script src="myscript.js"></script>
</body>
</html>