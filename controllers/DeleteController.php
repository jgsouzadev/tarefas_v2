<?php 

include('../class/tarefa.php');
include('../class/tarefa_service.php');
include('../class/connect.php');

$tarefa = new Tarefa();
$tarefa->__set('id', $_GET['id']);
// print_r($_POST);
$conexao = new Connect();

$tarefaService = new TarefaService($conexao, $tarefa);


try {
    $tarefaService->remover();
    header('Location: ../todas_tarefas.php?remocao=sucess');
}
catch (Exception $e) {
    echo "Erro ao deletar=>".$e;
}
?>