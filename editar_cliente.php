<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$username = "root";
$password = "etec8";
$database = "banco1";

// Conecta ao banco de dados
$conn = new mysqli($host, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET['codcli'])) {
    $codcli = $_GET['codcli'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $numero_celular = $_POST["celular"];
        $quantidade = $_POST["quantidade"];
        $prato = $_POST["prato"];
        $endereco = $_POST["endereco"];
        
        $sql = "UPDATE cliente SET nome = '$nome', email = '$email', celular = '$numero_celular', quantidade = '$quantidade', prato = '$prato', endereco = '$endereco' WHERE codcli = $codcli";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: /food/adm.php"); // Redireciona para a lista após a edição
            exit();
        } else {
            echo "Erro ao atualizar o registro: " . $conn->error;
        }
    }

    // Consulta para obter os dados do cliente a ser editado
    $sql = "SELECT * FROM cliente WHERE codcli = $codcli";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Registro não encontrado na tabela cliente.";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    <form method="post" action="">
        <input type="hidden" name="codcli" value="<?php echo $codcli; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        Número do Celular: <input type="text" name="celular" value="<?php echo $row['celular']; ?>"><br>
        Quantidade: <input type="text" name="quantidade" value="<?php echo $row['quantidade']; ?>"><br>
        Prato: <input type="text" name="prato" value="<?php echo $row['prato']; ?>"><br>
        Endereço: <input type="text" name="endereco" value="<?php echo $row['endereco']; ?>"><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
