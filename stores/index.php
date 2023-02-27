<?php  

function getAllUsers($token) {
  global $BASE_URL;
  $headers = ["Authorization: Bearer $token"];
  $result = fetch("$BASE_URL/user/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}


function getAllAccounts($token) {
  global $BASE_URL;
  $headers = ["Authorization: Bearer $token"];
  $result = fetch("$BASE_URL/account/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllTransactions($token) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/transaction/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllLoans($token) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/loan/", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getUserAccount($token, $id) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/user/$id/account", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getUsersLoan($token, $id) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/loan/user/$id", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllPendingLoan($token) {
  $LOANS = getAllLoans($token);
  return array_values(array_filter($LOANS, function($loan) {
    return $loan['status'] == 'pending';
  }));
}

function getAllActiveLoan($token) {
  $LOANS = getAllLoans($token);
  return array_values(array_filter($LOANS, function($loan) {
    return $loan['status'] == 'active' || $loan['status'] == 'completed';
  }));
}

function getUsersTransactions($token, $id) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/transaction/user/$id", "GET", null, $headers);
  if(!$result["success"]) {
    setAlert($result['message'], "error");
    return [];
  }
  return $result['data'];
}

function getAllUserAllowedList($token, $userId) {
  global $BASE_URL;
  $headers = [ "Authorization: Bearer $token" ];
  $result = fetch("$BASE_URL/allowed/user/$userId", "GET", null, $headers);
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
