<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'calendar_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => "Erro na conexão: " . $e->getMessage()]));
}

// Funções CRUD
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method == 'GET') {
    // Listar todos os eventos
    $stmt = $pdo->prepare("SELECT * FROM events");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($events);

} elseif ($method == 'POST') {
    // Criar novo evento
    $title = $input['title'];
    $start = $input['start'];
    $end = $input['end'];
    $allDay = isset($input['allDay']) ? $input['allDay'] : false;
    $backgroundColor = $input['backgroundColor'];
    $borderColor = $input['borderColor'];
    $url = isset($input['url']) ? $input['url'] : null;

    $stmt = $pdo->prepare("INSERT INTO events (title, start, end, allDay, backgroundColor, borderColor, url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url]);

    echo json_encode(['id' => $pdo->lastInsertId()]);

} elseif ($method == 'PUT') {
    // Atualizar evento
    $id = $input['id'];
    $title = $input['title'];
    $start = $input['start'];
    $end = $input['end'];
    $allDay = isset($input['allDay']) ? $input['allDay'] : false;
    $backgroundColor = $input['backgroundColor'];
    $borderColor = $input['borderColor'];
    $url = isset($input['url']) ? $input['url'] : null;

    $stmt = $pdo->prepare("UPDATE events SET title=?, start=?, end=?, allDay=?, backgroundColor=?, borderColor=?, url=? WHERE id=?");
    $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url, $id]);

    echo json_encode(['status' => 'success']);

} elseif ($method == 'DELETE') {
    // Deletar evento
    $id = $input['id'];

    $stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
    $stmt->execute([$id]);

    echo json_encode(['status' => 'deleted']);
} else {
    echo json_encode(['error' => 'Método HTTP não suportado']);
}
?>
