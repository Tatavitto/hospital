<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Cadastro de Pacientes</title>
</head>
<body>
    <h1>Cadastro de Pacientes</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="lei">Leito:</label>
        <input type="text" id="lei" name="lei" required><br><br>

        <input type="submit" value="Salvar">
    </form>

    <?php
    $servidor = 'localhost';
    $banco = 'hospital';
    $usuario = 'root';
    $senha = '';

    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    
    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigoSQL = "INSERT INTO `pacientes` (`id`, `nome`, `leito`) VALUES (NULL, :nm, :lei)";

        try {
            $comando = $conexao->prepare($codigoSQL);

            // Capturar os dados do formulário
            $resultado = $comando->execute(array(
                'nm' => $_POST['nome'],
                'lei' => $_POST['lei']
            ));

            if ($resultado) {
                echo "<p>Paciente cadastrado!</p>";
            } else {
                echo "<p>Erro ao executar o comando!</p>";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    $conexao = null;
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>


