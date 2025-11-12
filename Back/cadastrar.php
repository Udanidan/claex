<?php 
include "Classes/Usuario.php";
session_start();


    $user_name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];

    // verificar se o usuario já existe, olha isso depois
    $user = new Usuario();
    if($user->encontrar_usuario($user_name)){
        $_SESSION['mensagem'] = 'Nome de usuario já existe';
        $user = null;
        header('Location: ../Front/form_login.php?tipo=logar');
    
    } else{
        if($user->cadastrar($user_name,$email,$senha)){
            if($user->login($user_name, $senha)){
                if($nivel == 'escola'){
                    $user = null;
                    header('Location: ../Front/listar_sala.php');
                }
                else{
                    $user = null;
                    header('Location: ../Front/grade.php');
                }
            }
        }
        
        
    }