<?php 
    require "../auth/conn.php";
?>

<?php 

    $userId = $_GET["id"];

    $query = $conn->prepare("DELETE FROM users WHERE ID = $userId ");
    $query->execute();

    session_start();
    $_SESSION["user_success"] = "User Deleted!";
    header("Location: ../");
    die();

?>