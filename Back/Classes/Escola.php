<?php
include "Usuario.php";
class Escola extends Usuario{
    // private array $salas;
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function achar_salas($login){
        ($stmt = $this->db->getDb()->prepare("SELECT salas,cor FROM salas_aula WHERE username = ?"));

        $stmt->bind_param('s', $login);

        $stmt->execute();

        $result = $stmt->get_result();
        
        return $result;
    }

    public function cadastrar_sala($sala,$duracao_aula,$duracao_intervalo,$username): bool{
        if($stmt = $this->db->getDb()->prepare("INSERT INTO salas_aula (salas,duracao_aula,duracao_intervalo,username) VALUES (?,?,?,?)")){
            ($stmt->bind_param('siis',$sala,$duracao_aula,$duracao_intervalo,$username));
            
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        return false;
    }

    public function Cadastrar_materia($materia,$professor,$sala,$username){
        if($stmt = $this->db->getDb()->prepare("INSERT INTO aulas (materia,professor,sala,username) VALUES (?,?,?,?)")){
            ($stmt->bind_param('ssss',$materia,$professor,$sala,$username));

            if($stmt->execute()){
                return true;
            }
            return false;
        }
        return false;
    }


}