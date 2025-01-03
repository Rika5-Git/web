document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-register');

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('cpassword');
    const emailError = document.querySelector('.email-error');
    const passwordError = document.querySelector('.password-error');
    const confirmPasswordError = document.querySelector('.confirm-password-error');

    // Обработка ввода: сброс ошибок при исправлении
    email.addEventListener('input', () => {
        email.classList.remove('error_field');
        emailError.textContent = '';
    });

    password.addEventListener('input', () => {
        password.classList.remove('error_field');
        passwordError.textContent = '';
    });

    confirmPassword.addEventListener('input', () => {
        confirmPassword.classList.remove('error_field');
        confirmPasswordError.textContent = '';
    });

    form.addEventListener('submit', (event) => {
        let hasError = false;

        // Сброс сообщений об ошибках перед проверкой
        emailError.textContent = '';
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';

        email.classList.remove('error_field');
        password.classList.remove('error_field');
        confirmPassword.classList.remove('error_field');

        // Проверка email
        if (!validateEmail(email.value)) {
            email.classList.add('error_field');
            emailError.textContent = 'Invalid email address.';
            hasError = true;
        }

        // Проверка длины пароля
        if (password.value.length < 6) {
            password.classList.add('error_field');
            passwordError.textContent = 'Password must be at least 6 characters long.';
            hasError = true;
        }

        // Проверка совпадения паролей
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add('error_field');
            confirmPasswordError.textContent = 'Passwords do not match.';
            hasError = true;
        }

        if (hasError) {
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});