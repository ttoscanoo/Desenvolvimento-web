<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exemplo Dinâmico PHP</title>
</head>
<body>
    <h1>Bem-vindo ao PHP Dinâmico!</h1>
    <p>Hoje é: <?php echo date("d/m/Y"); ?></p>
    <p>Agora são: <?php echo date("H:i:s"); ?></p>

    <?php
    // Exemplo de lógica PHP
    $hora = date("H");
    if ($hora < 12) {
        echo "<p>Bom dia!</p>";
    } elseif ($hora < 18) {
        echo "<p>Boa tarde!</p>";
    } else {
        echo "<p>Boa noite!</p>";
    }
    ?>
</body>
</html>
