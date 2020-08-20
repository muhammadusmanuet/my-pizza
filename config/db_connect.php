<?php

$conn = mysqli_connect('localhost', 'usman', '03088545306', 'my_pizza');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>