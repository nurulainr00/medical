<?php
// Start session
session_start();

// Check if the admin is logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Display logout button
    echo '<form action="logout.php" method="post">';
    echo '<button class="button" type="submit"><span class="glyphicon glyphicon-log-out"></span> Logout</button>';
    echo '</form>';
}

if (
    isset($_POST['elder_name']) &&
    isset($_POST['medicine_name']) &&
    isset($_POST['medicine_type']) &&
    isset($_POST['consumption_date']) &&
    isset($_POST['consumption_time']) &&
    isset($_POST['remark'])
) {
    $conn = new mysqli("localhost", "root", "", "project");
    $sql = $conn->prepare("INSERT INTO medicine(id, eldername, medicinename, medicinetype, consumptiondate, consumptiontime, remark) VALUES (NULL,?,?,?,?,?,?)");
    $sql->bind_param("ssssss", $_POST['elder_name'], $_POST['medicine_name'], $_POST['medicine_type'], $_POST['consumption_date'], $_POST['consumption_time'], $_POST['remark']);
    $sql->execute();
    echo "<script>alert('Insert successfully')</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Medicine Dispenser</title>
    <style>
        body {
            background-image: url('asset/background.jpeg');
            /* Specify the path to your image */
            background-size: cover;
            /* Cover the entire background */
            background-position: center;
            /* Center the background image */
            background-repeat: no-repeat;
            /* Do not repeat the background image */
            color: rgb(9, 67, 4);

        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-image: linear-gradient(to right, #ff007f, #ffcc00);
            color: white;
            border-radius: 9999px;
            /* Large value to make it look like full rounded */
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
        }

        .highlighted {
            background-color: yellow;
            /* Set background color to yellow for highlighted text */
            color: black;
            /* Set font color to black for highlighted text */

        }

        .font {
            background-color: white;
            /* Set background color to yellow for highlighted text */
            color: black;
            /* Set font color to black for highlighted text */
            border-radius: 20px;
            /* Set border radius to create a curved highlight effect */
            padding: 5px 10px;
            /* Add padding for better appearance */
        }

        #remark {
            width: 300px; /* Adjust width as needed */
            height: 100px; /* Adjust height as needed */
        }
    </style>
</head>

<body class="body">

    <h1><span class="highlighted">PERSONAL MEDICINE DISPENSER WITH NOTIFICATION FOR ELDERLY CARE IN 
        NURSING HOME USING ESP32  INTERGRATED WITH MYSQL DATABASE</h1></span>

    <label class="font" for="rotation_time">Enter Rotation Time:</label>
    <input type="datetime-local" id="rotation_time">
    <button class="button" onclick="setRotationTime()">Set Rotation Time</button>

    <p><span class="font">Remaining Time until Rotation: <span id="remaining_time"></span></p></span>

    <form action="" method="post">
        <h2><span class="highlighted">Elder Information</h2></span>
        <label class="font" for="elder_name">Elder Name:</label>
        <input type="text" id="elder_name" name="elder_name" required>
        <br><br>

        <label class="font" for="medicine_name">Medicine Name:</label>
        <input type="text" id="medicine_name" name="medicine_name" required>
        <br><br>

        <label class="font" for="medicine_type">Medicine Type:</label>
        <input type="text" id="medicine_type" name="medicine_type" required>
        <br><br>

        <label class="font" for="consumption_date">Consumption Date:</label>
        <input type="date" id="consumption_date" name="consumption_date" required>
        <br><br>

        <label class="font" for="consumption_time">Consumption Time:</label>
        <input type="time" id="consumption_time" name="consumption_time" required>
        <br><br>

        <label class="font" for="remark">Remarks:</label>
        <textarea id="remark" name="remark" rows="4" cols="50" required></textarea>
        <br><br>

        <button class="button" type="submit">Submit Medicine Info</button>
        <button class="button">Send Notification to Caretaker</button>
    </form>

</body>

</html>