<?php 
require("./inc/index.php");


if(isset($_GET['block'])) {
  global $BASE_URL_TEST;
  global $TOKEN;

  $id = $_GET['block'];
  $data = fetch("$BASE_URL_TEST/user/$id/block", "GET", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../users");
    exit();
  }

  setAlert("User Blocked!");
  header("Location: ../users");
}

if(isset($_GET['unblock'])) {
  global $BASE_URL_TEST;
  global $TOKEN;
  $id = $_GET['unblock'];
  $data = fetch("$BASE_URL_TEST/user/$id/unblock", "GET", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../users");
    exit();
  }

  setAlert("User Unblocked!");
  header("Location: ../users");
}

if(isset($_GET['delete'])) {
  global $BASE_URL_TEST;
  global $TOKEN;
  $id = $_GET['delete'];
  $data = fetch("$BASE_URL_TEST/user/$id", "DELETE", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../users");
    exit();
  }

  setAlert("User Deleted!");
  header("Location: ../users");
}