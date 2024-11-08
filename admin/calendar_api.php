<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'codemaze_dbprod';
$username = 'codemaze_dbprod';
$password = 'dbprodcodemaze';

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

    // Converter as datas para o formato ISO8601 (que o FullCalendar entende)
    foreach ($events as &$event) {
        if ($event['end']) {
            $event['end'] = date('c', strtotime($event['end'])); // Formato ISO8601
        }
        $event['start'] = date('c', strtotime($event['start'])); // Formato ISO8601
    }

    echo json_encode($events);

} elseif ($method == 'POST') {
    // Criar ou atualizar evento
    $id = isset($input['id']) ? $input['id'] : null;
    $title = $input['title'];
    $start = $input['start'];
    $end = isset($input['end']) ? $input['end'] : null;
    $allDay = isset($input['allDay']) ? $input['allDay'] : false;
    $backgroundColor = $input['backgroundColor'];
    $borderColor = $input['borderColor'];
    $url = isset($input['url']) ? $input['url'] : null;

    // Se for um evento existente, atualiza
    if ($id) {
        $stmt = $pdo->prepare("UPDATE events SET title=?, start=?, end=?, allDay=?, backgroundColor=?, borderColor=?, url=? WHERE id=?");
        $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url, $id]);
        echo json_encode(['status' => 'success']);
    } else {
        // Caso contrário, cria um novo evento
        $stmt = $pdo->prepare("INSERT INTO events (title, start, end, allDay, backgroundColor, borderColor, url) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
    }

} elseif ($method == 'PUT') {
    // Atualizar evento existente
    $id = $input['id'];
    $title = $input['title'];
    $start = $input['start'];
    $end = $input['end'];
    $stmt = $pdo->prepare("UPDATE events SET title=?, start=?, end=? WHERE id=?");
    $stmt->execute([$title, $start, $end, $id]);
    echo json_encode(['status' => 'updated']);

} elseif ($method == 'DELETE') {
    // Deletar evento
    if (isset($input['id'])) {
        $id = $input['id'];
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Evento excluído com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Evento não encontrado']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID do evento não fornecido']);
    }
}
?>
