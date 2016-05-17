<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // FORNECEDORES PARA MOSTRAR NO DROPDOWN PARA EXCLUIR
    $forn = $conn->prepare("SELECT id_fornecedor,nome_fornecedor  FROM Fornecedor"); //seleciona todos fornecedores
    $forn->execute();
    $result_f = $forn->fetchAll(); // guarda em 'result_f' todas as linhas(forncedores) de resultado da selecao


      // APAGA O FORNECEDOR NESSA MESMA PAGINA
      if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $apaga = $conn->prepare(" DELETE FROM Fornecedor  WHERE id_fornecedor = '$_POST[fornecedor]' "); 
            $apaga->execute();

      header("Location:manter_fornecedores.php");
    }

  }
  catch(PDOException $e)  {
    echo $conn . "<br>" . $e->getMessage();
  }


function lista_fornecedor(){ 

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
        .container-fluid { padding: 30px 25px; }
        .bg-grey { background-color: #f6f6f6; padding: 20px 40px; border-radius: 10px; }
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


 
<h1> MANTER FORNECEDORES  </h1> <br />

<div class="container">

    <div class="row">
        <div class="col-md-5 bg-grey">

          <h3>Novo Fornecedor</h3> <br />

          <form id="criar_forn" action="inserir_fornecedor.php" method="post">  

              <div class="form-group">
                <label>Nome do Fornecedor:</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o Nome" required>
              </div>

              <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" placeholder="Digite o Email" required>
              </div>

              <div class="form-group">
                <label>Endereco:</label>
                <input type="text" class="form-control" name="endereco" placeholder="Digite o Endereco" required>
              </div>         

              <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Criar</button>
                                  
          </form>
        
        </div>

      <div class="col-md-2"></div>

 
       <div class="col-md-5 bg-grey">

          <h3>Excluir Fornecedor</h3> <br /><br /><br /> <!-- FORMULARIO PARA EXCLUIR FORNECEDOR -->
       
          <form id="excluir_forn" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  

              <div class="form-group">
                <label>Selecione a conta:</label>
                <select name="fornecedor" class="form-control" required>
                    <option value="" disabled="disabled" selected></option>
                    <?php lista_fornecedor(); ?>
                </select>
              </div>

              <br /><br />
              <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Excluir</button>
                                  
          </form>     

       </div>

    </div>

</div>

</body>
</html>