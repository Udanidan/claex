<?php include_once "painel.php";

include "database.php";

function achar_salas($login){
    global $db;
    $stmt = $db->query("SELECT salas,cor FROM salas_aula WHERE salas_aula.username = '$login'");

    return $stmt;
}

?>
<main>
    <div class="link_nova_sala">
        <div style="width: 1px;"></div>
        <h1 class="align-center">Escolha uma sala</h1>
        <a href="form_nova_sala.php"><button>+ nova sala</button></a>
    </div>
    
    <section id="salas_user">
        <?php 
        session_start();
        if (isset($_SESSION['usuario'])){
            $login = $_SESSION['usuario'];
        }
        else{
            $login = null;
        }

        if($login){
            $infos = achar_salas($login);
            
            while($salas = $infos->fetch_assoc()){
                ?>
                <a href="grade.php?sala=<?php echo $salas['salas']; ?>">
                    <article class="caixa_sala <?php echo $salas['cor']; ?>">
                        <?php echo "<p>". $salas['salas']. "</p>"; ?>
                    </article>
                </a>
                <?php
            }
        }
        else{
            echo "<h1>É necessario fazer login</h1>";
        }
        ?>
    </section>
</main>