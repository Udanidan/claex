<?php
include "Database.php";
class Usuario{
    private $nome;
    private $senha;
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function encontrar_usuario($usuario) : bool {
        ($stmt = $this->db->getDb()->prepare("SELECT username FROM usuarios WHERE username=? LIMIT 1"));

        $stmt->bind_param('s', $usuario);

        $stmt->execute();

        $stmt->bind_result($username);

        $stmt->fetch();

        if($username){
            return true;
        } else{
            return false;
        }
    }

    private function dados_usuario($usuario) : array {
        ($stmt = $this->db->getDb()->prepare("SELECT username,senha,nivel FROM usuarios WHERE username=? LIMIT 1"));

        $stmt->bind_param('s', $usuario);

        $stmt->execute();

        $stmt->bind_result($username,$senha_real, $nivel);

        $stmt->fetch();

        $resultado = ["username"=>$username, "senha"=>$senha_real, "nivel"=>$nivel];
        return $resultado;
    }

    public function cadastrar($nome,$email,$password) : bool{
        // executa se não encontrar um usuario
        if(!$this->encontrar_usuario($nome)){
            $password = password_hash($password, PASSWORD_DEFAULT);

            if($stmt = $this->db->getDb()->prepare("INSERT INTO usuarios (username,email,senha) VALUES (?,?,?)")){
                ($stmt->bind_param('sss',$nome,$email,$password));
                if($stmt->execute()){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function login($nome, $senha): bool{
        if($dados = $this->dados_usuario($nome)){
            if(password_verify($senha, $dados["senha"])){
                $_SESSION["usuario"] = $dados['username'];
                $_SESSION["nivel"] = $dados['nivel'];
                return true;
            }
            return false;
        }
        return false;
    }
}