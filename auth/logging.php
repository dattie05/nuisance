<?php 
    require "conn.php";
?>

<?php 

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

        session_start();
        $username = $_POST["username"];
        $password = $_POST["password"];

?>

<?php 

        $exist = "SELECT * FROM users WHERE username = '$username'";
        $exist_result = mysqli_query($conn, $exist);
        $exist_rows = mysqli_num_rows($exist_result);

        if ( $exist_rows < 1 ) {
            $_SESSION["error"] = "User Does Not Exist!";
            header("Location: ../pages/login.php");
            die();
        }

        $blocked = "SELECT * FROM users WHERE username = '$username'";
        $blocked_results = mysqli_query($conn, $blocked);
        $blocked_rows = mysqli_num_rows($blocked_results);
        $blocked_status = mysqli_fetch_assoc($blocked_results);

        if ( $blocked_status["status"] == 1 ) {
            $_SESSION["error"] = "This Account Is Blocked By An Administrator!";
            header("Location: ../pages/login.php");
            die();
        }

        $validate = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $validate_results = mysqli_query($conn, $validate);
        $validate_rows = mysqli_num_rows($validate_results);

        if ( $validate_rows < 1 ) {
            $_SESSION["error"] = "Wrong Login Credentials!";
            header("Location: ../pages/login.php");
            die();
        }

        $_SESSION["username"] = $username;
        header("Location: ../index.php");
        die();
    }

    else {
        header("Location: ../pages/login.php");
        die();
    }
?>