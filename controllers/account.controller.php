<?php
require("./inc/index.php");

if(isset($_POST['credit'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['user'];
  $amount = $_POST['amount'];
  $account = $_POST['account'];

  $body = [
    "userId" => $id,
    "amount" => $amount,
  ];

  $data = fetch("$BASE_URL_TEST/account/$account/credit", "POST", $body, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../users");
    exit();
  }

  setAlert("Account Credited!");
  header("Location: ../users");
}