<?php
include 'db_connect.php';

// Query to fetch the debt management service details
$sql = "SELECT * FROM services WHERE service_name = 'Debt Management & Reduction Counseling'";
$result = $conn->query($sql);
$service = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($service['service_name']); ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('animation.gif') no-repeat center center fixed;
            background-size: cover;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        #chatbot{
            position: fixed;
            left: 1500px;
            top: 290px;
        }

        .service-box {
            width: 80%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.9); /* Slight transparency */
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .service-box h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .service-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .more-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .more-button:hover {
            background-color: #0056b3;
        }

        .modal, .modal-overlay {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000;
        }

        .modal-overlay {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
        }

        .modal .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #333;
        }
    </style>
    <link rel="stylesheet" href="botimag.cs">
</head>
<body>
    <img  id="chatbot" class="chatbot" height="200" width="200" src="images/Adobe Express - file.png" alt="chatbot">
    <div style="z-index: 10000;" id="chat-container">
        <div id="chat-header">Chat bot <span id="close-chat">&times;</span></div>
        <div id="chat-box"></div>
        <div style="display: flex;">

            <input type="text" id="user-input" placeholder="Type your message..." />
            <button id="send-btn">Send</button>
        </div>

    </div>
    <script src="botimag.js"></script>
    <header>
        <h1>Counseling</h1>
        <nav><a href="index.html">Home</a></nav>
    </header>

    <main>
        <div class="service-box">
            <h2><?php echo htmlspecialchars($service['service_name']); ?></h2>
            <p class="service-description">
                <?php echo htmlspecialchars(substr($service['description'], 0, 400)) . '...'; ?>
            </p>
            <button class="more-button" id="openModal">Coming Soon!</button>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal" id="modal">
        <span class="close" id="closeModal">&times;</span>
        <h2><?php echo htmlspecialchars($service['service_name']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
    </div>

    <script>
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modalOverlay');

        openModalButton.addEventListener('click', () => {
            modal.style.display = 'block';
            overlay.style.display = 'block';
        });

        closeModalButton.addEventListener('click', () => {
            modal.style.display = 'none';
            overlay.style.display = 'none';
        });

        overlay.addEventListener('click', () => {
            modal.style.display = 'none';
            overlay.style.display = 'none';
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
