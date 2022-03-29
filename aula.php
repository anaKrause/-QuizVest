<?php
session_start();

$subconteudo = $_GET['subconteudo'];

require_once __DIR__.'/conexao.php';
if(!isset($_SESSION['user'])){
    header('Location:./entrar.php');
    } 
    $login = $_SESSION['user'];
    $email = $login['login'];

$selecionavideo = $conn->prepare("SELECT * FROM conteudos WHERE subconteudo = '$subconteudo'");
$selecionavideo->execute();
$video = $selecionavideo->fetch(PDO::FETCH_ASSOC);
$idsubconteudo = $video['id'];
$conteudo = $video['conteudo'];

$listasubconteudos = $conn->prepare("SELECT * FROM conteudos WHERE conteudo = '$conteudo' AND id > '$idsubconteudo'");
$listasubconteudos->execute();
$listaprox = $conn->prepare("SELECT * FROM conteudos WHERE conteudo = '$conteudo' AND id > '$idsubconteudo'");
$listaprox->execute();
$materia = $_SESSION['perguntas'];

$procurauser = $conn->prepare("SELECT * FROM usuarios WHERE email = '$email'");
$procurauser->execute();
$user = $procurauser->fetch(PDO::FETCH_ASSOC);

$nota=0;
$procurascore = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
$procurascore->execute();
$score = $procurascore->fetch(PDO::FETCH_ASSOC);

$contagemredacoes = $conn->prepare("SELECT COUNT(emailAluno) AS qntredacoes FROM redacoes");
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
        <title>Aula</title>

        <link rel="stylesheet" href="style_aula.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    </head>

    <body class="body">
        <header>
            <div id="cabecalho">  
                <div class="menu">
                    <div id="nTexto">
                    <a href="index.php"><img class="ima" src="imagens/logoo.png"></a> 
                        <input type="text" id="txtBusca" placeholder="Buscar..."/>
                        <a href="#"> <img  class="lup" src="imagens/lupa.png" id="btnBusca" alt="Buscar"/></a>
                        <a href="#"><img class ="notif" src="imagens/not.png" /></a>
                        <a href="#"><img class="user" src="imagens/user.png"></a>
                      </div>
                   <div class="txt">
                       <h1>Olá, <?=$user['nome']?>!</h1>
                   </div>
                </div>
            </div>
        </header>
        <div class="espaco">
            <div class="titulo-aula">
                <h1><?=$video['conteudo']?>: <?=$subconteudo?></h1>
            </div>
            <div class="video-borda">
                <div class="video">
                <iframe width="830.2" height="330.2" src="<?=$video['linkvideo']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="titulo-fila">
                <h1>Próximos Conteúdos:</h1>
                <div class="fila">
                    <table>
                        <?php
                        $prox = $listaprox->fetch(PDO::FETCH_ASSOC);
                        while($subconteudos = $listasubconteudos->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td><a class="prox" href="./aula.php?subconteudo='.$subconteudos['subconteudo'].'">'.$subconteudos['subconteudo'].'</a></td></tr>';
                        }
                        
                        ?>
                        
                    </table>
                </div>

            </div>
                <a class="next" href="./aula.php?subconteudo=<?=$prox['subconteudo']?>" > Próximo conteúdo</a><br>
                <a href="redireciona_pg.php" class="responder-quest">Responder o questionário agora</a>
               
            <div class="aviso">
                Você também pode assistir o conteúdo completo para responder o questionário
            </div>
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
    </body>
</html>