<?php 
session_start();
require(realpath("./../config/index.php"));


// REGISTER ADMIN
if(isset($_POST["register"])) {
  $email = sanitizeInput($_POST['email']);
  $name = sanitizeInput($_POST['name']);
  $password = sanitizeInput($_POST['password']);
  $role = "admin";

  $body = [
    "name" => $name,
    "email" => $email,
    "password" => $password,
    "role" => $role,
    "isActive" => true,
  ];

  // Make Request
  $data = fetch("https://bank-api-xwbj.onrender.com/api/auth/sign-up/", "POST", $body);
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../signup");
    exit();
  }

  setAlert("Account Created!");
  header("Location: ../");
} 

// LOGIN ADMIN
if(isset($_POST["login"])) {
  $email = sanitizeInput($_POST['email']);
  $password = sanitizeInput($_POST['password']);

  $body = [
    "email" => $email,
    "password" => $password,
  ];

  // Make Request
  $data = fetch("/auth/sign-in/", "POST", $body);
  if(!$data) {
    setAlert("Something went wrong. Please try again", "error");
    header("Location: ../");
    exit();
  }
  
  if(!$data["success"]) {
    setAlert($data["message"], "error");
    header("Location: ../");
    exit();
  }

  // Create Sesstion
  $_SESSION['AUTH_ADMIN'] = json_encode($data['data']);
  setAlert("Logged in!");
  header("Location: ../dashboard");
} 

// LOGOUT ADMIN
if(isset($_POST["logout"])) {
  session_destroy();
  setAlert("Logged out!");
  header("Location: ../");
} 
