<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Listagem de Receitas</title>
</head>
<body>
    <h1>Receitas Cadastradas</h1>
    
    <?php
    // Definir as variáveis de conexão
    $servidor = 'localhost';
    $banco = 'hospital';
    $usuario = 'root';
    $senha = '';

    try {
        // Tentar a conexão com o banco de dados
        $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar exceções para erros
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }

    // Consulta para obter todas as receitas
    $consultaSQL = "SELECT * FROM `receitas`";
    $comando = $conexao->prepare($consultaSQL);
    $comando->execute();

    // Exibir as receitas
    if ($comando->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Paciente</th><th>Medicamento</th><th>Data</th><th>Hora</th><th>Dose</th><th>Ações</th></tr>";
        while ($receita = $comando->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($receita['paciente']) . "</td>";
            echo "<td>" . htmlspecialchars($receita['medicamento']) . "</td>";
            echo "<td>" . $receita['data'] . "</td>";
            echo "<td>" . $receita['hora'] . "</td>";
            echo "<td>" . htmlspecialchars($receita['dose']) . "</td>";
            echo "<td><a href='admin.php?id=" . $receita['id'] . "'>Registrar o medicamento</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não há receitas cadastradas.</p>";
    }

    // Fechar a conexão
    $conexao = null;
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
