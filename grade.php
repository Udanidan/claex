<?php
include_once "header.php";
include_once "painel.php";
include "database.php";

    $sala = $_GET['sala'];
        session_start();
        if (isset($_SESSION['usuario'])){
            $login = $_SESSION['usuario'];
            $nivel = $_SESSION['nivel'];
        }
        else{
            $login = null;
        }

        if($login){
?>
<main>
    <div class="link_nova_sala">
        <?php if($nivel != 'escola'){ ?>
        <div></div>
        <?php }else{
            ?><a href="config_sala.php?sala=<?php echo $sala; ?>"><button>configurações da sala</button></a><?php
        } ?>
        <h2><?php echo $sala; ?></h2>
        <button onclick="alert('Essa função está em desenvolvimento')">alterar grade</button>
    </div>
    <section id="grade_aula">
        <table>
            <thead>
                <th></th>
                <th>segunda</th>
                <th>terça</th>
                <th>quarta</th>
                <th>quinta</th>
                <th>sexta</th>
                <th>sabado</th>
                <th>domingo</th>
            </thead>
            
            <tbody>
                <?php
                global $db;
                $grade_segunda = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'segunda'");
                $grade_terca = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'terca'");
                $grade_quarta = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'quarta'");
                $grade_quinta = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'quinta'");
                $grade_sexta = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'sexta'");
                $grade_sabado = mysqli_query($db,"SELECT professor,materia,sala FROM aulas WHERE sala = '$sala' and username = '$login' and dias = 'sabado'");

                $horario = mysqli_query($db,"SELECT duracao_aula FROM salas_aula WHERE salas = '$sala' and username = '$login'");
                $horario = mysqli_fetch_assoc($horario);
                $horario = $horario['duracao_aula'] * 60;
                $hora = 8;
                $minuto = 00;
                ?>
                <td> <?php echo $hora.":". $minuto; ?></td>
                <?php 
                $cont = 0;
                while($sala_nova = mysqli_fetch_assoc($grade_segunda)){
                    $cont += 1;
                    if($cont/7==0){
                        echo "--";
                    }
                    if($cont % 8 != 0){
                    ?>
                    <td><?php
                    if($sala_nova['materia'] != null){
                    echo $sala_nova['materia'];
                    }else{
                        echo "--";
                    } 
                    }
                    else{
                        ?><td>
                            <?php
                            $minuto += $horario;
                            while($minuto >= 3600){
                                $hora += 1;
                                $horario -= 3600;
                            }
                            if($hora < 10){
                                echo "0".$hora.":".$minuto/60;
                            }
                            else{
                                echo $hora.":".$minuto;
                            }
                            ?>
                        </td><?php
                    }
                    ?></td>
                    <?php
                }
                ?>
                <?php
                while($sala_nova = mysqli_fetch_assoc($grade_terca)){
                    ?>
                    <td>
                    <?php
                    if($sala_nova['materia'] != null){
                    echo $sala_nova['materia'];
                    }else{
                        echo "--";
                    } ?>
                    </td>
                    <?php
                }
                ?>
                <?php
                while($sala_nova = mysqli_fetch_assoc($grade_quarta)){
                    ?>
                    <td>
                    <?php
                    if($sala_nova['materia'] != null){
                    echo $sala_nova['materia'];
                    }else{
                        echo "--";
                    } ?>
                    </td>
                    <?php
                }
                ?>
                <?php
                while($sala_nova = mysqli_fetch_assoc($grade_quinta)){
                    ?>
                    <td>
                    <?php
                    if($sala_nova['materia'] != null){
                    echo $sala_nova['materia'];
                    }else{
                        echo "--";
                    } ?>
                    </td>
                    <?php
                }
                ?>
                <?php
                while($sala_nova = mysqli_fetch_assoc($grade_sexta)){
                    ?>
                    <td>
                    <?php
                    if($sala_nova['materia'] != null){
                    echo $sala_nova['materia'];
                    }else{
                        echo "--";
                    } ?>
                    </td>
                    <?php
                }
                ?>
                <td>
                <?php
                    while($sala_nova = mysqli_fetch_assoc($grade_sabado)){
                    ?>
                    <?php
                        if($sala_nova['materia'] != null){
                            echo $sala_nova['materia'];
                        }else{
                            echo "--";
                        }
                 } ?>
                </td>
                
            </tbody>
        </table>
    </section>
</main>
<?php
        }else{
            echo "<h1>É necessario fazer login!</h1>";
        }
?>