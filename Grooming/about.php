<?php require "./db/config.php"; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snout Studio</title>
    <link rel="stylesheet" href="./static/css/styles.css" >
    <link rel="stylesheet" href="./static/css/media.css" >
    <link rel="stylesheet" href="./static/css/footer.css" >
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<?php require "inc/_header.php" ?>

<section  class="about-section">
    <h3 class="About-title">About us</h3>
    
    <div class="about-content">  
        
        <div>
          <img src="./static/images/salon1.jfif" alt="">
        </div>
        <div class="about-text">
           Welcome to our grooming salon in Prague! With over 5 years of experience, we provide professional grooming services
           for your pets, ensuring their comfort and well-being. Our dedicated team takes great care in offering personalized 
           attention, using modern techniques and high-quality products.  We treat every pet with love and respect, making sure
           they leave happy and looking their best.
        </div>
      
        <div>
           <img src="./static/images/salon2.jfif" alt="Salon">
        </div>
    </div>
</section>

<?php require "inc/_footer.php" ?>

<script src="javaS.js"></script>
</body>

</html>