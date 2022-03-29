<?php
session_start();

require_once __DIR__.'/conexao.php';
///*
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    }   
$login = $_SESSION['user'];
$email = $login['login'];

$tema = $_GET['tema'];
$procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procuranome->execute();
$nome = $procuranome->fetch(PDO::FETCH_ASSOC);


$procuratema = $conn->prepare("SELECT * FROM temas_redacao WHERE tema='$tema'");
$procuratema->execute();
$listartema = $procuratema->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_submete_redacao.css">
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
        <div class="propostaa">
    <h4 id="proposta">PROPOSTA DE REDAÇÃO</h4>
        <p>A partir da leitura dos textos motivadores seguintes e com base nos conhecimentos construídos ao longo de sua formação, redija texto dissertativo-argumentativo em modalidade escrita formal da língua portuguesa sobre o tema “<?=$tema?>”, apresentando proposta de intervenção que respeite os direitos humanos. Selecione, organize e relacione, de forma coerente e coesa, argumentos e fatos para defesa de seu ponto de vista.</p>
</div>
        <form class="redacao" action="submeter.php" method="post">
            <textarea class="caixa" name="redacaoaluno"></textarea><br>
            <input class="espelho" type="file" name="espelhoredacao" />
            <button class="botao" type="submit" name="tema" value="<?=$tema?>">Enviar</button>
                </form>
       <h4>TEXTOS MOTIVADORES</h4>
       <?=$listartema['textos_motivadores']?>
       <?php
        if($listartema['imagem'] <> NULL){
            echo'<img class="imagem" src="data:image/jpeg;base64,' . base64_encode( $listartema['imagem'] ) . '" />';
        }
        ?>

    </div>
</section>
</body>
</html>