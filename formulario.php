<?php
$mensagem = ""; // Variável para armazenar a mensagem

if(isset($_POST['submit'])) {

    include_once('config.php');

    // Escapa os dados para evitar problemas com aspas e SQL Injection
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['genero']);
    $data_de_nasc = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

    // Verifica se o email já existe
    $verifica = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email'");
    if(mysqli_num_rows($verifica) > 0) {
        $mensagem = "Este email já está cadastrado!";
    } else {
        // Insere os dados no banco
        $sql = "INSERT INTO usuario
        (nome,email,telefone,sexo,data_de_nasc,cidade,estado,endereco)
        VALUES
        ('$nome','$email','$telefone','$sexo','$data_de_nasc','$cidade','$estado','$endereco')";

        if(mysqli_query($conexao, $sql)) {
            $mensagem = "Usuário cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | MD</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(177, 26, 26), rgb(141, 26, 248));
        }
        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            border-radius: 15px;
            width: 18%;
        }
        fieldset {
            border: 3px solid rgb(12, 197, 230);
        }
        legend {
            border: 1px solid rgb(13, 248, 248);
            padding: 8px;
            text-align: center;
            background-color: rgb(21, 194, 224);
            border-radius: 10px;
        }
        .inputBox {
            position: relative;
        }
        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: #fff;
            font-size: 13px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelinput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelinput,
        .inputUser:valid ~ .labelinput {
            top: -20px;
        }
        #data_nascimento {
            border: none;
            padding: 8px;
            border-radius: 8px;
            outline: none;
            font-size: 13px;
        }
        #submit {
            background-image: linear-gradient(to right, rgb(197, 184, 0), rgb(53, 220, 20));
            border: none;
            padding: 13px;
            color: white;
            font-size: 13px;
            cursor: pointer;
            border-radius: 7px;
        }
        #submit:hover {
            background-image: linear-gradient(to right, rgb(103, 248, 6), rgb(18, 197, 123));
        }
    </style>
</head>
<body>
    <div class="box">
        <!-- Mensagem de feedback -->
        <?php if(!empty($mensagem)) { ?>
            <p style="color: yellow; text-align: center; font-weight: bold;">
                <?php echo $mensagem; ?>
            </p>
        <?php } ?>

        <form action="formulario.php" method="post">
            <fieldset>
                <legend><b>Formulário de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelinput">Nome completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelinput">Email</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelinput">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelinput">Cidade</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelinput">Estado</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelinput">Endereço</label>
                </div>
                <br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>
