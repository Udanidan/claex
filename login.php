<?php include 'database.php';

session_start();


    
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];
    
    if(empty($usuario)){
        $_SESSION['mensagem'] = 'Digite seu nome de usuario';
        header("Location: form_login.php?tipo=login");
        exit;
    }
    elseif(empty($senha)){
        $_SESSION['mensagem'] = 'Digite sua senha';
        header("Location: form_login.php?tipo=login");
        exit;
    }
    else{
        $login = encontrar_usuario($usuario);

        if($login){
            // caso encontre um usuario
            // confirma se a senha está certa
            if(password_verify($senha,$login['senha'])){
                $_SESSION["usuario"] = $login['username'];
                $_SESSION["nivel"] = $login['nivel'];
                if($login['nivel'] != 'escola'){
                    header('Location: grade.php?username='.$login['username']);
                    $login = null;
                }
                else{
                $login = null;
                header("Location: listar_sala.php");
                }
            }
            else{
                $_SESSION['mensagem'] = 'login ou senha incorreto';
                header("Location: form_login.php?tipo=login");
            }
        }

        else{
            $_SESSION['mensagem'] = 'usuario não encontrado';
            $login = null;
            header("Location: form_login.php?tipo=login");
        }
    }
