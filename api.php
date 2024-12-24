<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Function to fetch data from the API
function fetchApiData($phoneNumber) {
    // API URL with the phone number
    $apiUrl = "https://turecaller.pikaapis0.workers.dev/?number=" . urlencode($phoneNumber);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return json_encode(["error" => $error]);
    }

    // Close cURL
    curl_close($ch);

    // Return the API response
    return $response;
}

// Check if the phone number is provided in the request
if (isset($_GET['number'])) {
    $phoneNumber = $_GET['number'];
    $apiResponse = fetchApiData($phoneNumber);

    // Return the API response
    echo $apiResponse;
} else {
    // If no number is provided, return an error message
    echo json_encode(["error" => "Phone number is required."]);
}
?>
