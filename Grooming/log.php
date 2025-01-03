<?php
session_start();
require "./db/config.php"; // Подключение к базе данных

// Очистка старых данных сессии, если это просто загрузка страницы
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    unset($_SESSION['login_old']);
    unset($_SESSION['login_errors']);
}

// Обработка логина
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['do_login'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Сохраняем email для повторного заполнения формы
    $_SESSION['login_old'] = ['email' => $email];

    $login_errors = [];

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $login_errors['email'] = "Invalid email address.";
    }

    // Проверка пароля
    if (empty($password)) {
        $login_errors['password'] = "Password cannot be empty.";
    }

    // Проверка в базе данных
    if (empty($login_errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            die("SQL error: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $login_errors['email'] = "No user found with this email.";
        } else {
            $user = $result->fetch_assoc();

            // Проверка пароля
            if (!password_verify($password, $user['password'])) {
                $login_errors['password'] = "Incorrect password.";
            } else {
                // Успешный вход
                $_SESSION['user'] = $user;
                unset($_SESSION['login_old'], $_SESSION['login_errors']);
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    // Сохранение ошибок в сессию
    if (!empty($login_errors)) {
        $_SESSION['login_errors'] = $login_errors;
        header("Location: log.php");
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
<body>
<?php require "inc/_header.php" ?>

<section class="login-section">
    <h4 class="log-reg">Login</h4>
    <div class="login-content">
        <!-- Вывод ошибок -->
        <?php if (isset($_SESSION['login_errors'])): ?>
            <div class="error-messages">
                <?php foreach ($_SESSION['login_errors'] as $field => $message): ?>
                    <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="login-form" action="log.php" method="post" class="form-login">
            <div class="name">
                <label for="login-email">Email:</label>
                <input type="email" name="email" id="login-email" required
                    value="<?php echo isset($_SESSION['login_old']['email']) ? htmlspecialchars($_SESSION['login_old']['email']) : ''; ?>" />
                <span class="email-error error-message"></span>
            </div>

            <div class="password">
                <label for="login-password">Password:</label>
                <input type="password" name="password" id="login-password" required />
                <span class="password-error error-message"></span>
            </div>

            <div class="login">
                <button class="signup-btn" type="submit" name="do_login">Login</button>
            </div>
            <a class="btn" href="register.php">Register now</a>
        </form>
    </div>
</section>

<?php require "inc/_footer.php" ?>

<script src="login.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = localStorage.getItem('success');
        if (successMessage) {
            showToast(successMessage); // Показываем уведомление
            localStorage.removeItem('success'); // Удаляем сообщение после отображения
        }
    });

    function showToast(message) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.position = 'fixed';
        toast.style.bottom = '35px';
        toast.style.right = '25px';
        toast.style.padding = '10px 20px';
        toast.style.backgroundColor = '#4caf50';
        toast.style.color = 'white';
        toast.style.borderRadius = '5px';
        toast.style.fontSize = '20px';
        toast.style.zIndex = '1000';

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 7000); // Уведомление исчезает через 3 секунды
    }
</script>
</body>
</html>
