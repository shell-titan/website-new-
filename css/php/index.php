<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle Create and Update for users
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_user'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                echo "New user created successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif (isset($_POST['update_user'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET username='$username', email='$email' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "User updated successfully.";
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }
}


// Handle Delete for users  
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $sql = "DELETE FROM users WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Handle Create for cars
if (isset($_POST['create_car'])) {
    $year = $_POST['year'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO cars (year, model, price, description, image) VALUES ('$year', '$model', '$price', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "New car added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Delete for cars
if (isset($_GET['delete_car'])) {
    $id = $_GET['delete_car'];
    $sql = "DELETE FROM cars WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Car deleted successfully.";
    } else {
        echo "Error deleting car: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Car Management</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>
<body>
    <header>
        <nav>
            <img src="/img/car-logo.png" class="logo" alt="">
            <div class="menu">
                <a href="./index.html">Home</a>
                <a href="#">About</a>
                <a href="./contactus.html">Contact</a>
                <a href="./login.html">Login</a>
            </div>
            <div class="social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </nav>
    </header>
    <style>
/*NAME-RINKU    STUDENT ID _202201048 */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

:root {
    --primary-color: #c6c3c3;
    --second-color: #ffffff;
    --black-color: #000000;
}

body {
    background-size: cover;
    background-position: center;
   
    animation: changeBackground 10s infinite;
}

@keyframes changeBackground {
    0% {
        background-image: url('/img/bg.jpg');
    }
    50% {
        background-image: url('/img/bg-light.jpg');
    }
    100% {
        background-image: url('/img/bg.jpg');
    }
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1;
}

header nav {
    width: 90%;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
}

header nav .logo {
    position: relative;
    width: 300px;
    padding-top: 25px;
    padding-left: 5px;
    align-items: baseline;
}

header nav .menu {
    display: flex;
    align-items: center;

}

header nav .social {
    display: flex;
}

nav .menu a{
    color: #fff;
    margin-left: 30px;
    position: relative;
    text-decoration: none;
}
nav .menu a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0%;
    height: 2px;
    background-color: #1b8a9d;
    transition: 0.4s;
}

nav .menu a:hover::after {
    width: 100%;
}

nav .social a i {
    color: #fff;
    font-size: 22px;
    margin-left: 10px;
    transition: 0.3s;
}

nav .social a i:hover {
    transform: scale(1.3);
    color: #2d82b3;
}

.wrapper {
    width: 75%;
    display: flex;
    flex-direction: column;
    margin-left: 150px;
    align-items: center;
    padding-top: 100px;
    min-height: 100vh;
    background-color: black+5;
}

.section {
    width: 90%;
    margin: 20px 0;
}

.login_box {
    position: relative;
    width: 100%;
    backdrop-filter: blur(25px);
    border: 2px solid var(--primary-color);
    border-radius: 15px;
    padding: 7.5em 2.5em 4em 2.5em;
    color: var(--second-color);
    box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
}

.login-header {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    background-color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 130px;
    height: 75px;
    border-radius: 0 0 20px 20px;
}

.login-header span {
    text-align: center;
    
    
    font-size: 28px;
    color: var(--black-color);
}
.login-header::before{
    content:"";
    position: absolute;
    top: 0;
    left: -30px;
    width: 30px;
    height: 30px;
    border-top-right-radius: 50%;
    background: transparent;
    box-shadow: 15px 0 0 0 var(--primary-color);
}
.login-header::after{
    content: "";
    position: absolute;
    top: 0;
    right: -30px;
    width: 30px;
    height: 30px;
    border-top-left-radius: 50%;
    background: transparent;
    box-shadow: -15px 0 0 0 var(--primary-color);
}


.input_box {
    position: relative;
    display: flex;
    flex-direction: column;
    margin: 20px 0;
}

.input-field {
    width: 100%;
    height: 55px;
    font-size: 16px;
    background: transparent;
    color: var(--second-color);
    padding-inline: 20px 50px;
    border: 2px solid var(--primary-color);
    border-radius: 30px;
    outline: none;
}

#user {
    margin-bottom: 10px;
}

.label {
    position: absolute;
    top: 15px;
    left: 20px;
    transition: .2s;
}

.input-field:focus ~ .label,
.input-field:valid ~ .label {
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 14px;
    background-color: var(--primary-color);
    border-radius: 30px;
    color: var(--black-color);
    padding: 0 10px;
}

.icon {
    position: absolute;
    top: 18px;
    right: 25px;
    font-size: 20px;
}

.remember-forget {
    display: flex;
    justify-content: space-between;
    font-size: 15px;
}

.input-submit {
    width: 100%;
    height: 50px;
    background: #c6c3c3;
    font-size: 16px;
    font-weight: 500;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: .3s;
}

.input-submit:hover {
    background: var(--second-color)
}

.register {
    text-align: center;
}

.register a {
    font-weight: 500;
}

@media only screen and (max-width: 564px) {
    .wrapper {
        padding: 20px;
    }
    .login_box {
        padding: 7.5em 1.5em 4em 1.5em;
    }
}



    </style>

    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Create User</span>
            </div>
            <form method="POST" action="index.php">
                <div class="input_box">
                    <input type="text" name="username" id="user" class="input-field" required>
                    <label for="user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="password" id="pass" class="input-field" required>
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="confirm_password" id="confpass" class="input-field" required>
                    <label for="confpass" class="label">Confirm Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="submit" name="create_user" class="input-submit" value="Create User">
                </div>
            </form>
        </div>

        <div class="login_box">
            <div class="login-header">
                <span>Update User</span>
            </div>
            <form method="POST" action="index.php">
                <div class="input_box">
                    <input type="hidden" name="id" id="update_id" class="input-field">
                </div>
                <div class="input_box">
                    <input type="text" name="username" id="update_user" class="input-field" required>
                    <label for="update_user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="email" name="email" id="update_email" class="input-field" required>
                    <label for="update_email" class="label">Email</label>
                </div>
                <div class="input_box">
                    <input type="submit" name="update_user" class="input-submit" value="Update User">
                </div>
            </form>
        </div>

        <div class="login_box">
            <div class="login-header">
                <span>User List</span>
            </div>
            <?php
            $sql = "SELECT id, username, email, created_at FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th><th>Actions</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='#' onclick='editUser({$row['id']}, \"{$row['username']}\", \"{$row['email']}\")'>Edit</a> |
                                <a href='index.php?delete_user={$row['id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No users found";
            }
            ?>
        </div>

        <!-- Car Management -->
        <div class="login_box">
            <div class="login-header">
                <span>Add Car</span>
            </div>
            <form method="POST" action="index.php">
                <div class="input_box">
                    <input type="text" name="year" id="year" class="input-field" required>
                    <label for="year" class="label">Year</label>
                </div>
                <div class="input_box">
                    <input type="text" name="model" id="model" class="input-field" required>
                    <label for="model" class="label">Model</label>
                </div>
                <div class="input_box">
                    <input type="text" name="price" id="price" class="input-field" required>
                    <label for="price" class="label">Price</label>
                </div>
                <div class="input_box">
                    <input type="text" name="description" id="description" class="input-field" required>
                    <label for="description" class="label">Description</label>
                </div>
                <div class="input_box">
                    <input type="text" name="image" id="image" class="input-field" required>
                    <label for="image" class="label">Image URL</label>
                </div>
                <div class="input_box">
                    <input type="submit" name="create_car" class="input-submit" value="Add Car">
                </div>
            </form>
        </div>

        <div class="login_box">
            <div class="login-header">
                <span>Car List</span>
            </div>
            <?php
            $sql = "SELECT id, year, model, price, description, image FROM cars";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Year</th><th>Model</th><th>Price</th><th>Description</th><th>Image</th><th>Actions</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['year']}</td>
                            <td>{$row['model']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['description']}</td>
                            <td><img src='{$row['image']}' alt='{$row['model']}' width='100'></td>
                            <td>
                                <a href='index.php?delete_car={$row['id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No cars found";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function editUser(id, username, email) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_user').value = username;
            document.getElementById('update_email').value = email;
            window.scrollTo(0, 0);
    


        }
    </script>
</body>
</html>
