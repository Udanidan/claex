<?php
require "database.php";
function atualizar_sala($sala,$duracao_aula,$duracao_intervalo,$username){
    global $db;
    ($stmt = $db->prepare("UPDATE salas_aula SET salas=?, duracao_aula=?,duracao_intervalo=? WHERE username=?"));
    ($stmt->bind_param('siis',$sala,$duracao_aula,$duracao_intervalo,$username));
    ($stmt->execute());
}
    $login = $_POST['login'];

    $nome_sala = $_POST['nome_sala'];
    $duracao_aula = $_POST['duracao_aula'];
    $duracao_intervalo = $_POST['duracao_intervalo'];

    $materia = $_POST['materia'];
    $professor = $_POST['professor'];

    atualizar_sala($nome_sala,$duracao_aula,$duracao_intervalo,$login);

    $_SESSION['usuario'] = $login;
    header('Location:listar_sala.php');
