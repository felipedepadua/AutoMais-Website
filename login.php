<?php session_start(); ?>

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

<div class="container-fluid">

    <div class="row">
      <img src= "0-auto.jpg" width="150" alt="automais" class="img-responsive center-block" />

    </div>
</div>

 
<div class="container-fluid">  

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 bg-grey">
            <h1> BEM VINDO </h1> 
            <form method="post" action="autenticar.php">

              <div class="form-group">
                <label>Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite o Usuario" required>
              </div>

             <div class="form-group">
               <label>Senha:</label>
               <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
             </div>

             <button type="submit" class="btn btn-danger btn-lg" style="display: block; width: 100%;">Login</button>

           </form>
       </div>
       <div class="col-md-4"></div>
    </div>

</div>

<?php if (isset($_SESSION['erro_autenticacao'])) : ?>  <!-- isset verifica se a variavel existe ou nao (So vai ser criada em autenticar.php) -->
      <?php if ($_SESSION['erro_autenticacao'] == 0) : ?>  <!-- '1' vale OK (autenticado ou nao feito login) e '0' nao autenticado */ -->
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                Autenticação falhou. Verifique se o Usuário e Senha digitado está correto e Tente novamente.
            </div>
          <?php $_SESSION['erro_autenticacao'] = 1; ?>
      <?php endif; ?>
<?php endif; ?>

<p>PS: This logo and company name do not exist. They were invented to hide the original company in which this prototype was presented to.</p>
<script src="myscript.js"></script>
</body>
</html>
