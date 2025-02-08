<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if (!isset($_GET['number']) || !is_numeric($_GET['number'])) {
    echo json_encode(["number" => $_GET['number'] ?? null, "error" => true]);
    exit;
}

$number = intval($_GET['number']);

function isPrime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

function isPerfect($num) {
    $sum = 0;
    for ($i = 1; $i < $num; $i++) {
        if ($num % $i == 0) $sum += $i;
    }
    return $sum === $num;
}

function isArmstrong($num) {
    $sum = 0;
    $digits = str_split((string) $num);
    $power = count($digits);
    foreach ($digits as $digit) {
        $sum += pow((int)$digit, $power);
    }
    return $sum === $num;
}

function digitSum($num) {
    return array_sum(str_split((string) $num));
}

function fetchFunFact($num) {
    $url = "http://numbersapi.com/" . $num . "/math";
    return file_get_contents($url) ?: "No fact available";
}

$properties = [];
if ($number % 2 == 0) {
    $properties[] = "even";
} else {
    $properties[] = "odd";
}
if (isArmstrong($number)) {
    array_unshift($properties, "armstrong");
}

$response = [
    "number" => $number,
    "is_prime" => isPrime($number),
    "is_perfect" => isPerfect($number),
    "properties" => $properties,
    "digit_sum" => digitSum($number),
    "fun_fact" => fetchFunFact($number)
];

echo json_encode($response, JSON_PRETTY_PRINT);
