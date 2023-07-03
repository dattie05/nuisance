<?php 

    require './auth/conn.php';
    session_start();
    $username = $_SESSION["username"];
    
    if ( !isset($_SESSION["username"]) ) {
        header("Location: ./pages/login.php");
        die();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    
    <div class="top">

        <img src="./assets/logo.png" alt="logo">
        <h2><span>S</span>tudent <span>N</span>uisance <span>M</span>anagement <span>S</span>ystem</h2>

    </div>
    <nav>

        <div>
            <p>SNMS</p>
            <div class="clock">
                <span id="hour"></span> : <span id="minute"></span> : <span id="second"></span> <span id="status"></span>
            </div>
        </div>
        <div>
            <p class="username"><i class="fa-solid fa-user"></i> <?php echo $_SESSION["username"] ?></p>
            <a href="./auth/signout.php">Sign Out <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>

    </nav>

    <main>
        <div class="side-bar">
            <h1>Dashboard</h1>
            <a class="navbuttons" id="manage-nuisances" href="#">Manage Nuisances <i class="fa-solid fa-arrow-right"></i></a>
            <a class="navbuttons" id="manage-users" href="#">Manage Users <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div id="welcome" class="welcome content">
            <h2><span id="time"></span>, <?php echo $_SESSION["username"] ?>! </h2>
            <p>Welcome to the Student Nuisance Management System. Use the tools on the left side to manage data.</p>
        </div>
        <div id="nuisances" class="nuisances-content content">

            <?php 
                if ( isset($_SESSION["error"]) ) {
                    $message = $_SESSION["error"];
                    echo '<h3 class="error">' . $message . '</h3>';
                    unset($_SESSION["error"]);
                }

                if ( isset($_SESSION["success"]) ) {
                    $message = $_SESSION["success"];
                    echo '<h3 class="success">' . $message . '</h3>';
                    unset($_SESSION["success"]);
                }
            ?>

            <p class="crumb-bread"><a href="../">Home</a> / <span>Manage Nuisances</span></p>
            <h2>Manage Nuisances</h2>
            <table>
                <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Registration Number</th>
                    <th>Campus</th>
                    <th>Nuisance</th>
                    <th>Action</th>
                </tr>
                <?php 
                
                $nuisance = 'SELECT * FROM nuisances';
                $nuisance_result = mysqli_query($conn, $nuisance);

                $no = 1;

                while ( $nuisance_info = mysqli_fetch_assoc($nuisance_result) ) {
                    $nuisance_id  =  $nuisance_info["ID"];
                ?>

                <tr>
                    <td><?php echo $no?></td>
                    <td><?php echo $nuisance_info["full_name"]?></td>
                    <td><?php echo $nuisance_info["reg_number"]?></td>
                    <td><?php echo $nuisance_info["campus"]?></td>
                    <td><?php echo $nuisance_info["description"]?></td>
                    <td><a href="./flow/deletenuisance.php?id=<?php echo $nuisance_id ?>"><i class="fa-solid fa-trash"></i> Delete</a></td>
                </tr>

                <?php 
                
                    $no++;
                }
                ?>

            </table>
        </div>
        <div id="users" class="nuisances-content content">
            <?php 
                if ( isset($_SESSION["user_error"]) ) {
                    $message = $_SESSION["user_error"];
                    echo '<h3 class="error">' . $message . '</h3>';
                    unset($_SESSION["user_error"]);
                }

                if ( isset($_SESSION["user_success"]) ) {
                    $message = $_SESSION["user_success"];
                    echo '<h3 class="success">' . $message . '</h3>';
                    unset($_SESSION["user_success"]);
                }
            ?>

            <p class="crumb-bread"><a href="../">Home</a> / <span>Manage Users</span></p>
            <h2>Manage Users</h2>
            <a id="add-open" class="add-user" href="#"><i class="fa-solid fa-plus"></i> Add User</a>
            <table>
                <tr>
                    <th>S/N</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>

                <?php 

                    $users = 'SELECT * FROM users';
                    $users_result = mysqli_query($conn, $users);

                    $no = 1;

                    while ( $users_info = mysqli_fetch_assoc($users_result) ) {
                        $user_id = $users_info['ID'];
                ?>

                <tr>
                    <td><?php echo $no?></td>
                    <td><?php echo $users_info["username"]?></td>
                    <td><?php echo $users_info["email"]?></td>
                    <td><?php echo $users_info["phone_number"]?></td>
                    <td><?php echo $users_info["role"]?></td>
                    
                    <?php 
                        if ( $users_info["status"] == 0 ) {
                            echo '<td><a href="./flow/blockuser.php?id=' . $user_id . '"><i class="fa-solid fa-lock"></i> Block</a><a href="./flow/deleteuser.php?id='. $user_id .'"><i class="fa-solid fa-trash"></i> Delete</a></td>';
                        }
                        else {
                            echo '<td><a href="./flow/unblock.php?id=' . $user_id . '"><i class="fa-solid fa-unlock"></i> Unblock</a><a href="./flow/deleteuser.php?id='. $user_id .'"><i class="fa-solid fa-trash"></i> Delete</a></td>';
                        }
                    ?>
                </tr>

                <?php
                
                    $no++;
                    }
                ?>
            </table>
        </div>
    </main>
        
    <div id="add-user" class="form">
        <form action="./flow/adduser.php" method="post">
            <p><i class="fa-solid fa-xmark" id="add-close" title="close"></i></p>
            <h1>Add User</h1>
            <label for="username">Username:</label>
            <input type="text" name="username">
            <label for="username">Password:</label>
            <input type="password" name="password">
            <label for="email">Email:</label>
            <input type="email" name="email">
            <label for="phone_number">Phone Number:</label>
            <input type="number" name="phone_number">
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="Admin">Admin</option>
                <option value="High Rank(HR)">High Rank(HR)</option>
                <option value="Staff">Staff</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="./scripts/main.js"></script>
</body>
</html>