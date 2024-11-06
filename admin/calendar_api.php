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
    echo json_encode($events);

} elseif ($method == 'POST') {
    // Criar novo evento
    $title = $input['title'];
    $start = $input['start'];
    $end = isset($input['end']) ? $input['end'] : null; // Usando um valor padrão caso 'end' não seja enviado
    $allDay = isset($input['allDay']) ? $input['allDay'] : false;
    $backgroundColor = $input['backgroundColor'];
    $borderColor = $input['borderColor'];
    $url = isset($input['url']) ? $input['url'] : null;

    // Inserir o evento no banco de dados
    $stmt = $pdo->prepare("INSERT INTO events (title, start, end, allDay, backgroundColor, borderColor, url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url]);

    // Retornar o ID do evento recém-criado
    echo json_encode(['id' => $pdo->lastInsertId()]);

} elseif ($method == 'PUT') {
    // Atualizar evento existente
    $id = $input['id'];
    $title = $input['title'];
    $start = $input['start'];
    $end = isset($input['end']) && $input['end'] ? $input['end'] : $start;  // Se "end" não for fornecido, usa "start" como "end"
    $allDay = isset($input['allDay']) ? $input['allDay'] : false;
    $backgroundColor = $input['backgroundColor'];
    $borderColor = $input['borderColor'];
    $url = isset($input['url']) ? $input['url'] : null;

    // Log de depuração para verificar os dados recebidos
    file_put_contents('debug.log', "Recebido PUT: " . json_encode($input) . "\n", FILE_APPEND);

    // Certificar-se de que tanto start quanto end são válidos
    if (empty($start)) {
        echo json_encode(['error' => 'Data de início (start) não fornecida.']);
        exit;
    }

    if (empty($end)) {
        echo json_encode(['error' => 'Data de término (end) não fornecida.']);
        exit;
    }

    // Atualizar evento no banco de dados
    $stmt = $pdo->prepare("UPDATE events SET title=?, start=?, end=?, allDay=?, backgroundColor=?, borderColor=?, url=? WHERE id=?");
    $stmt->execute([$title, $start, $end, $allDay, $backgroundColor, $borderColor, $url, $id]);

    // Resposta de sucesso
    echo json_encode(['status' => 'success']);
    
} elseif ($method == 'DELETE') {
    // Deletar evento
    $id = $input['id'];

    $stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
    $stmt->execute([$id]);

    // Resposta de sucesso
    echo json_encode(['status' => 'deleted']);

} else {
    echo json_encode(['error' => 'Método HTTP não suportado']);
}
?>
