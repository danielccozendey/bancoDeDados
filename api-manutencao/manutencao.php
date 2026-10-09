<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {

    $json = file_get_contents("php://input");
    
    $dados = json_decode($json, true);

    if ($dados["prioridade"] == "baixa" || $dados["prioridade"] == "media" or $dados["prioridade"] == "alta") {

        if ($dados["status_atual"] == "aberto" || $dados["status_atual"] == "em andamento" or $dados["status_atual"] == "concluido") {

            $sql = "INSERT INTO chamados (equipamento, setor, descricao, prioridade, status_atual) VALUES (?, ?, ?, ?, ?)";
            $comando = $pdo->prepare($sql);

            $comando -> execute([
                $dados["equipamento"],
                $dados["setor"],
                $dados["descricao"],
                $dados["prioridade"],
                $dados["status_atual"]
            ]);

            echo json_encode(["Mensagem"=>"Chamado cadastrado com sucesso!"]);

        } else {
            echo json_encode([
            "Mensagem" => "Digite um status valido (aberto, em andamento ou concluido)."
            ]);

        }

    } else{
            echo json_encode([
            "Mensagem" => "Digite uma prioridade valida (baixa, media ou alta)."
            ]);

    };
}

if ($metodo == "GET") {
    
    $sql = "SELECT * FROM chamados";
    
    $comando = $pdo->prepare($sql);
    
    $comando->execute();
    
    $chamados = $comando->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($chamados);
}

if ($metodo == "PUT") {
    
    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    if ($dados["prioridade"] == "baixa" || $dados["prioridade"] == "media" or $dados["prioridade"] == "alta") {

        if ($dados["status_atual"] == "aberto" || $dados["status_atual"] == "em andamento" or $dados["status_atual"] == "concluido") {

            $sql = "UPDATE chamados SET equipamento=?, setor=?, descricao=?, prioridade=?, status_atual=? WHERE id=?";
            $comando = $pdo->prepare($sql);

            $comando -> execute([
                $dados["equipamento"],
                $dados["setor"],
                $dados["descricao"],
                $dados["prioridade"],
                $dados["status_atual"],
                $dados["id"]
            ]);

            echo json_encode(["Mensagem"=>"Chamado atualizado com sucesso!"]);

        } else {
            echo json_encode([
            "Mensagem" => "Digite um status valido (aberto, em andamento ou concluido)."
            ]);

        }

    } else{
            echo json_encode([
            "Mensagem" => "Digite uma prioridade valida (baixa, media ou alta)."
            ]);

    }
}

if ($metodo == "DELETE") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "DELETE FROM chamados WHERE id=?";

    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados["id"]
    ]);
    
    echo json_encode([
        "Mensagem"=>"Chamado deletado com sucesso!"
    ]);

}