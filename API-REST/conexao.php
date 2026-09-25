<?php

$host = "192.168.10.82";
$banco = "lojasegundao";
$usuario = "postgres";
$senha = "1234";

$pdo = new PDO(
    "pgsql:host=$host;port=5432;dbname=$banco",
    $usuario,
    $senha);