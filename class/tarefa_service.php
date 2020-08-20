<?php

class TarefaService {
    private $conexao;
    private $tarefa;

    public function __construct(Connect $conexao,Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir() {
        $query = 'insert into tb_tarefas(tarefa) values(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function recuperar() {
        $query = '
        select 
            t.id , s.status, t.tarefa 
        from 
            tb_tarefas as t
            left join tb_status as s on (t.id_status = s.id)
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function atualizar() {
        $query = "update tb_tarefas set tarefa = :tarefa where id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function remover() {
     $query = "delete from tb_tarefas where id = ?";
     $stmt = $this->conexao->prepare($query);
     $stmt->bindValue(1, $this->tarefa->__get('id'));
     return $stmt->execute();
    // echo $this->tarefa->__get('id');
    }

    public function status() {
     $queryAtualID = "SELECT id_status from tb_tarefas where id = ?";
     $stmt = $this->conexao->prepare($queryAtualID);
     $stmt->bindValue(1, $this->tarefa->__get('id'));
     $stmt->execute();
     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $id = $data[0]['id_status'];
     if($id == 1) {
        $query = "update tb_tarefas set id_status = 2 where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id'));
        $stmt->execute();
        $this->tarefa->msg = 'sucesso';


     } else if($id == 2) {
        $query = "update tb_tarefas set id_status = 1 where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id'));
        $stmt->execute();
        $this->tarefa->msg = 'normal';

    }
    }

    public function recuperarPendentes() {
        $query = '
        select t.id , s.status, t.tarefa from tb_tarefas as t left join tb_status as s on t.id_status = s.id where t.id_status = 1 
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

?>