<?php
// Database connection
$host = 'localhost';
$dbname = 'bankdbms';
$user = 'root'; // Change if necessary
$password = ''; // Change if necessary

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// Initialize variables for selected banks
$bank1 = isset($_POST['bank1']) ? $_POST['bank1'] : 'Not Selected';
$bank2 = isset($_POST['bank2']) ? $_POST['bank2'] : 'Not Selected';

// Fetch FD and RD schemes for both banks
$query = "SELECT * FROM schemes WHERE bank_name IN (:bank1, :bank2)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':bank1', $bank1);
$stmt->bindParam(':bank2', $bank2);
$stmt->execute();
$schemes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Map bank names to image paths for each bank (to handle variations)
$bankImages = [
    'SBI' => 'sbi.jpg',
    'HDFC' => 'hdfc.jpg',
    'Canara Bank' => 'canara.jpg',
    'Mizoram Rural Bank' => 'mizoramb.png',
    'North East Small Finance Bank' => 'NESFbank.jpg'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparison Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('images/question.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(78, 13, 13, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(70, 38, 38, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .comparison-section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .bank-box {
            flex: 1;
            background-color: rgba(73, 73, 151, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .bank-box h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .scheme-box {
            background:rgb(59, 49, 49);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        .scheme-box img {
            display: block;
            margin: 0 auto 10px;
            width: 80px;
            height: auto;
        }

        .scheme-details h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .scheme-url a {
            color: #007bff;
            text-decoration: none;
        }

        .scheme-url a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comparison Results for <?php echo htmlspecialchars($bank1); ?> vs <?php echo htmlspecialchars($bank2); ?></h1>
        
        <div class="comparison-section">
            <!-- Bank 1 Schemes -->
            <div class="bank-box">
                <h2><?php echo htmlspecialchars($bank1); ?> Schemes</h2>
                <?php if ($bank1 !== 'Not Selected'): ?>
                    <?php foreach ($schemes as $scheme): ?>
                        <?php if ($scheme['bank_name'] === $bank1): ?>
                            <div class="scheme-box">
                                <!-- Display the bank logo dynamically -->
                                <img src="images/<?php echo isset($bankImages[$bank1]) ? $bankImages[$bank1] : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($bank1); ?> Logo">
                                <div class="scheme-details">
                                    <h3><?php echo htmlspecialchars($scheme['scheme_name']); ?></h3>
                                    <p>Type: <?php echo htmlspecialchars($scheme['scheme_type']); ?></p>
                                    <p>Interest Rate: <?php echo htmlspecialchars($scheme['interest_rate']); ?>%</p>
                                    <p>Duration: <?php echo htmlspecialchars($scheme['duration']); ?></p>
                                    <p>Description: <?php echo htmlspecialchars($scheme['scheme_description']); ?></p>
                                    <div class="scheme-url">
                                        <a href="<?php echo htmlspecialchars($scheme['scheme_url']); ?>" target="_blank">More Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No schemes available for <?php echo htmlspecialchars($bank1); ?>.</p>
                <?php endif; ?>
            </div>

            <!-- Bank 2 Schemes -->
            <div class="bank-box">
                <h2><?php echo htmlspecialchars($bank2); ?> Schemes</h2>
                <?php if ($bank2 !== 'Not Selected'): ?>
                    <?php foreach ($schemes as $scheme): ?>
                        <?php if ($scheme['bank_name'] === $bank2): ?>
                            <div class="scheme-box">
                                <!-- Display the bank logo dynamically -->
                                <img src="images/<?php echo isset($bankImages[$bank2]) ? $bankImages[$bank2] : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($bank2); ?> Logo">
                                <div class="scheme-details">
                                    <h3><?php echo htmlspecialchars($scheme['scheme_name']); ?></h3>
                                    <p>Type: <?php echo htmlspecialchars($scheme['scheme_type']); ?></p>
                                    <p>Interest Rate: <?php echo htmlspecialchars($scheme['interest_rate']); ?>%</p>
                                    <p>Duration: <?php echo htmlspecialchars($scheme['duration']); ?></p>
                                    <p>Description: <?php echo htmlspecialchars($scheme['scheme_description']); ?></p>
                                    <div class="scheme-url">
                                        <a href="<?php echo htmlspecialchars($scheme['scheme_url']); ?>" target="_blank">More Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No schemes available for <?php echo htmlspecialchars($bank2); ?>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
