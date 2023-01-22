<?php  
require_once("./utils/helpers.php");


function getAllUsers($token) {
  $headers = [ "authorization" => "Bearer $token" ];
  $result = fetch("https://bank-api-xwbj.onrender.com/api/user/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllTransactions($token) {
  $headers = [ "authorization" => "Bearer $token" ];
  $result = fetch("https://bank-api-xwbj.onrender.com/api/transaction/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllPendingTransactions($token) {
  $transactions = getAllTransactions($token);
  if(!count($transactions)) return [];

  $result = array_values(array_filter($transactions, function ($item) {
    return $item['status'] === 'pending';
  }));

  return $result;
}

function getAllApprovedTransactions($token) {
  $transactions = getAllTransactions($token);
  if(!count($transactions)) return [];

  $result = array_values(array_filter($transactions, function ($item) {
    return $item['status'] === 'approved';
  }));

  return $result;
}
