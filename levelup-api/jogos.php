<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo === "POST") {

    $dados = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($dados["titulo"]) ||
        !isset($dados["plataforma"]) ||
        !isset($dados["genero"]) ||
        !isset($dados["desenvolvedora"]) ||
        !isset($dados["ano_lancamento"]) ||
        !isset($dados["preco"]) ||
        !isset($dados["estoque"])
    ) {
        http_response_code(400);

        echo json_encode([
            "erro" => "Todos os campos são obrigatórios."
        ]);

        exit;
    }

    $sql = "INSERT INTO jogos (
                titulo,
                plataforma,
                genero,
                desenvolvedora,
                ano_lancamento,
                preco,
                estoque
            ) VALUES (
                :titulo,
                :plataforma,
                :genero,
                :desenvolvedora,
                :ano_lancamento,
                :preco,
                :estoque
            )";

    try {
        $comando = $conexao->prepare($sql);

        $comando->execute([
            ":titulo" => $dados["titulo"],
            ":plataforma" => $dados["plataforma"],
            ":genero" => $dados["genero"],
            ":desenvolvedora" => $dados["desenvolvedora"],
            ":ano_lancamento" => $dados["ano_lancamento"],
            ":preco" => $dados["preco"],
            ":estoque" => $dados["estoque"]
        ]);

        http_response_code(201);

        echo json_encode([
            "mensagem" => "Jogo cadastrado com sucesso!"
        ]);

    } catch (PDOException $erro) {
        http_response_code(500);

        echo json_encode([
            "erro" => "Erro ao cadastrar o jogo: " . $erro->getMessage()
        ]);
    }

} elseif ($metodo === "GET") {

    try {
        $sql = "SELECT * FROM jogos ORDER BY titulo ASC";

        $comando = $conexao->prepare($sql);
        $comando->execute();

        $jogos = $comando->fetchAll();

        echo json_encode($jogos, JSON_UNESCAPED_UNICODE);

    } catch (PDOException $erro) {
        http_response_code(500);

        echo json_encode([
            "erro" => "Erro ao buscar os jogos: " . $erro->getMessage()
        ]);
    }

} else {
    http_response_code(405);

    echo json_encode([
        "erro" => "Método não permitido. Use GET ou POST."
    ]);
}