<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <title>SNMS</title>
</head>
<body>

    <?php 

        session_start();    
        if ( isset($_SESSION["error"]) ) {
            $message = $_SESSION["error"];
            echo '<h3 class="error">'. $message . '</h3>';
            unset($_SESSION["error"]);
        }

    ?>

    <form action="../auth/logging.php" method="POST">
        <h1>Login</h1>
    
        <img src="../assets/logo.png" alt="logo">
        
        <h3><span>S</span>tudent <span>N</span>uisance <span>M</span>anagement <span>S</span>ystem</h3>
        <label for="username">Username:</label>
        <input type="text" name="username" autocomplete="off" required>
        <label for="password">Password:</label>
        <input type="password" name="password" autocomplete="off" required>
        <button type="submit">Submit</button>
    </form>

</body>
</html>