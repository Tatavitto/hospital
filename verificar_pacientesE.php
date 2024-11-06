<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Verificar Paciente</title>
</head>
<body>
    <h1>Verificar Paciente</h1>

    <!-- Formulário para pesquisa de paciente -->
    <form action="" method="POST">
        <label for="pac">Nome do Paciente:</label>
        <input type="text" id="pac" name="pac" required><br><br>
        <input type="submit" value="Verificar">
    </form>

    <?php
    $servidor = 'localhost';
    $banco = 'hospital';
    $usuario = 'root';
    $senha = '';

    try {
        // Conectar ao banco de dados
        $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pac'])) {
            $nomePaciente = $_POST['pac'];

            // Consultar se o paciente já está registrado
            $query = "SELECT * FROM pacientes WHERE nome = :nome";
            $stmt = $conexao->prepare($query);
            $stmt->execute(['nome' => $nomePaciente]);

            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($paciente) {
                // Paciente encontrado
                echo "<p>Paciente encontrado: " . $paciente['nome'] . "</p>";
                echo "<p><a href='mostra_receitas.php?paciente_id=" . $paciente['id'] . "'>Clique aqui para vizualizar a receita médica de todos os pacientes</a></p>";
            } else {
                // Paciente não encontrado
                echo "<p>Paciente não encontrado. Você pode cadastrá-lo.</p>";
                echo "<p><a href='pacientes.php?nome=" . urlencode($nomePaciente) . "'>Clique aqui para cadastrar este paciente</a></p>";
            }
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    // Fechar a conexão
    $conexao = null;
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
