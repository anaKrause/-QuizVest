
<?php

session_start();
require_once __DIR__.'/conexao.php';
///*
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    }   
$login = $_SESSION['user'];
$email = $login['login'];
$nota=0;
$procurascore = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procurascore->execute();
$score = $procurascore->fetch(PDO::FETCH_ASSOC);
//echo "score: ".$score['score']."<br>";

$contagemredacoes = $conn->prepare("SELECT COUNT(emailAluno) AS qntredacoes FROM redacoes WHERE emailAluno='$email'");
$contagemredacoes->execute();
$qntredacoesAluno = $contagemredacoes->fetch(PDO::FETCH_ASSOC);
$qnt = $qntredacoesAluno['qntredacoes'];

$procuraredacoes = $conn->prepare("SELECT * FROM redacoes WHERE emailAluno='$email'");
$procuraredacoes->execute();



while($redacao = $procuraredacoes->fetch(PDO::FETCH_ASSOC)){

    $nota = $nota+$redacao['notaredacao'];
}
$mediaRedacoes = number_format((float)$nota/$qnt,0);



?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <title>Página Inicial</title>

        <link rel="stylesheet" href="style_index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    </head>

<body class="body">
<?php require './reader.php'?>

<div class="opcao column side">
    <p class="destaque">&nbsp; Meu painel &nbsp;</p>
    <ul>
    <li class="menu_lateral"><a href="redacao.php">Redações</a></li>
    <li class="menu_lateral"><a href="#">Apostilas</a></li>
    <li class="menu_lateral"><a href="#">Plano de estudo</a></li>
    <li class="menu_lateral"><a href="#">Simulados</a></li>
    <li class="menu_lateral"><a href="#">Meu desempenho</a></li>
    </ul>
</div>
<section>
<div class="materias column middle">
<form class="form_index" action="conteudos.php" method="post">
    <table class="botoes">
    <tr>     
    <td><button type="submit" name="materia" value="quimica"class="materia"><img src="imagens/icones/quimica.png"></button></td>
    <td><button type="submit" name="materia" value="biologia" class="materia"><img src="imagens/icones/biologia.png"></button></td> 
    <td><button type="submit" name="materia" value="fisica" class="materia"><img src="imagens/icones/fisica.png"></button></td>
    <td><button type="submit" name="materia" value="matematica"class="materia"><img src="imagens/icones/matematica.png"></button></td>  
    <td><button type="submit" name="materia" value="redacao"class="materia"><img src="imagens/icones/redacao.png"></button></td>
    </tr>
    <tr>
    <td><button type="submit" name="materia" value="portugues"class="materia"><img src="imagens/icones/portugues.png"></button></td>
    <td><button type="submit" name="materia" value="literatura"class="materia"><img src="imagens/icones/literatura.png"></button></td>
    <td><button type="submit" name="materia" value="arte"class="materia"><img src="imagens/icones/arte.png"></button></td>
    <td><button type="submit" name="materia" value="ingles"class="materia"><img src="imagens/icones/ingles.png"></button></td> 
    <td><button type="submit" name="materia" value="espanhol"class="materia"><img src="imagens/icones/espanhol.png"></button></td>
    </tr>
    <tr>
    <td><button type="submit" name="materia" value="geografia"class="materia"><img src="imagens/icones/geografia.png"></button></td>
    <td><button type="submit" name="materia" value="historia"class="materia"><img src="imagens/icones/historia.png"></button></td>
    <td><button type="submit" name="materia" value="filosofia"class="materia"><img src="imagens/icones/filosofia.png"></button></td>
    <td><button type="submit" name="materia" value="sociologia"class="materia"><img src="imagens/icones/sociologia.png"></button> </td>
    </tr>
</table>
     </form>

</div>
<div class="column side">
    <div class="pont"><p>Minha pontuação</p></div>
    <div class="pontuação">
    <p><?=$score['score']?></p>
    </div>
    <div class="red"><p>Média de redações</p></div>
    <div class="mediared">
    <p><?=$mediaRedacoes?></p> 

    </div>

<br>
</section>

<footer>
  <p>Footer</p>
</footer>

</body>
</html>







    



