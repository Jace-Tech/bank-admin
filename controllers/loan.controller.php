<!--  -->
<?php 
require("./inc/index.php");


if(isset($_GET['cancel'])) {
  global $BASE_URL;
  global $TOKEN;

  $id = $_GET['cancel'];
  $data = fetch("$BASE_URL/loan/$id/cancel", "GET", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location:" . $_SERVER["HTTP_REFERER"]);
    exit();
  }

  setAlert($data["message"]);
  header("Location:" . $_SERVER["HTTP_REFERER"]);
}

if(isset($_POST['approve'])) {
  global $BASE_URL;
  global $TOKEN;

  $id = $_POST['id'];
  $date = $_POST['date'];
  $interest = $_POST['interest'];

  $payload = [
    "id" => $id,
    "date" => $date,
    "interest" => $interest,
  ];

  $data = fetch("$BASE_URL/loan/$id/approve", "POST", $payload, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location:" . $_SERVER["HTTP_REFERER"]);
    exit();
  }

  setAlert($data["message"]);
  header("Location:" . $_SERVER["HTTP_REFERER"]);
}

if(isset($_GET['delete'])) {
  global $BASE_URL;
  global $TOKEN;

  $id = $_GET['delete'];
  $data = fetch("$BASE_URL/loan/$id", "DELETE", null, ["Authorization: Bearer $TOKEN"]);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location:" . $_SERVER["HTTP_REFERER"]);
    exit();
  }

  setAlert($data["message"]);
  header("Location:" . $_SERVER["HTTP_REFERER"]);
}