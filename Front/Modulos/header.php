<header>
     <div></div>
    <?php
    session_start();
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
        <a href="listar_sala.php"><img src="https://bkpsitecpsnew.blob.core.windows.net/uploadsitecps/sites/197/2024/12/centro-paula-souza.jpg" style="width: 40px; border-radius: 50%; height: 40px;" alt="fotinha"></a>
    <?php }
    ?>
</header>