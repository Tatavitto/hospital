<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Cadastro de Receitas</title>
</head>
<body>
    <h1>Cadastro de Receitas</h1>
    <form action="" method="POST">
        <label for="pac">Paciente:</label>
        <input type="text" id="pac" name="pac" required><br><br>

        <label for="rem">Medicamento:</label>
        <input type="text" id="rem" name="rem" required><br><br>
        
        <label for="data">Data e Hora da medicação:</label>
        <input type="date" id="data" name="data" required>
        
        <label for="hora"></label>
        <input type="time" id="hora" name="hora" required><br><br>
        
        <label for="dose">Dose:</label>
        <input type="text" id="dose" name="dose" required><br><br>

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
        $codigoSQL = "INSERT INTO `receitas` (`id`, `paciente`, `medicamento`, `data`, `hora`, `dose`) VALUES (NULL, :pac, :rem, :data, :hora, :dose)";

        try {
            $comando = $conexao->prepare($codigoSQL);

            // Capturar os dados do formulário
            $resultado = $comando->execute(array(
                'pac' => $_POST['pac'],
                'rem' => $_POST['rem'],
                'data' => $_POST['data'],
                'hora' => $_POST['hora'],
                'dose' => $_POST['dose']
            ));

            if ($resultado) {
                echo "<p>Receita cadastrada!</p>";
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


