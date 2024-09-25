<?php
require 'config.php';
require 'verifica_sessao.php'; 

$query = "SELECT * FROM tarefas";
$result = $mysqli->query($query);

$now = new DateTime();
$dataCol = $now->format('d-m-y');



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD de Tarefas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="crud.css">
</head>
<body>
  <header>
    <div>
      <h4><a href="crudUsuarios.php" style="text-decoration: none; color: white;">USER</a></h4>
    </div>
  </header>
  <div class="container">
    <h2 class="text-center">CRUD de Tarefas</h2>

    <!-- Formulário para adicionar tarefas -->
    <div class="form-container">
      <form action="tarefas.php" action="deletarUsuario.php" method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Título da Tarefa</label>
          <input type="text" class="form-control" id="title" name="titulo" placeholder="Digite o título da tarefa" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Descrição da Tarefa</label>
          <textarea class="form-control" id="description" name="descricao" placeholder="Digite a descrição da tarefa" rows="3" required></textarea>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>

    <!-- Tabela de tarefas -->
    <div class="form-container">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="taskTable">
        <?php
        while ($talbetare = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$talbetare['id']."</td>";
            echo "<td>".$talbetare['titulo']."</td>";
            echo "<td>".$talbetare['descricao']."</td>";
            echo "<td>".$dataCol."</td>";
            echo "<td>
                    <form action='tarefas.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='".$talbetare['id']."'>
                        <button type='submit' name='apagar' class='btn btn-danger btn-sm'>Apagar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>