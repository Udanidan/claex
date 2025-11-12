<?php include_once "header.php"; ?>

<section id="painel">
    <img src="https://bkpsitecpsnew.blob.core.windows.net/uploadsitecps/sites/197/2024/12/centro-paula-souza.jpg" alt="">
    <article>
        <h1><?php if(isset($_SESSION['usuario'])){echo $_SESSION['usuario'];} ?></h1>
        <p>Professores: <?php  ?></p>
        <p>salas: <?php  ?></p>
    </article>
</section>