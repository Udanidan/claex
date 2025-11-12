<?php include_once "Modulos/head.php"; ?>
<body>
    <main>
        <?php
            session_start();
            if (isset($_GET['tipo'])){
                $tipo_form = $_GET['tipo'];
            }
            else{
                $tipo_form = null;
            }
            ?>
        <section id="sect_login">
            <article class="flex_colunm">
                <img id="img_login" src="https://img.icons8.com/?size=100&id=TDMY9h1UHdNW&format=png&color=000000" alt="">
                <h1 id="sumir">Bem-vindo a claex!</h1>
            </article>
            <article class="flex_colunm">
                <h1>CLAEX</h1>

                <?php if ($tipo_form != 'entrar'){ ?>

                    <!-- Login -->
                <form id="formulario_login" action="../Back/login.php" method="post">
                    <input type="text" name="login" id="login" placeholder="nome de usuraio">
                    <input type="password" name="senha" id="senha" placeholder="senha">
                    <?php
                        if (isset($_SESSION['mensagem'])){
                            $mensagem = $_SESSION['mensagem'];
                            echo "<p style='color:red'>" . $mensagem . "</p>";
                        } unset($_SESSION['mensagem']); ?>
                    <input type="submit" class="submit" value="Entrar">
                </form>

                <p>Não possui uma conta? <a href="form_login.php?tipo=entrar">clique aqui</a></p>
                
                <?php } else{ ?>

                    <!-- Cadastro -->
                    <form id="formulario_login" action="../Back/cadastrar.php" method="post">
                        <input type="text" name="nome" id="nome" placeholder="nome">
                        <input type="text" name="email" id="email" placeholder="email">
                        <input type="password" name="senha" id="senha" placeholder="senha">
                        <select name="select">
                            <option value="escola">Escola</option>
                            <option value="professor">Professor</option>
                            <option value="aluno">Aluno</option>
                        </select>
                        <?php if (isset($_SESSION['mensagem'])){
                            $mensagem = $_SESSION['mensagem'];
                            echo "<p style='color:red'>" . $mensagem . "</p>";
                        } unset($_SESSION['mensagem']); ?>
                        <input type="submit" class="submit" value="cadastrar">
                    </form>

                    <p>Possui uma conta? <a href="form_login.php?tipo=logar">clique aqui</a></p>
                <?php } ?>
            </article>
        </section>
    </main>
</body>
</html>