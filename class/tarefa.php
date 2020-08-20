<?php


class Tarefa {
    private $id;
    private $id_status;
    private $tarefa;
    private $data_cadastro;

    private $msg;

    public function __get($atrb) {
        return $this->$atrb;
    }

    public function __set($atrb, $valor) {
        $this->$atrb = $valor;
    }
}





?>