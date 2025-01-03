<?php
session_start();
require "./db/config.php";

if (isset($_POST['do_signup'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'client';

    $_SESSION['old'] = [
        'username' => $username,
        'email' => $email,
        'user_type' => $user_type,
    ];

    $errors = [];

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address!";
    }

    // Проверка совпадения паролей
    if ($password !== $cpassword) {
        $errors['password_confirmation'] = "Passwords do not match!";
    }

    // Проверка длины пароля
    if (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    }

    // Проверка на существующего пользователя
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['username'] === $username) {
            $errors['username'] = "Username already exists!";
        }
        if ($row['email'] === $email) {
            $errors['email'] = "Email already exists!";
        }
    }

    // Если есть ошибки, сохраняем их в сессию
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }

    // Сохранение пользователя
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_type);

    if ($stmt->execute()) {
      // Очистка старых данных и ошибок после успешной регистрации
      unset($_SESSION['old']);
      unset($_SESSION['errors']);
        // Устанавливаем сообщение через localStorage и перенаправляем
    echo "<script>
    localStorage.setItem('success', 'Registration successful! Please log in.');
    window.location.href = 'log.php'; // Перенаправляем на логин
     </script>";
      exit();
    } 

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snout Studio</title>
    <link rel="stylesheet" href="./static/css/styles.css">
    <link rel="stylesheet" href="./static/css/media.css" >
    <link rel="stylesheet" href="./static/css/footer.css" >

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<?php require "inc/_header.php" ?>

<section class="login-section">
    <h4 class="log-reg">Register</h4>
    <div class="login-content">
    <?php if (isset($_SESSION['errors'])): ?>
        <div class="error-messages">
            <?php foreach ($_SESSION['errors'] as $field => $message): ?>
                <?php if (!in_array($field, ['username', 'email', 'password', 'password_confirmation'])): ?>
                    <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form id="form-register" action="register.php" method="post" class="form-login">
        <div class="name">
            <label for="username">Your name: <span class="required">*</span></label>
            <input type="text" name="username" id="username" required
                value="<?php echo isset($_SESSION['old']['username']) ? htmlspecialchars($_SESSION['old']['username']) : ''; ?>" />
            <span class="error-message"><?php echo isset($_SESSION['errors']['username']) ? htmlspecialchars($_SESSION['errors']['username']) : ''; ?></span>
        </div>

        <div class="name">
            <label for="email">E-mail: <span class="required">*</span></label>
            <input type="email" name="email" id="email" required
                value="<?php echo isset($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email']) : ''; ?>" />
            <span class="error-message"><?php echo isset($_SESSION['errors']['email']) ? htmlspecialchars($_SESSION['errors']['email']) : ''; ?></span>
        </div>

        <div class="password">
            <label for="password">Password: <span class="required">*</span></label>
            <input type="password" name="password" id="password" required autocomplete="new-password" />
            <span class="error-message"><?php echo isset($_SESSION['errors']['password']) ? htmlspecialchars($_SESSION['errors']['password']) : ''; ?></span>
        </div>

        <div class="password">
            <label for="cpassword">Password confirmation: <span class="required">*</span></label>
            <input type="password" name="cpassword" id="cpassword" required autocomplete="new-password" />
            <span class="error-message"><?php echo isset($_SESSION['errors']['password_confirmation']) ? htmlspecialchars($_SESSION['errors']['password_confirmation']) : ''; ?></span>
        </div>

        <div class="name">
            <label for="user_type">User Type:</label>
            <select name="user_type" id="user_type">
                <option value="client" <?php echo isset($_SESSION['old']['user_type']) && $_SESSION['old']['user_type'] === 'client' ? 'selected' : ''; ?>>Client</option>
                <option value="admin" <?php echo isset($_SESSION['old']['user_type']) && $_SESSION['old']['user_type'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <div class="login">
            <button type="submit" name="do_signup" class="signup-btn">Register</button>
        </div>
    </form>
</div>

</section>

<?php require "inc/_footer.php" ?>

<script src="register.js"></script>

</body>
</html>