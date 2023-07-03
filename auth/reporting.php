<?php 
    require 'conn.php';
?>

<?php 

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ){

        session_start();
        $fullName = $_POST["fullName"];
        $regNumber = $_POST["reg_number"];
        $campus = $_POST["campus"];
        $description = $_POST["description"];

?>

<?php 

        if ( $campus == 'default' ) {
            $_SESSION["error"] = "Select a valid Campus!";
            header("Location: ../pages/report.php");
            die();
        }

        $query = $conn->prepare("INSERT INTO nuisances (full_name, reg_number, campus, description) VALUES ('$fullName', '$regNumber', '$campus', '$description')");
        $query->execute();

        $_SESSION["success"] = "Nuisance Submitted!";
        header("Location: ../pages/report.php");
        die();
    }

    else {
        header("Location: ../pages/report.php");
        die();
    }
    
?>