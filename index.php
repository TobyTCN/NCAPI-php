<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  // Handles CORS

function is_prime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i === 0) return false;
    }
    return true;
}

function is_perfect($num) {
    if ($num <= 0) return false;
    $sum = 0;
    for ($i = 1; $i < $num; $i++) {
        if ($num % $i === 0) $sum += $i;
    }
    return $sum === $num;
}

function is_armstrong($num) {
    $absNum = abs($num); // Handle negative numbers
    $digits = str_split((string) $absNum);
    $sum = array_sum(array_map(fn($d) => pow($d, count($digits)), $digits));
    return $sum == $absNum;
}

function fetch_fun_fact($num) {
    $url = "http://numbersapi.com/$num/math?json";
    $response = @file_get_contents($url);
    if ($response === false) {
        return "No fun fact available.";
    }
    $data = json_decode($response, true);
    return isset($data['text']) ? $data['text'] : "No fun fact available.";
}

if (!isset($_GET['number']) || !is_numeric($_GET['number'])) {
    http_response_code(400);
    echo json_encode([
        "number" => $_GET['number'] ?? null,
        "error" => true
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

$number = $_GET['number'] + 0; // Convert to appropriate numeric type
$properties = [];

if (is_armstrong($number)) {
    $properties[] = "armstrong";
}

$properties[] = ($number % 2 === 0) ? "even" : "odd";

$response = [
    "number" => $number,
    "is_prime" => is_prime($number),
    "is_perfect" => is_perfect($number),
    "properties" => $properties,
    "digit_sum" => array_sum(str_split((string) abs($number))),
    "fun_fact" => fetch_fun_fact($number)
];

http_response_code(200);
echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>
