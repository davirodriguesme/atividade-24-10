<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Funcionários</title>
    <link rel="stylesheet" href="Untitled-1.css">
</head>
<body>

<?php
// Incluir o arquivo de conexão
include('conexao.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $salario = $_POST['salario'];

    // Verificar se o botão de inserção foi clicado
    if (isset($_POST['inserir'])) {
        // Verificar se os campos obrigatórios estão preenchidos
        if (!empty($nome) && !empty($telefone) && !empty($salario)) {
            // Inserir dados na tabela funcionarios
            $sql = "INSERT INTO funcionarios (fun_telefone, fun_nome, fun_salario) VALUES (?, ?, ?)";

            // Preparar a consulta SQL para evitar SQL Injection
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sss", $telefone, $nome, $salario);

                // Executar a query
                if ($stmt->execute()) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro ao inserir os dados: " . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            echo "Por favor, preencha todos os campos!";
        }
    }

    // Verificar se o botão de atualização foi clicado
    if (isset($_POST['alterar'])) {
        if (!empty($codigo) && !empty($nome) && !empty($telefone) && !empty($salario)) {
            // Atualizar dados na tabela funcionarios
            $sql = "UPDATE funcionarios SET fun_telefone = ?, fun_nome = ?, fun_salario = ? WHERE fun_numero = ?";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sssi", $telefone, $nome, $salario, $codigo);

                if ($stmt->execute()) {
                    echo "Dados atualizados com sucesso!";
                } else {
                    echo "Erro ao atualizar os dados: " . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            echo "Por favor, preencha todos os campos!";
        }
    }

    // Verificar se o botão de exclusão foi clicado
    if (isset($_POST['excluir'])) {
        if (!empty($codigo)) {
            // Excluir dados da tabela funcionarios
            $sql = "DELETE FROM funcionarios WHERE fun_numero = ?";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("i", $codigo);

                if ($stmt->execute()) {
                    echo "Funcionário excluído com sucesso!";
                } else {
                    echo "Erro ao excluir o funcionário: " . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            echo "Por favor, preencha o código do funcionário que deseja excluir!";
        }
    }
}

// Consulta SQL para buscar todos os funcionários
$sql = "SELECT * FROM funcionarios";
$result = $mysqli->query($sql);

// Fechar a conexão com o banco de dados
$mysqli->close();
?>

<h3 class="ins">Gerenciamento de Funcionários</h3>
<form action="" method="POST" class="form">
    <p>Código: <input type="text" name="codigo" id="codigo" class="insert"></p>
    <p>Nome: <input type="text" name="nome" id="nome" class="insert"></p>
    <p>Salário: <input type="text" name="salario" id="salario" class="insert"></p>
    <p>Telefone: <input type="text" name="telefone" id="telefone" class="insert"></p>

    <!-- Botões de Ação -->
    <p>
        <input type="submit" name="inserir" value="Inserir">
        <input type="submit" name="alterar" value="Alterar">
        <input type="submit" name="excluir" value="Excluir">
    </p>
</form>

<!-- Exibir a lista de funcionários em uma tabela -->
<h3>Lista de Funcionários</h3>
<table border="1" class="box">
    <thead>
        <tr class="desc">
            <th>Código</th>
            <th>Nome</th>
            <th>Salário</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['fun_numero'] ?></td>
                    <td><?= $row['fun_nome'] ?></td>
                    <td><?= $row['fun_salario'] ?></td>
                    <td><?= $row['fun_telefone'] ?></td>
                    <td>
                        <a href="?edit=<?= $row['fun_numero'] ?>">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhum funcionário encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>


