<?php 

    $tarefa = new Tarefa();
    $conexao = new Connect();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();

?>