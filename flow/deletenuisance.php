<?php 
    require "../auth/conn.php";
?>

<?php 

    $nuisance_id = $_GET["id"];

    $query = $conn->prepare("DELETE FROM nuisances WHERE ID = $nuisance_id");
    $query->execute();

    session_start();
    $_SESSION["success"] = "Nuisance Deleted!";
    header("Location: ../");
    die();

?>