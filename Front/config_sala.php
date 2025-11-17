<?php
    // session_start();
    include_once "Modulos/head.php";
    include_once "Modulos/header.php";
    include_once "Modulos/menu.php";

    $sala = $_GET['sala'];
    $login = $_SESSION['usuario'];

    // global $db;
    // $a = mysqli_query($db,"SELECT nome_sala,duracao_aula,duracao_intervalo FROM salas_aula WHERE usarname='$login'");
    // $a = mysqli_fetch_assoc($a);
?>

<form action="../Back/atualizar_sala.php" method="post" id="form_nova_sala">
    <article class="flex_colunm">
        <input type="hidden" name="login" value="<?php echo $login; ?>">
        <label>Nome da sala: <input type="text" name="nome_sala" value="<?php echo $sala ?>"></label><br>
        <label>Duração de uma aula: <input type="text" name="duracao_aula" <?php //echo $a['duracao_aula']; ?>></label><br>
        <label>Duração do intervalo: <input type="text" name="duracao_intervalo" <?php // echo $a['duracao_intervalo']; ?>></label>
    </article>
    <article>
        <div>
            <h2>Adcionar matéria</h2>
            <label>Matéria: <input type="text" name="materia"></label>
            <label>Professor: <input type="text" name="professor"></label>
        </div>
    </article>
    
    <input type="submit" value="atualizar sala">
</form>
