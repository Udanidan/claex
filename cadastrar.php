<?php include "database.php";
session_start();
function cadastrar($nome,$email,$password){
    global $db;
    $password = password_hash($password, PASSWORD_DEFAULT);
    ($stmt = $db->prepare("INSERT INTO usuarios (username,email,senha) VALUES (?,?,?)"));
    ($stmt->bind_param('sss',$nome,$email,$password));
    ($stmt->execute());
}

    $user_name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];

    // verificar se o usuario já existe, olha isso depois
    // // $login = encontrar_usuario($user_name)['username'];
    // if($user_name == $login){
    //     $_SESSION['mensagem'] = 'Nome de usuario já existe';
    //     $login = null;
    //     header('Location: form_login.php?tipo=logar');
    // 
    // else{
        cadastrar($user_name,$email,$senha);
        $_SESSION['usuario'] = $user_name;
        
        if($nivel == 'escola'){
            header('Location: listar_sala.php');
        }
        else{
            header('Location: grade.php?username='.$login);
        }
        $login = null;
    // }