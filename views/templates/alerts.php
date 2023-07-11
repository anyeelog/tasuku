<ul class="alerts">
  <?php
    foreach($alerts as $key => $alert) {
      foreach($alert as $message) {
  ?>
    <li class="alert <?php echo $key ?>"><?php echo $message; ?></li>
  <?php
      }
    }
  ?>
</ul>
