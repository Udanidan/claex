package com.claex.crud.Controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.claex.crud.Entity.MateriaEntity;
import com.claex.crud.Service.MateriaService;

@RestController
@RequestMapping("/materias")
public class MateriaController { 
    @Autowired
    private MateriaService service;

    @GetMapping("/listar")
    public List<MateriaEntity> listarTodos(){
        return service.listarTodos();
    }

    @GetMapping("/{id}")
    public MateriaEntity buscarPorId(@PathVariable Long id){
        return service.buscarPorId(id);
    }
}
