<!--  -->

<?php 
require("./inc/index.php");


if(isset($_POST['create'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['user'];
  $accountNumber = $_POST['accountNumber'];
  $bank = $_POST['bank'];

  $payload = [
    "bank" => $bank,
    "accountNumber" => $accountNumber,
  ];
  $data = fetch("$BASE_URL_TEST/allowed/user/$id/create", "POST", $payload, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../allowed-list?user=$id");
    exit();
  }

  setAlert($data["message"]);
  header("Location: ../allowed-list?user=$id");
}


if(isset($_POST['delete'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_POST['delete'];
  $user = $_POST['user'];

  $data = fetch("$BASE_URL_TEST/allowed/$id/delete", "DELETE", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../allowed-list?user=$user");
    exit();
  }

  setAlert($data["message"]);
  header("Location: ../allowed-list?user=$user");
}