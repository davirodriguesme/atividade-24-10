<?php
// Arquivo: conexao.php

// Configuração de conexão com o banco de dados
$hostname = "localhost";
$database = "db_industria";
$usuario = "root";
$senha = "";

// Criar conexão
$mysqli = new mysqli($hostname, $usuario, $senha, $database);

// Verificar se houve erro na conexão
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
?>
