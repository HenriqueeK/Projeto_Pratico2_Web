<?php
require_once __DIR__ . '/../controller/ControlaLivro.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new ControlaLivro();
    $controller->deletar();
    exit;
}

header("Location: ListaLivro.php");
