<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snout Studio</title>
    <link rel="stylesheet" href="./static/css/styles.css"  >
    <link rel="stylesheet" href="./static/css/media.css" >
    <link rel="stylesheet" href="./static/css/footer.css" >

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<?php require "inc/_header.php" ?>

<section class="hero-section">
    <div class="hero-content">
        <div class="hero-content__image">
            <img src="./static/images/dogboss.jfif" alt="Pet Grooming">
        </div>
        <div class="hero-content__text">
            <h2>Take the first step towards a beautiful and happy pet!</h2>
            <button class="signup-btn">Sign up</button>
        </div>
    </div>
</section>




<script src="javaS.js">
    
  
</script>
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
        toast.style.bottom = '40px';
        toast.style.right = '20px';
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