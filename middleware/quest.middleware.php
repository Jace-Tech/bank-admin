<?php  
  if(isset($_SESSION['AUTH_ADMIN'])) {
    header('Location: ./dashboard');
  }
?>