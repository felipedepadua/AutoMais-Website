<?php session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";

 try {
  // CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // LOJAS PARA MOSTRAR NO DROPDOWN PARA EXCLUIR
    $loja = $conn->prepare("SELECT id_loja,cidade,endereco  FROM Loja"); 
    $loja->execute();
    $result_l = $loja->fetchAll(); // guarda em 'result' todas as pecas  


      // APAGA A LOJA NESSA MESMA PAGINA
      if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $apaga = $conn->prepare(" DELETE FROM Loja  WHERE id_loja = '$_POST[loja]'"); 
            $apaga->execute();

      header("Location:manter_lojas.php");
    }

  }
  catch(PDOException $e)  {
    echo $conn . "<br>" . $e->getMessage();
  }


function lista_lojas(){ 

    $i=0; //contador de linha
    $temp = $GLOBALS['result_l'];
    foreach ($temp as $a) {
      echo '<option value="'.$temp[$i][0].'">' . $temp[$i][1] . " - local: " . $temp[$i][2] . '</option>';
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


 
<h1> MANTER LOJAS  </h1> <br />

<div class="container">

    <div class="row">
        <div class="col-md-5 bg-grey">

          <h3>Nova Loja</h3> <br />

          <form id="criar_loja" action="inserir_loja.php" method="post">  

              <div class="form-group">
                <label>Cidade:</label>
                <input type="text" class="form-control" name="cidade" placeholder="Digite a Cidade" required>
              </div>

              <div class="form-group">
                <label>Endereco:</label>
                <input type="text" class="form-control" name="endereco" placeholder="Digite o Endereco" required>
              </div>

              <div class="form-group">
                <label>Telefone:</label>
                <input type="number" maxlength="14" class="form-control" name="telefone" placeholder="Digite o Telefone" required>
              </div>

              <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Criar</button>
                                  
          </form>
        
        </div>

      <div class="col-md-2"></div>

 
       <div class="col-md-5 bg-grey">

          <h3>Excluir Loja</h3> <br /><br /><br />
       
          <form id="excluir_loja" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  

              <div class="form-group">
                <label>Selecione a loja:</label>
                <select name="loja" class="form-control" required>
                    <option value="" disabled="disabled" selected></option>
                    <?php lista_lojas(); ?>
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