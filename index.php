<?php
session_start();

// Inicializa lista de tarefas na sessão
if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = [];
}

// Adicionar tarefa
if (isset($_POST['nova_tarefa']) && $_POST['nova_tarefa'] !== '') {
    $_SESSION['tarefas'][] = [
        'texto' => $_POST['nova_tarefa'],
        'concluida' => false
    ];
}

// Marcar como concluída
if (isset($_GET['concluir'])) {
    $index = $_GET['concluir'];
    $_SESSION['tarefas'][$index]['concluida'] = !$_SESSION['tarefas'][$index]['concluida'];
}

// Excluir tarefa
if (isset($_GET['excluir'])) {
    $index = $_GET['excluir'];
    array_splice($_SESSION['tarefas'], $index, 1);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📝 Lista de Tarefas</h1>
        <form method="post">
            <input type="text" name="nova_tarefa" placeholder="Digite uma tarefa..." required>
            <button type="submit">Adicionar Tarefas</button>
        </form>

        <ul>
            <?php foreach ($_SESSION['tarefas'] as $index => $tarefa): ?>
                <li class="<?= $tarefa['concluida'] ? 'done' : '' ?>">
                    <?= htmlspecialchars($tarefa['texto']) ?>
                    <a href="?concluir=<?= $index ?>">✔</a>
                    <a href="?excluir=<?= $index ?>">❌</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
