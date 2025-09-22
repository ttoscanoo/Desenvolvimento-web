<?php
// 1. DADOS DE CONEXÃO
$host = 'localhost';
$dbname = 'cadastro_clientes'; // O nome do banco que criamos
$user = 'postgres'; // Usuário padrão do PostgreSQL
$password = 'diana05'; // <-- COLOQUE SUA SENHA AQUI

// 2. RECEBER OS DADOS DO FORMULÁRIO (método POST)
$nome = $_POST['nome_cliente'];
$cpf = $_POST['cpf_cliente'];
$email = $_POST['email_cliente'];
$data_nascimento = $_POST['data_nascimento_cliente'];

// 3. VALIDAR DADOS (exemplo de validação simples)
if (empty($nome) || empty($cpf) || empty($email) || empty($data_nascimento)) {
    die("Erro: Todos os campos são obrigatórios.");
}

// 4. CONECTAR AO BANCO DE DADOS USANDO PDO
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 5. PREPARAR E EXECUTAR A INSTRUÇÃO SQL (com prepared statements)
    // O material menciona o uso de Prepare e Execute [cite: 111]
    $sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, data_nascimento_cliente) VALUES (:nome, :cpf, :email, :data_nascimento)";
    
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':email' => $email,
        ':data_nascimento' => $data_nascimento
    ]);

    echo "<h1>Cliente cadastrado com sucesso!</h1>";
    echo "<a href='cadastro.html'>Voltar para o cadastro</a><br>";
    echo "<a href='listar_clientes.php'>Ver clientes cadastrados</a>";

} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem [cite: 112]
    die("Erro ao cadastrar cliente: " . $e->getMessage());
} finally {
    // 6. FECHAR A CONEXÃO [cite: 113]
    $pdo = null;
    $stmt = null;
}
?>