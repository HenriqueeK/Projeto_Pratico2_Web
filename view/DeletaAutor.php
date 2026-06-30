<?php
require_once __DIR__ . '/../controller/ControlaAutor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new ControlaAutor();
    $controller->deletar();
    exit;
}

header("Location: ListaAutor.php");
