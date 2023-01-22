<?php

function sanitizeInput(string $input): string
{
  return htmlspecialchars(trim($input));
}

function fetch(string $url, $method = 'GET', array $payloads = null, array $_headers = null)
{
  try {
    $curl = curl_init();
    $fields_string = $payloads ? http_build_query($payloads) : null;
    $headers = ["Content-Type" => "application/json"];
    $headers = $_headers ?? array_merge($headers, $_headers);

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_POSTFIELDS => $fields_string,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_HTTPHEADER => $headers,
    ));

    $response = json_decode(curl_exec($curl), true);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) throw new Exception($err);
    return $response;
  } catch (Exception $e) {
    return [
      "success" => false,
      "message" => chechMessage($e->getMessage()),
      "data" => null
    ];
  }
}

function chechMessage(string $msg) {
  if(str_contains(strtolower($msg), "couldn't resolve host")) return "<b>Network error</b>: Please check your internet connection.";
  return $msg;
}

function setAlert(string $message, string $type = "success") {
  @session_start();
  $_SESSION["ADMIN_ALERT"] = json_encode([
    "message" => $message,
    "type" => $type
  ]);
}

function getGreeting() {
  $hour = date("H");

  if($hour >= 0 && $hour < 12) return "Morning";
  else if($hour >= 12 && $hour < 16) return "Afternoon";
  else return "Evening";
}