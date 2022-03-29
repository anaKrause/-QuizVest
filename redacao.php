<?php
session_start();

require_once __DIR__.'/conexao.php';
///*
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    }   
$login = $_SESSION['user'];
$email = $login['login'];

$procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procuranome->execute();
$nome = $procuranome->fetch(PDO::FETCH_ASSOC);
//echo "score: ".$score['score']."<br>";


$nota=0;

$contagemredacoes = $conn->prepare("SELECT COUNT(emailAluno) AS qntredacoes FROM redacoes WHERE emailAluno = '$email'");
$contagemredacoes->execute();
$qntredacoesAluno = $contagemredacoes->fetch(PDO::FETCH_ASSOC);
$qnt = $qntredacoesAluno['qntredacoes'];

$procuraredacoes = $conn->prepare("SELECT * FROM redacoes WHERE emailAluno='$email'");
$procuraredacoes->execute();

$contagemmelhores = $conn->prepare("SELECT COUNT(notaredacao) AS melhores FROM redacoes WHERE notaredacao = '1000'");
$contagemmelhores->execute();
$melhores = $contagemmelhores->fetch(PDO::FETCH_ASSOC);
$melhoresredacoes = $melhores['melhores'];

while($redacao = $procuraredacoes->fetch(PDO::FETCH_ASSOC)){

    $nota = $nota+$redacao['notaredacao'];
}
$mediaRedacoes = number_format((float)$nota/$qnt,0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_redacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Redações</title>
</head>

<body>
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
        <div class="redac"><p>Redações</p></div>
        <div class="espaco">
        <table class="re">
            <tr>
                <td><div class="elementos nota">
                    <a href="#"><img class="img_nota" src="imagens/lista-de-papel.png"></a>
                    <p class="text">Minha nota média</p>
                    <p class="n"><?=$mediaRedacoes?></p>
                </div></td>
                <td><div class="elementos enviar">
                    <a href="temas_redacao.php"><img class="img_nota" src="imagens/estudar.png"></a>
                    <a href="temas_redacao.php"><p class="text" id="env">Enviar Redação</p></a>
                </div></td>
                <td><div class="elementos enviadas">
                    <a href="redacoes_enviadas.php"><img class="img_nota" src="imagens/lista-de-controle.png"></a>
                    <a href="redacoes_enviadas.php"><p class="text" >Redações Enviadas</p></a>
                    <p class="n"><?=$qnt?></p>
                </div></td>
            </tr>
            <tr>
                <td><div class="elementos desempenho">
                    <a href="#"><img class="img_nota" src="imagens/negocios-e-financas.png"></a>
                    <p class="text">Meu desempenho</p>
                    <p class="n">10%</p>                   
                </div></td>
                <td><div class="elementos creditos">
                    <a href="#"><img class="img_nota" src="imagens/pilha-de-papeis-quadrados.png"></a>
                    <p class="text">Meus Créditos</p>
                    <p class="n" id="cred">4/4</p>
                </div></td>
                <td><div class="elementos melhores">
                    <a href="melhores_redacoes.php"><img class="img_nota" src="imagens/certificado.png"></a>
                    <p class="text">Melhores Redações</p>
                    <p class="n"><?=$melhoresredacoes?></p> 
                </div></td>
            </tr>
        </table>
        </div>
    </section>


</body>
</html>