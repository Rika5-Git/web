<?php
session_destroy(); // Знищення всіх даних сесії
header('Location: login.php'); // Перенаправлення на сторінку входу
exit();
?>
