<?php
require "Classes/Escola.php";

// require "database.php";
// function cadastrar_sala($sala,$duracao_aula,$duracao_intervalo,$username){
//     global $db;
//     ($stmt = $db->prepare("INSERT INTO salas_aula (salas,duracao_aula,duracao_intervalo,username) VALUES (?,?,?,?)"));
//     ($stmt->bind_param('siis',$sala,$duracao_aula,$duracao_intervalo,$username));
//     ($stmt->execute());
// }

// function Cadastrar_materia($materia,$professor,$sala,$username){
//     global $db;
//     ($stmt = $db->prepare("INSERT INTO aulas (materia,professor,sala,username) VALUES (?,?,?,?)"));
//     ($stmt->bind_param('ssss',$materia,$professor,$sala,$username));
//     ($stmt->execute());
// }

    $user = new Escola();

    $login = $_POST['login'];

    $nome_sala = $_POST['nome_sala'];
    $duracao_aula = $_POST['duracao_aula'];
    $duracao_intervalo = $_POST['duracao_intervalo'];

    $materia = $_POST['materia'];
    $professor = $_POST['professor'];
    
    session_start();

    if($user->cadastrar_sala($nome_sala,$duracao_aula,$duracao_intervalo,$login)){

        if($user->Cadastrar_materia($materia,$professor,$nome_sala,$login)){
            
        }
        $_SESSION["mensagem"] = "Sala cadastrada com sucesso!";
        header('Location: ../front/listar_sala.php');
    }


    $_SESSION['usuario'] = $login;
    header('Location: ../front/listar_sala.php');