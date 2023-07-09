<?php

$db = mysqli_connect(
  $_ENV['DB_HOST'],
  $_ENV['DB_USER'],
  $_ENV['DB_PASS'],
  $_ENV['DB_NAME']
);

$db->set_charset('utf8');


if (!$db) {
    echo "Error: Unable to connect to MySQL.";
    echo "depuration errno: " . mysqli_connect_errno();
    echo "depuration error: " . mysqli_connect_error();
    exit;
}
