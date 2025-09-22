<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Clientes Cadastrados</h2>
        <a href="cadastro.html" class="btn btn-primary mb-3">Cadastrar Novo Cliente</a>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 1. DADOS DE CONEXÃO
                $host = 'localhost';
                $dbname = 'cadastro_clientes';
                $user = 'postgres';
                $password = 'diana05'; // <-- COLOQUE SUA SENHA AQUI

                try {
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // 2. PREPARAR E EXECUTAR A CONSULTA
                    $sql = "SELECT id_cliente, nome_cliente, cpf_cliente, email_cliente, data_nascimento_cliente FROM cliente ORDER BY nome_cliente";
                    $resultSet = $pdo->query($sql); // Conforme exemplo do material [cite: 153]

                    // 3. EXIBIR OS DADOS
                    // O material usa fetch(PDO::FETCH_ASSOC) para ler os dados [cite: 157, 164, 174]
                    while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id_cliente']) . "</td>"; // [cite: 158]
                        echo "<td>" . htmlspecialchars($row['nome_cliente']) . "</td>"; // [cite: 159]
                        
                        // Formatando o CPF, como sugerido no material [cite: 160, 161]
                        $cpf_formatado = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $row['cpf_cliente']);
                        echo "<td>" . htmlspecialchars($cpf_formatado) . "</td>";

                        echo "<td>" . htmlspecialchars($row['email_cliente']) . "</td>"; // [cite: 162]
                        
                        // Formatando a data, como sugerido no material [cite: 163]
                        $data_formatada = date('d/m/Y', strtotime($row['data_nascimento_cliente']));
                        echo "<td>" . htmlspecialchars($data_formatada) . "</td>";
                        
                        echo "</tr>";
                    }

                } catch (PDOException $e) {
                    echo "<tr><td colspan='5' class='text-center'>Erro ao conectar ou consultar o banco de dados: " . $e->getMessage() . "</td></tr>";
                } finally {
                    $pdo = null;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>