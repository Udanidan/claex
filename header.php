<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>claex</title>
</head>
<body>
    <header>
        <img src="" alt="menu">
        <?php
        if(isset($_POST['login'])){
            $login = $_POST['login'];
        }
        else{
            $login = null;
        }
        

        if ($login == null){ ?>
        <div>
            <a href="form_login.php?tipo=logar"><button class="botao_logar">Login</button></a>
            <a href="form_login.php?tipo=entrar"><button class="botao_logar">Cadastre-se</button></a>
        </div>
        <?php }else{ ?>
            <a href="listar_sala.php?usuario=<?php echo $login; ?>"><img src="" alt="fotinha"></a>
        <?php }
        ?>
    </header>