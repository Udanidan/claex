<?php
    //forma de organizar e proteger um pouco mais os dados
        //define o host como localhost
        define("HOST","localhost");
        //define o usuario como root
        define("USER","root");
        //define a senha como none
        define("PSW","");
        //define db como claex
        define("DB","claex");

    $db = new mysqli(HOST, USER, PSW, DB);

//função para encontrar informações do usuario
function encontrar_usuario($usuario){
    global $db;
    ($stmt = $db->prepare("SELECT username,senha,nivel FROM usuarios WHERE username=?"));


    $stmt->bind_param('s', $usuario);

    $stmt->execute();

    $stmt->bind_result($username,$senha_real, $nivel);

    $stmt->fetch();

    $resultado = ["username"=>$username, "senha"=>$senha_real, "nivel"=>$nivel];
    return $resultado;
}
