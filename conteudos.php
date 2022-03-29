<?php
                session_start();
                require_once __DIR__.'/conexao.php';
                if(!isset($_SESSION['user'])){
                    header('Location:./entrar.php');
                    } 
                    $login = $_SESSION['user'];
                    $email = $login['login'];
                $indice = 0;
                $indicesubconteudo = 0;
                $materia = $_POST['materia'];
                $_SESSION['materia'] = $materia;
                //$materia = 'biologia';

                $quest = "perguntas_";
                $quest.=$materia;
                $buscamaterial = $conn->prepare("SELECT DISTINCT conteudo FROM conteudos WHERE disciplina='$materia'");
                $buscamaterial->execute();

                $procuranome = $conn->prepare("SELECT * FROM usuarios WHERE email='$email'");
                $procuranome->execute();
                $nome = $procuranome->fetch(PDO::FETCH_ASSOC);
                ?>
<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <meta charset="utf-8">
        <title>Conteúdo</title>

        <link rel="stylesheet" href="style_conteudos.css">
        <link rel="stylesheet" href="style_conteudo.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    </head>

    <body class="body">
        <header>
            <div id="cabecalho">  
                <div class="menu">
                    <div id="nTexto">
                    <a href="#primeiro"><img class="ima" src="imagens/logoo.png"></a> 
                        <input type="text" id="txtBusca" placeholder="Buscar..."/>
                        <a href="#"> <img  class="lup" src="imagens/lupa.png" id="btnBusca" alt="Buscar"/></a>
                        <a href="#"><img class ="notif" src="imagens/not.png" /></a>
                        <a href="#"><img class="user" src="imagens/user.png"></a>
                      </div>
                   <div class="txt">
                       <h1>Olá, <?=$nome['nome']?>!</h1>
                   </div>
                </div>
            </div>
        </header>

        <div class="opcao">
            <img id="icone" src="imagens/icones/<?=$materia?>.png">
            
                <div class="aula">Aulas</div>
                <div class="tira">Tira-Dúvidas</div>
                <div class="apo">Apostilas</div>
                <div class="exerc">Exercícios</div>
        </div>

        <div class="fundo">
            <div class="listacont"> 
                <ol>




<?php
                while($resultado = $buscamaterial->fetch(PDO::FETCH_ASSOC)){
                    $indice++;
                    $conteudo = $resultado['conteudo'];
                    echo "<selection><details> <summary>".$indice.".   ".$conteudo."</summary><ul>";
                
                
                    $buscasubconteudo = $conn->prepare("SELECT * FROM conteudos WHERE conteudo='$conteudo'");
                    $buscasubconteudo->execute();
                    while($subconteudo = $buscasubconteudo->fetch(PDO::FETCH_ASSOC)){
                        $indicesubconteudo++;
 
                    echo '<li><a href="./aula.php?subconteudo='.$subconteudo['subconteudo'].'">'.$indice.'.'.$indicesubconteudo.'. '.$subconteudo['subconteudo'].'</a></li>';
                    }
                    echo '<li>'.'<a href="redireciona_pg.php">Questinário</a>'
                    .'</ul>'.'</details></selection>';
                
                
                
                    $_SESSION['perguntas'] = $quest;
                    $indicesubconteudo = 0;
                
                
                }
                
                ?>



            </div>
        </div>
       
        
            
  </body>

  <div class="footer">
   
</div>

</html>