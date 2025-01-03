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
     <h2 class="log-reg"> User</h2>
    

    <div class="login-content">
        
        <div class="user-avatar">
            <label for="avatarInput" class="avatar-label">

                <div class="avatar-placeholder" id="avatarPlaceholder">
                    <img id="avatarIcon" src="./static/images/svg/user.svg" alt="User Icon">
                </div>
                <img id="userAvatar" class="hidden" alt="User Avatar">
            </label>
            <input type="file" id="avatarInput" accept="image/*" style="display: none;">
        </div>

    
        <form id="userForm" class="form-login">
            <div class="name">
                <label for="userName">Name:</label>
                <input type="text" id="userName" name="userName" placeholder="Enter your name" required>
            </div>

            <div class="name">
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" name="userEmail" placeholder="Enter your email" required>
            </div>

            <div class="name">
                <label for="userPassword">Details :</label>
                 <textarea></textarea>
            </div>
            

            <div class="login">
                <button type="submit" class="signup-btn">Save Changes</button>
            </div>
        </form>
    </div>
</section>






<?php require "inc/_footer.php" ?>
<script src="javaS.js" defer></script>
</body>
 


</html>