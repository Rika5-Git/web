<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="./static/css/styles.css">
    <link rel="stylesheet" href="./static/css/media.css" >
    <link rel="stylesheet" href="./static/css/footer.css" >
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<?php require "inc/_header.php" ?>



<section id="Gallery" class="Gallery-section">
 <h3 class="Gallery-content-text" >Gallery</h3> 
    <div class="Gallery-content">
        <button class = "plus_photo1"><img  src="./static/images/svg/plus.svg" alt = "Add Photo"></button>
        <div class="Gallery-wrapper">
            <img class="Gallery-content-img" src="./static/images/pet1.jfif" alt="Yorkshire Terrier">
            <img class="Gallery-content-img" src="./static/images/pet2.jfif" alt="Poodle">
            <img class="Gallery-content-img" src="./static/images/pet3.jfif" alt="Shih Tzu">
            <img class="Gallery-content-img" src="./static/images/pet4.jfif" alt="Maltese"> 
            <img class="Gallery-content-img" src="./static/images/Maine Coon.jpg" alt="Maine Coon"> 
        </div>
    </div>
</section>


<?php require "inc/_footer.php" ?>

<script src="javaS.js"></script>
</body>

</html>