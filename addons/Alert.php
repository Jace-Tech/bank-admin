<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php 
  if(isset($_SESSION['ADMIN_ALERT'])) {
    $ALERT = json_decode($_SESSION['ADMIN_ALERT'], true);
  ?>
  <script>
    swal(`<?= $ALERT['message'] ?>`, '', `<?= $ALERT['type'] ?>`)
  </script>
  <?php
    unset($_SESSION['ADMIN_ALERT']);
  }
?>