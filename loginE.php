<?php
session_start(); // Inicia a sessão

$servidor = 'localhost';
$banco = 'hospital';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Consulta para verificar o médico
    $codigoSQL = "SELECT * FROM `enfermeiros` WHERE `usuario` = :user";
    $comando = $conexao->prepare($codigoSQL);
    $comando->execute(array('user' => $usuario));
    $enfermeiro = $comando->fetch(PDO::FETCH_ASSOC);

    // Verifica se o médico foi encontrado e se a senha está correta
    if ($enfermeiro && $senha === $enfermeiro['senha']) {
        // Armazena a informação na sessão
        $_SESSION['enfermeiro'] = $enfermeiro['nome']; // ou qualquer outra informação que você queira
        header("Location: dashboardE.php"); // Redireciona para a página de dashboard
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}

$conexao = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Login de Enfermeiros</title>
</head>
<body>
    <h1>Login de Enfermeiros</h1>
    <form action="" method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
        <p><a href='enfermeiros.php'>Não tem login? Cadastre-se!</a></p>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
