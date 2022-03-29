<?php
session_start();
require_once __DIR__.'/conexao.php';

$login = $_SESSION['user'];
$email = $login['login'];

$buscaPerfil = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$buscaPerfil->execute();
$perfil = $buscaPerfil->fetch(PDO::FETCH_ASSOC);


    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style_perfil.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require './reader.php'?>
<div class="opcao column side">
        <p class="destaque">&nbsp; Meu painel &nbsp;</p>
        <ul>
        <li class="menu_lateral"><a href="#">Redações</a></li>
        <li class="menu_lateral"><a href="#">Apostilas</a></li>
        <li class="menu_lateral"><a href="#">Plano de estudo</a></li>
        <li class="menu_lateral"><a href="#">Simulados</a></li>
        <li class="menu_lateral"><a href="#">Meu desempenho</a></li>
        </ul>
    </div>

    <div class="espaco">
        <h2>DADOS PESSOAIS</h2>
        <img class="logousuario" src="imagens/us.png"/>
        <table class="dados">
        <tr>
        <td><p>NOME:</p></td>
        <td><p><?=$perfil['nome'].' '.$perfil['sobrenome']?></p></td>

        </tr>
        <tr>

        <td><p>Email:</p></td>
        <td><p><?=$perfil['email']?></p></td>

        </tr>
        <tr>
        <td><p>Telefone:</p></td>
        <td><p><?=$perfil['celular']?></p></td>

        </tr>
        <tr>
        <td><p>CPF:</p></td>
        <td><p><?=$perfil['cpf']?></p></td>

        </tr>
        </table>
        <h2>SEGURANÇA</h2>
        <a href="#" class="seguranca s">mudar senha</a><br><br><br>
        <a href="#" class="seguranca e">trocar de e-mail</a><br><br><br>
    </div>
</body>
</html>