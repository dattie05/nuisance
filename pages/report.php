<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/report.css">
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

    else if ( isset($_SESSION["success"]) )  {
        $message = $_SESSION["success"];
        echo '<h3 class="success">'. $message . '</h3>';
        unset($_SESSION["success"]);
    }

    ?>

    <form action="../auth/reporting.php" method="POST">
        <h1>Nuisance Report</h1>
    
        <img src="../assets/logo.png" alt="logo">
        
        <h3><span>S</span>tudent <span>N</span>uisance <span>M</span>anagement <span>S</span>ystem</h3>
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" required>
        <label for="reg_number">Registration Number:</label>
        <input type="text" name="reg_number" required>
        <label for="campus">Campus:</label>
        <select name="campus" id="campus">
            <option value="default" selected>Select Your Campus</option>
            <option value="Tunguu Campus">Tunguu Campus</option>
            <option value="Chwaka Campus">Chwaka Campus</option>
            <option value="Vuga Campus">Vuga Campus</option>
            <option value="Kilimani Campus">Kilimani Campus</option>
            <option value="Mbweni Campus">Mbweni Campus</option>
            <option value="Kizimbani Campus">Kizimbani Campus</option>
            <option value="Bububu Campus">Bububu Campus</option>
            <option value="Tunguu Campus">Tunguu Campus</option>
        </select>
        <label for="description">Nuisance Description:</label>
        <textarea name="description" id="description" rows="5"></textarea>
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>