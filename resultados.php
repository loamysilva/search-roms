<?php
$conn = new mysqli("localhost", "root", "", "search-roms");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$termo = isset($_GET['q']) ? $_GET['q'] : '';

if (trim($termo) === '') {
    echo "<p>Por favor, insira um termo de busca.</p>";
    exit;
}

$sql = "SELECT * FROM roms WHERE 
        nome LIKE ? OR 
        categoria LIKE ? OR 
        tags LIKE ?";
$stmt = $conn->prepare($sql);
$termo = "%" . $termo . "%";
$stmt->bind_param("sss", $termo, $termo, $termo);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Resultados para: " . htmlspecialchars($_GET['q']) . "</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='resultado'>";
        echo "<h2>" . htmlspecialchars($row['nome']) . "</h2>";
        echo "<p>" . htmlspecialchars($row['descricao']) . "</p>";
        echo "<a href='" . htmlspecialchars($row['link_download']) . "' class='botao-baixar'>Baixar</a>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhuma ROM encontrada para: " . htmlspecialchars($_GET['q']) . "</p>";
}

$stmt->close();
$conn->close();
?>
