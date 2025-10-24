<?php 
include_once "header.php"; 
include_once "painel.php"; 

        session_start();
        if (isset($_SESSION['usuario'])){
            $login = $_SESSION['usuario'];
        }
        else{
            $login = null;
        }

        if($login){
?>

<main>
    <section>
        <p>Nova sala</p>
        <form action="nova_sala.php" method="post" id="form_nova_sala">
            <article class="flex_colunm">
                <input type="hidden" name="login" value="<?php echo $login; ?>">
            <label>Nome da sala: <input type="text" name="nome_sala"></label><br>
            <label>Duração de uma aula: <input type="text" name="duracao_aula"></label><br>
            <label>Duração do intervalo: <input type="text" name="duracao_intervalo"></label>
            </article>
            <article>
                <div>
                    <p>adcionar matéria</p>
                    <label>Matéria: <input type="text" name="materia"></label>
                    <label>Professor: <input type="text" name="professor"></label>
                </div>
            </article>
            <input type="submit" value="Criar sala">
        </form>
    </section>
</main>

<?php
        }else{
            echo "<h1>É necessario fazer login!</h1>";
        }
?>
