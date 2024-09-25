<?php
require 'config.php';
require 'verifica_sessao.php'; 

$query = "SELECT * FROM user_db";
$result = $mysqli->query($query);

$now = new DateTime();
$dataCol = $now->format('d-m-y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="crud.css">
</head>
<body>
  <header>
    <div>
      <h4><a href="crudTarefas.php" style="text-decoration: none; color: white;">TAREFAS</a></h4>
    </div>
  </header>
  <div class="container">
    <h2 class="text-center">CRUD Usuários</h2>
    <!-- Tabela de usuários -->
    <div class="form-container">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="taskTable">
        <?php
        while ($usuario = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$usuario['id']."</td>";
            echo "<td>".$usuario['nome']."</td>";
            echo "<td>".$usuario['email']."</td>";
            echo "<td>".$dataCol."</td>";
            echo "<td>
                    <a href='../frontend/atualizaruser.html'><button class='btn btn-warning btn-sm'>Editar</button></a>
                    <form action='deletarUsuario.php' method='post' style='display:inline;'>
                      <input type='hidden' name='id' value='".$usuario['id']."'>
                      <button type='submit' class='btn btn-danger btn-sm'>Apagar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-2Kkgb+9hU+4p9nMlXtvxq5q7RO+jH9B+D2g6NwJ3gVqUQEtUu/SVO0oU1e2w4Oqm" crossorigin="anonymous"></script>
</body>
</html>
