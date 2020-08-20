<?php
require("class/connect.php");
require("class/tarefa.php");
require("class/tarefa_service.php");

include("controllers/pendentesController.php");
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="http://localhost/app_tasks/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="imagem logo">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />
								<?php
							foreach ($tarefas as $indice => $tarefa) {


							?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9"><?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<a href="?DELETe=true&idTd=<?= $tarefa->id ?>"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
										<a href="?action=edit&idT=<?= $tarefa->id ?>"><i class="fas fa-edit fa-lg text-info"></i></a>
										<!-- script de redirect -->

										<?php

										if (isset($_GET['DELETe'])) {
											$thisId = $_GET['idTd'];

											header("Location: controllers/DeleteController.php?id=$thisId");
										} else if (isset($_GET['statusChange'])) {
											$thisId = $_GET['idTd'];

											header("Location: controllers/TarefaStatusController.php?id=$thisId");
										}

										?>



										<a href="?statusChange=true&idTd=<?=$tarefa->id ?>"><i class="fas fa-check-square fa-lg text-success"></i></a>

									</div>


									<!-- script pra inserção de formulario dinamico no campo que será alterado -->
									<?php
									if (isset($_GET['action']) && isset($_GET['action']) == 'edit') {
										$id_modify = $_GET['idT'];
										if ($id_modify == $tarefa->id) {
									?>
											<div class="container">
												<form method="POST" action="controllers/edit_controller.php?sucess=1">
													<div class="form-group">
														<label>Nova descrição da tarefa:</label>
														<input type="text" name="ndesc" class="form-control" placeholder="Nova tarefa...">
														<input type="hidden" name="id" value="<?= $tarefa->id ?>">

													</div>
													<button class="btn btn-success">Modificar</button>
											</div>


									<?php }
									} ?>
								</div>

							<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>