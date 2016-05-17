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
      $query = "INSERT INTO Fornecedor (id_fornecedor, nome_fornecedor, email, endereco)
                VALUES ('','".$_POST['nome']."','".$_POST['email']."','".$_POST['endereco']."') ";


      $insere = $conn->prepare($query); 
      $insere->execute();
      
      header("Location:manter_fornecedores.php");
  }
  catch(PDOException $e) { echo $conn . "<br>" . $e->getMessage(); }

}