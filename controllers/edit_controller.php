<?php 

include('../class/tarefa.php');
include('../class/tarefa_service.php');
include('../class/connect.php');

$tarefa = new Tarefa();
$tarefa->__set('id', $_POST['id']);
$tarefa->__set('tarefa', $_POST['ndesc']);
// print_r($tarefa);
$conexao = new Connect();

$tarefaService = new TarefaService($conexao, $tarefa);


try {
    $tarefaService->atualizar();
    header('Location: ../todas_tarefas.php');
}
catch (Exception $e) {
    echo "Erro ao atualizar=>".$e;
}
?>