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

    // Converte o array com as aulas para uma matrix
    public function converterMatrix($array, $aulasDia){
        $matrix = [];
        $cont = 0;
        for($i=0; $i<7; $i++){
            $matrix[$i] = [];
            for($a=0; $a<$aulasDia; $a++){
                if($cont >= count($array)){
                    $matrix[$i][$a] = "--";
                } else{
                    $matrix[$i][$a] = $array[$cont];
                }
            }
        }
    }
    public function mostrarGrade($matrix, $horaInicial, $duracao_aula, $aulasDia){
        $cont = 0;
        for($i=0;$i<$aulasDia;$i++){
            echo "<tr> <td>" . ($horaInicial + ($duracao_aula * $cont)) . "</td>";
            for($a=0;$a<6;$a++){
                echo "<td>" . $matrix[$a][$i] . "</td>";
            }
            echo "</tr>";
        }
    }


}