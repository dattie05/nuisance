<?php 
    require "../auth/conn.php";
?>

<?php 

    $userId = $_GET["id"];

    $query = $conn->prepare("UPDATE users SET status = 1 WHERE ID = $userId");
    $query->execute();

    session_start();
    $_SESSION["user_success"] = "User Blocked!";
    header("Location: ../");
    die();

?>