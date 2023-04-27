<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Ienākt</a> vai <a href="signup.html">reģistrēties</a></p>
        
    <?php endif; ?>
    <div class="topnav">
        <div class="topnavLeft">
            <a href="#">SĀKUMS</a>
        </div>
        <div class="topnavRight">
            <form action="/action_page.php" method="get">
                <input type="text" id="searchText" name="searchText" placeholder="Meklēt">
                <input type="submit" value="Meklēt">
            </form>
        </div>
    </div>
    <script src="navBarScript.js"></script>
</body>
</html>