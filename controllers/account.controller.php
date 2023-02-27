<?php
require("./inc/index.php");

if(isset($_POST['credit'])) {
  global $BASE_URL;
  global $TOKEN;

  $id = $_POST['user'];
  $amount = $_POST['amount'];
  $account = $_POST['account'];

  $body = [
    "userId" => $id,
    "amount" => $amount,
  ];

  $data = fetch("$BASE_URL/account/$account/credit", "POST", $body, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../users");
    exit();
  }

  setAlert("Account Credited!");
  header("Location: ../users");
}

if(isset($_POST['generate'])) {
  // print_r($_POST);
  global $BASE_URL;
  global $TOKEN;

  $joined = explode("-", sanitizeInput($_POST['account']));

  $account = $joined[0];
  $sender = $joined[1];
  $type = sanitizeInput($_POST['type']);
  $amount = sanitizeInput($_POST['amount']);
  $bank = sanitizeInput($_POST['bank']);
  $name = sanitizeInput($_POST['name']);
  $receiver = sanitizeInput($_POST['receiver']);
  $description = sanitizeInput($_POST['description']);
  $date = sanitizeInput($_POST['date']);
  $status = "approved";


  $body = [
    "sender" => $sender,
    "bank" => $bank,
    "beneficiaryName" => $name,
    "receiver" => $receiver,
    "amount" => $amount,
    "type" => $type,
    "date" => $date,
    "status" => $status,
  ];

  $previous = $_SERVER['HTTP_REFERER'];

  $data = fetch("$BASE_URL/account/$account/transact", "POST", $body, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: $previous");
    exit();
  }

  setAlert("Transaction generated!");
  header("Location: $previous");
}