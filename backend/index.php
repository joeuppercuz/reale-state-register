<?php
    require __DIR__ . '/core/bootstrap.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        view('backend.login');
    } elseif ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        error_die('Method not allowed.');
    }

    if ($_POST['user'] !== $env['BACKEND_USERNAME'] || $_POST['pass'] !== $env['BACKEND_PASSWORD']) {
        view('backend.login', ['error' => 'Username or password incorrect']);
    }

    $sql = "SELECT * FROM {$env['DB_TABLE']} ORDER BY id ASC";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $records = [];

    while (($record = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $records[] = $record;
    } 

    view('backend.data', ['records' => $records]);
