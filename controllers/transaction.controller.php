<?php 
require("./inc/index.php");


if(isset($_POST['delete'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['delete'];
  $previous = $_SERVER['HTTP_REFERER'];

  $data = fetch("$BASE_URL_TEST/transaction/$id", "DELETE", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: $previous");
    exit();
  }

  setAlert($data["message"]);
  header("Location: $previous");
}

if(isset($_POST['backdate'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['id'];
  $date = $_POST['date'];
  $previous = $_SERVER['HTTP_REFERER'];

  $payload = [
    "date" => $date
  ];

  $data = fetch("$BASE_URL_TEST/transaction/$id/backdate", "POST", $payload, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: $previous");
    exit();
  }

  setAlert($data["message"]);
  header("Location: $previous");
}

if(isset($_POST['approve'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['approve'];
  $previous = $_SERVER['HTTP_REFERER'];


  $data = fetch("$BASE_URL_TEST/transaction/$id/approve", "GET", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: $previous");
    exit();
  }

  setAlert($data["message"]);
  header("Location: $previous");
}

if(isset($_POST['cancel'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['cancel'];
  $previous = $_SERVER['HTTP_REFERER'];


  $data = fetch("$BASE_URL_TEST/transaction/$id/cancel", "GET", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: $previous");
    exit();
  }

  setAlert($data["message"]);
  header("Location: $previous");
}