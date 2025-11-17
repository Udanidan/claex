<?php 
include_once "Modulos/head.php"; 
include_once "Modulos/header.php"; 
include_once "Modulos/painel.php"; 

// session_start();
if (isset($_SESSION['usuario'])){
    $login = $_SESSION['usuario'];
}
else{
    $login = null;
}

if($login){
    ?>
    <script src="../forms.js"></script>
<main>
    <section>
        <h1>Nova sala</h1>
        <form action="..Back/nova_sala.php" method="post" id="form_nova_sala">
            <article class="flex_colunm">
                <input type="hidden" name="login" value="<?php echo $login; ?>">
                <label>Nome da sala: <input type="text" name="nome_sala"></label><br>
                <label>Duração de uma aula: <input type="text" name="duracao_aula"></label><br>
                <label>Duração do intervalo: <input type="text" name="duracao_intervalo"></label>
            </article>
            <article>
                <h2>Adcionar matéria</h2>
                <p onclick="criarMateria(document.getElementById('form_nova_sala').children[1])">+ materia</p>

                <!-- <p onclick="convertArray(document.getElementById('form_nova_sala').children[1], 'materia')">+ teste</p>
                <p onclick="convertArray(document.getElementById('form_nova_sala').children[1], 'professor')">+ teste</p> -->
                <div>
                    <label>Matéria: <input type="text" name="materia[]"></label>
                    <label>Professor: <input type="text" name="professor[]"></label>
                </div>
                
                
            </article>
            <input type="submit" value="Criar sala" onclick="">
        </form>
    </section>
</main>

<?php
        }else{
            echo "<h1>É necessario fazer login!</h1>";
        }
        ?>
