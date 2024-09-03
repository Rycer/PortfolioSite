<?php
$conn = new mysqli("localhost", "root", "", "portfolio");
if ($conn->connect_error) {
exit("Connection failed: " . $conn->connect_error);
}
?>