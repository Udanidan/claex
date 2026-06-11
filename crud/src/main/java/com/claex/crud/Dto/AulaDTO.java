package com.claex.crud.Dto;

import com.claex.crud.Entity.AulaEntity;
import com.claex.crud.Service.MateriaService;
import com.claex.crud.Service.ProfessorService;

public class AulaDTO {
    private Long id_materia;
    private Long id_professor;
    
    public AulaDTO(Long id_materia, Long id_professor){
        this.id_materia = id_materia;
        this.id_professor = id_professor;
    }

    public AulaEntity gerarAula(){
        AulaEntity aula = new AulaEntity();
        MateriaService serviceM = new MateriaService();
        ProfessorService serviceP = new ProfessorService();

        aula.setId_materia(serviceM.buscarPorId(id_materia));
        aula.setId_professor(serviceP.buscarPorId(id_professor));
        return aula;
    }
}
