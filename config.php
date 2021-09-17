
<?php

$conn = new mysqli('localhost', 'root', 'root', 'task2');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>