document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');

    if (loginForm) {
        const email = document.getElementById('login-email');
        const password = document.getElementById('login-password');
        const emailError = document.querySelector('.email-error');
        const passwordError = document.querySelector('.password-error');

        email.addEventListener('input', () => {
            email.classList.remove('error_field');
            if (emailError) emailError.textContent = '';
        });

        password.addEventListener('input', () => {
            password.classList.remove('error_field');
            if (passwordError) passwordError.textContent = '';
        });

        loginForm.addEventListener('submit', (event) => {
            let hasError = false;

            if (emailError) emailError.textContent = '';
            if (passwordError) passwordError.textContent = '';

            email.classList.remove('error_field');
            password.classList.remove('error_field');

            if (!validateEmail(email.value)) {
                email.classList.add('error_field');
                if (emailError) emailError.textContent = 'Invalid email address.';
                hasError = true;
            }

            if (password.value.trim() === '') {
                password.classList.add('error_field');
                if (passwordError) passwordError.textContent = 'Password cannot be empty.';
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
    }
});
