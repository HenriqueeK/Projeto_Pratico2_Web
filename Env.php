<?php

// Carrega o .env apenas se as variáveis ainda não estiverem no ambiente.
if (!getenv('DB_HOST')) {
    $linhas = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($linhas as $linha) {
        if (str_starts_with(trim($linha), '#')) continue;

        [$chave, $valor] = explode('=', $linha, 2);
        putenv(trim($chave) . '=' . trim($valor));
    }
}