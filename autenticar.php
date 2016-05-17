<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GCC115";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // COLETAR O 'USUARIO' E 'SENHA' E VERIFICAR SE EXISTE 
     $_SESSION['user'] = $_POST['usuario']; 
     $_SESSION['pwd'] = $_POST['senha'];
     //echo "user:" . $_SESSION['user'] . "<br>";
     //echo "pass:" . $_SESSION['pwd'] . "<br>";


 try {
 	// CONECTA AO BANCO DE DADOS
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // BUSCANDO SE O USUARIO E SENHA EXISTE NO BANCO DE DADOS
    $stmt = $conn->prepare(" SELECT *  FROM Funcionario  WHERE usuario = '$_SESSION[user]' AND senha = '$_SESSION[pwd]' "); 
    $stmt->execute();


   	$count = $stmt->rowCount();  // conta o numero de linhas de resultado do query
   	//echo "<br /> results:" . $count;
    	if($count == 1){
    		// GUARDA O CPF (chave primaria) e se eh ADM - EM CASO ALGUMA COISA FOR FEITA NO BANCO DE DADOS QUE NECESSITE A CHAVE E PERMISSAO ESPECIAL. 
    		$result = $stmt->fetchAll(); 
    		//print_r($result);   USE CASO QUEIRA VER COMO ESTA ORGANIZADO '$result' e porque usou '$result[0][0]'
    		$_SESSION['cpf'] = $result[0][0];
    		$_SESSION['adm'] = $result[0][4];
    		//echo "CPF: " . $_SESSION['cpf'] . "<br>";
    		$_SESSION['erro_autenticacao'] = 1; //AUTENTICADO 		
    		header("Location:menu.php"); // redireciona para o 'Menu Principal'
    	}
    	else {
    		 $_SESSION['erro_autenticacao'] = 0; // nao autenticado
    		 header("Location:login.php"); // autenticacao nao feita. Volta para a pagina de login
    	} 

	}
catch(PDOException $e)
    {
    echo $conn . "<br>" . $e->getMessage();
    }



}

?>

