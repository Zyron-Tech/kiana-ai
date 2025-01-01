<?php
// backend.php

// Enable CORS if necessary (adjust the allowed origin as needed)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed.']);
    exit;
}

// Get the raw POST data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate JSON decoding
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid JSON input.']);
    exit;
}

// Extract and sanitize user inputs
$musicStyle = isset($data['musicStyle']) ? trim($data['musicStyle']) : '';
$country = isset($data['country']) ? trim($data['country']) : '';
$prompt = isset($data['prompt']) ? trim($data['prompt']) : '';

// Basic validation
if (empty($musicStyle) || empty($country) || empty($prompt)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing required fields: musicStyle, country, prompt.']);
    exit;
}

// Sanitize inputs to prevent injection (basic sanitization)
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

// AI API Configuration
$aiApiUrl = "https://chatbot-y2iq.onrender.com/chatbot"; // Replace with your AI API endpoint

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $aiApiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60); // Set timeout as needed

$payload = json_encode([
    'prompt' => $fullPrompt,
    'temperature' => 2.0, // Adjust for creativity
    'n' => 1, // Number of responses
    'stop' => null // Define stop sequences if necessary
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set headers
$headers = [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
];

// If the API requires an API key, include it in the headers
if (!empty($apiKey)) {
    $headers[] = 'Authorization: Bearer ' . $apiKey;
}

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the API request
$response = curl_exec($ch);
$response = str_replace('*', '', $response);

// Handle cURL errors
if ($response === false) {
    http_response_code(500); // Internal Server Error
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
    
    // Adjust based on your AI API's response structure
    if (isset($responseData['response'])) { // Example for the given API
        $song = $responseData['response'];
        echo json_encode(['song' => $song]);
    } elseif (isset($responseData['choices'][0]['text'])) { // Example for OpenAI
        $song = trim($responseData['choices'][0]['text']);
        echo json_encode(['song' => $song]);
    } else {
        // Handle unexpected response structure
        echo json_encode(['error' => 'Unexpected API response structure.']);
    }
} else {
    // Handle non-200 responses
    $errorMsg = isset($responseData['error']) ? $responseData['error'] : 'Unknown error from AI API.';
    http_response_code($httpStatus);
    echo json_encode(['error' => $errorMsg]);
}
?>
