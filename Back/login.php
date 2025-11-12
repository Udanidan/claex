<?php
session_start();

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    if(empty($login)){
        $_SESSION['mensagem'] = 'Digite seu nome de usuario';
        header("Location: ../Front/form_login.php?tipo=login");
        exit;
    }
    elseif(empty($senha)){
        $_SESSION['mensagem'] = 'Digite sua senha';
        header("Location: ../Front/form_login.php?tipo=login");
        exit;
    }
    else{
        include "Classes/Usuario.php";
        $user = new Usuario();

        if($user->encontrar_usuario($login)){
            // caso encontre um usuario
            // confirma se a senha está certa
            if($user->login($login,$senha)){
                if($_SESSION['nivel'] != 'escola'){
                    $user = null;
                    $nome = null;
                    $senha = null;
                    header('Location: ../Front/grade.php');
                }
                else{
                    $user = null;
                    $nome = null;
                    $senha = null;
                    header("Location: ../Front/listar_sala.php");
                }
            }
            else{
                $_SESSION['mensagem'] = 'login ou senha incorreto';
                header("Location: ../Front/form_login.php?tipo=login");
            }
        }

        else{
            $_SESSION['mensagem'] = 'usuario não encontrado';
            $user = null;
            $nome = null;
            $senha = null;
            header("Location: ../Front/form_login.php?tipo=login");
        }
    }
