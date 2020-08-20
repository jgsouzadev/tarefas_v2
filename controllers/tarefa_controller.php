<?php

require("../class/connect.php");
require("../class/tarefa.php");
require("../class/tarefa_service.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['desc']);

    $conexao = new Connect();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefaService->inserir();

    header('Location: ../nova_tarefa.php?inclusao=1');
}

?>
