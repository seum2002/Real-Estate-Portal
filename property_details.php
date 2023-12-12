<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .property-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 12px;
            transition: box-shadow 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .property-container:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            transform: scale(1.02);
        }

        .property {
            border-bottom: 2px solid #a41083;
            padding-bottom: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .property:hover {
            transform: scale(1.03);
        }

        .property img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            transition: transform 0.5s ease-in-out;
        }

        .property img:hover {
            transform: scale(1.1);
        }

        h2 {
            color: #a41083;
            margin-bottom: 10px;
            font-size: 24px;
        }

        p {
            color: #555;
            margin-bottom: 12px;
        }

        strong {
            color: #a41083;
        }
    </style>
</head>

<body>

    <div class="property-container">
        <?php
        include_once "databasesettings.php";

        // Establish database connection
        $conn = new mysqli($host, $user, $pass, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve data from the 'properties' table
        $property_ID = $_GET['propertyID'];
        $selectProperties = "SELECT * FROM properties WHERE id = '$property_ID'";
        $result = $conn->query($selectProperties);

        // Display data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="property">';
                echo '<img src="' . $row['image'] . '" alt="Property Image">';
                echo '<h2>' . $row['property_name'] . '</h2>';
                echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                echo '<p><strong>Price:</strong> $' . number_format($row['price'], 2) . '</p>';
                echo '<p><strong>Built Year:</strong> ' . $row['built_year'] . '</p>';
                echo '<p><strong>Size:</strong> ' . $row['size'] . '</p>';
                echo '<p><strong>Number of Beds:</strong> ' . $row['beds'] . '</p>';
                echo '<p><strong>Number of Baths:</strong> ' . $row['baths'] . '</p>';
                echo '<p><strong>Amenities:</strong> ' . $row['amenities'] . '</p>';
                echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No properties found.</p>';
        }
        $conn->close();
        ?>

    </div>

</body>

</html>
<?php include_once "footer.php" ?>
