<?php
    $dbHost = 'localhost';
    $dbUsername = '';
    $dbPassword = '';
    $dbName = 'formulario';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    if($conexao->connect_errno)
    {
        echo "Erro";
    
    }
    else
    {
        echo"Conexao efetutada com sucesso";
    }

?>    