<?php 

include('../class/tarefa.php');
include('../class/tarefa_service.php');
include('../class/connect.php');

$tarefa = new Tarefa();
$tarefa->__set('id', $_GET['id']);
// print_r($_POST);
print_r($_GET);
$conexao = new Connect();

$tarefaService = new TarefaService($conexao, $tarefa);


try {
    echo "<pre>";
    $tarefaService->status();
    $msg = $tarefa->msg;
    // normal e sucesso
    if($msg == 'sucesso') {
    header("Location: ../todas_tarefas.php?sucesso");

    } else if ($msg == 'normal') {
        header("Location: ../todas_tarefas.php");
    }
}
catch (Exception $e) {
    echo "Erro ao deletar=>".$e;
}
?>