<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style_login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        

</head>
<body>
    <header>
        <div id="cabecalho">
            <div class="menu">
                <a href="quizvest.php"><img class="ima" src="imagens/logoo.png"></a>  
            </div>
        </div>
    </header>
<section>
    <div class="login">
        <p>JÁ SOU ALUNO</p>
        <div class="form1">
            <form class="loginform" action="verifica_login.php" method="post">
              <input type="text"  class="form-control" id="login" placeholder="Login" name="login" required><br>
              <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required><br>
              <a href="#"  class="message">Esqueci minha senha</a><br>
              <input type="submit" class="button"id="corbtnl" value="Entrar">
             
              </form>
              </div>
        </div>
        
<hr width="1" size="600" class="linha">

        <div class="cadastro">
            <p>SOU NOVO AQUI</p>
            <div class="form2">
                <form class="cadastroform" action="cadastro_usuario.php" method="post">
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required><br>
                    <input type="text" class="form-control" id="sobrenome" placeholder="Sobrenome" name="sobrenome" required><br>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required><br>
                    <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf" required><br>
                    <input type="text" class="form-control" id="celular" placeholder="Celular" name="celular" required><br>
                    <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required><br>
                    <input type="password" class="form-control" id="confsenha" placeholder="Digite a senha novamente" name="confsenha" required><br>
                    <input type="submit" class="button" id="corbtn" value="Cadastrar">
                </form>
                  </div>
            </div>

    </section>
    <footer>
  <p>Footer</p>
</footer>

</body>
</html>
