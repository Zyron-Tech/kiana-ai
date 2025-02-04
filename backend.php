<?php
// backend.php
// Credit: The API used in this project was developed by Abrham Bishop(C C Tech)

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// To ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Only POST requests are allowed.']);
    exit;
}

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); 
    echo json_encode(['error' => 'Invalid JSON input.']);
    exit;
}

$musicStyle = isset($data['musicStyle']) ? trim($data['musicStyle']) : '';
$country = isset($data['country']) ? trim($data['country']) : '';
$prompt = isset($data['prompt']) ? trim($data['prompt']) : '';

// Basic validation
if (empty($musicStyle) || empty($country) || empty($prompt)) {
    http_response_code(400); 
    echo json_encode(['error' => 'Missing required fields: musicStyle, country, prompt.']);
    exit;
}

// Sanitize input
$musicStyle = htmlspecialchars($musicStyle, ENT_QUOTES, 'UTF-8');
$country = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
$prompt = htmlspecialchars($prompt, ENT_QUOTES, 'UTF-8');

// Construct the AI prompt
$fullPrompt = "You are an AI songwriter specialized in generating song lyrics. "
            . "Write a song in the {$musicStyle} genre, inspired by {$country}. "
            . "The theme of the song is: {$prompt}. "
            . "Structure the song into sections: [Verse 1], [Chorus], [Verse 2], and [Bridge] if applicable. "
            . "At the end of each section, include the corresponding solfa notes (e.g., d, r, m, f, s, l, t, d) to guide musicians on how to sing it. "
            . "Ensure the lyrics are creative, engaging, and reflective of the specified theme. "
            . "Do not use any special formatting characters like asterisks (*), bold, or italics in the output.";

// API URL (Ensure this is set in your environment variables)
$aiApiUrl = getenv('API_URL');

// Initialize cURL
$ch = curl_init();

// cURL options
curl_setopt($ch, CURLOPT_URL, $aiApiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

// Payload for the AI API
$payload = json_encode([
    'prompt' => $fullPrompt,
    'temperature' => 2.0, 
    'n' => 1,
    'stop' => null 
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set headers
$headers = [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
];

// If you are using an API key, ensure it's set
// $apiKey = getenv('API_KEY'); // Uncomment if you need an API key
// if (!empty($apiKey)) {
//     $headers[] = 'Authorization: Bearer ' . $apiKey;
// }

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the API request
$response = curl_exec($ch);
$response = str_replace('*', '', $response);

// Handle cURL errors
if ($response === false) {
    http_response_code(500); 
    echo json_encode(['error' => 'cURL Error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

// Get HTTP response status code
$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close cURL
curl_close($ch);

// Process the AI API response
if ($httpStatus === 200) {
    $responseData = json_decode($response, true);
    
    if (isset($responseData['response'])) { 
        $song = $responseData['response'];
        echo json_encode(['song' => $song]);
    } elseif (isset($responseData['choices'][0]['text'])) { 
        $song = trim($responseData['choices'][0]['text']);
        echo json_encode(['song' => $song]);
    } else {
        echo json_encode(['error' => 'Unexpected API response structure.']);
    }
} else {
    $errorMsg = isset($responseData['error']) ? $responseData['error'] : 'Unknown error from AI API.';
    http_response_code($httpStatus);
    echo json_encode(['error' => $errorMsg]);
}
?>
