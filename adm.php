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

// Função para excluir um registro
if (isset($_GET['excluir'])) {
    $codcli = $_GET['excluir'];
    $sql = "DELETE FROM cliente WHERE codcli = $codcli";
    if ($conn->query($sql) === TRUE) {
        header("Location: adm.php"); // Redireciona para a lista após a exclusão
        exit();
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
    }
}

// Consulta para obter todos os dados da tabela cliente
$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <table border="1">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Número do Celular</th>
            <th>Quantidade</th>
            <th>Prato</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php
        // Exibir os dados da tabela com opções de edição e exclusão
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["codcli"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["celular"] . "</td>";
                echo "<td>" . $row["quantidade"] . "</td>";
                echo "<td>" . $row["prato"] . "</td>";
                echo "<td>" . $row["endereco"] . "</td>";
                echo "<td>";
                echo "<a href='editar_cliente.php?codcli=" . $row["codcli"] . "'>Editar</a> | ";
                echo "<a href='adm.php?excluir=" . $row["codcli"] . "'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "Nenhum registro encontrado na tabela cliente.";
        }
        ?>
    </table>
</body>
</html>
<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
