<?php
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/helper.php';
    require __DIR__ . '/env.php';

    try {
        $pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;port=%s;charset=%s',
                $env['DB_HOST'],
                $env['DB_DATABASE'],
                $env['DB_PORT'],
                $env['DB_CHARSET']
            ),
            $env['DB_USERNAME'],
            $env['DB_PASSWORD']
        );
    } catch (PDOException $e) {
        error_die('Database connection is failed.');
    }
