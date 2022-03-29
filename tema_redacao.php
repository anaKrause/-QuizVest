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
    <link rel="stylesheet" href="style_tema_redacao.css">
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
        <li class="menu_lateral"><a href="#">Redações</a></li>
        <li class="menu_lateral"><a href="#">Apostilas</a></li>
        <li class="menu_lateral"><a href="#">Plano de estudo</a></li>
        <li class="menu_lateral"><a href="#">Simulados</a></li>
        <li class="menu_lateral"><a href="#">Meu desempenho</a></li>
        </ul>
    </div>
<section>
    <div class="redac"><p>Redações</p></div>
    <div class="espaco">
       <h3><?=$tema?></h3>
       <a href="submete_redacao.php?tema=<?=$tema?>" id="enviar">ENVIAR</a>
       <h4>TEXTOS MOTIVADORES</h4>
       <?=$listartema['textos_motivadores']?>
       <?php
        if($listartema['imagem'] <> NULL){
            echo'<img class="imagem" src="data:image/jpeg;base64,' . base64_encode( $listartema['imagem'] ) . '" />';
        }
        ?>
        <h4 id="proposta">PROPOSTA DE REDAÇÃO</h4>
        <p>A partir da leitura dos textos motivadores seguintes e com base nos conhecimentos construídos ao longo de sua formação, redija texto dissertativo-argumentativo em modalidade escrita formal da língua portuguesa sobre o tema “<?=$tema?>”, apresentando proposta de intervenção que respeite os direitos humanos. Selecione, organize e relacione, de forma coerente e coesa, argumentos e fatos para defesa de seu ponto de vista.</p>
        <div class="instrucoes">
        <ol>
            <h4>INSTRUÇÕES</h4>
            <li>Um rascunho do seu texto deve ser feito, em local apropriado, para que você saiba se obedeceu ao limite de (no máximo) 30 linhas durante a digitação.</li>
            <li>Digite ou cole sua redação na caixa de texto do Explicaê.</li>
            <li>Orientamos que escolha o tamanho da fonte de acordo com sua necessidade. Veja as opções nos links apresentados na página relacionada à correção de redação.</li>
            <li>A redação que apresentar cópia dos textos da Proposta de Redação ou do Caderno de Questões terá o número de linhas copiadas desconsiderado para efeito de correção.</li>
            <li>Após digitar ou colar seu texto, tecle no ícone ENVIAR REDAÇÃO para que sua correção seja feita.</li>
            <li>Acompanhe o ícone REDAÇÕES ENVIADAS e leia com atenção as observações e sugestões feitas pelos corretores.</li>
            <li>Receberá nota zero, em qualquer das situações expressas a seguir, a redação que:</li>
            <ul>
                <li>Desrespeitar os direitos humanos.</li>
                <li>Tiver até 7 (sete) linhas escritas, sendo considerada “texto insuficiente”.</li>
                <li>Fugir ao tema ou que não atender ao tipo dissertativo-argumentativo.</li>
                <li>Apresentar parte do texto deliberadamente desconectada do tema proposto.</li>
            </ul>
        </ol>
        </div>
    </div>
</section>
</body>
</html>