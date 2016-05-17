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
      $query = "INSERT INTO Loja (id_loja, cidade, endereco, telefone )
                                 VALUES ('','".$_POST['cidade']."','".$_POST['endereco']."','".$_POST['telefone']."') ";


      $insere = $conn->prepare($query); 
      $insere->execute();
      
      header("Location:manter_lojas.php"); 
  }
  catch(PDOException $e) { echo $conn . "<br>" . $e->getMessage(); }

}