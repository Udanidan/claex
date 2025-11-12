<header>
    <img src="https://img.icons8.com/?size=100&id=8113&format=png&color=000000" width="30px" alt="menu">
    <?php
    if(isset($_SESSION['usuario'])){
        $login = $_SESSION['usuario'];
    }
    else{
        $login = null;
    }
    

    if ($login == null){ ?>
    <div>
        <a href="Front/form_login.php?tipo=logar"><button class="botao_logar">Login</button></a>
        <a href="Front/form_login.php?tipo=entrar"><button class="botao_logar">Cadastre-se</button></a>
    </div>
    <?php }else{ ?>
        <a href="listar_sala.php?usuario=<?php echo $login; ?>"><img src="" alt="fotinha"></a>
    <?php }
    ?>
</header>