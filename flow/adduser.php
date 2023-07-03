<?php 
    require "../auth/conn.php";
?>

<?php 

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ){
        session_start();
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phone_number"];
        $role = $_POST["role"];

?>

<?php 

    $exist = "SELECT * FROM users WHERE username = '$username'";
    $exist_result = mysqli_query($conn, $exist);
    $exist_rows = mysqli_num_rows($exist_result);

    if ( $exist_rows > 0 ) {
        $_SESSION["user_error"] = "User Already Exists";
        header("Location: ../");
        die();
    }

    $query = $conn->prepare("INSERT INTO users (username, password, email, phone_number, role) VALUES ('$username', '$password', '$email', '$phoneNumber', '$role') ");
    $query->execute();

    $_SESSION["user_success"] = "User Added!";
    header("Location: ../");
    die();

    }
?>