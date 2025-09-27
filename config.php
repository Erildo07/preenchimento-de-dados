<?php
    $dbHost = 'Localhost';
    $udUsername = 'Nunes';
    $udPassord = 'portugal';
    $dbName = 'preenchimento-de-dados';

    $conexao = new mysqli($dbHost,$udUsername,$udPassord,$dbNome);
    if($conexao->connet_errno)
    {
        echo "Erro";
    
    }
    else
    {
        echo"C"
    }