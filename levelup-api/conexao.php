<?php

$host = "localhost";
$porta = "5432";
$banco = "levelup";
$usuario = "postgres";
$senha = "1234";

try {
    $conexao = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco",
        $usuario,
        $senha
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $erro) {
    http_response_code(500);

    echo json_encode([
        "erro" => "Erro ao conectar ao PostgreSQL: " . $erro->getMessage()
    ]);

    exit;
}