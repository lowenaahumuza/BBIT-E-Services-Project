<?php
// Database configuration
$host = 'localhost';
$dbname = 'bbit_services';
$username = 'root';
$password = '';

// Initialize variables
$users = [];
$error = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to get users in ascending order
    $stmt = $pdo->prepare("SELECT id, name, email, created_at FROM users ORDER BY name ASC");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Database connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBIT E Services - User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .user-list {
            margin-top: 20px;
        }
        .user-item {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            display: flex;
            align-items: center;
        }
        .user-number {
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 20px;
        }
        .user-info {
            flex-grow: 1;
        }
        .user-name {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }
        .user-email {
            color: #666;
            font-size: 14px;
            margin-bottom: 3px;
        }
        .user-date {
            color: #999;
            font-size: 12px;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ffcdd2;
            margin: 20px 0;
        }
        .no-users {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        .stats {
            background-color: #e8f5e8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BBIT E Services</h1>
            <h2>Registered Users List</h2>
            <p>Users displayed in ascending order by name</p>
        </div>

        <?php if ($error): ?>
            <div class="error">
                <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                <br><br>
                <strong>Note:</strong> This appears to be a database connection issue. 
                Please ensure your MySQL database is running and the 'bbit_services' database exists with a 'users' table.
            </div>
        <?php else: ?>
            
            <?php if (count($users) > 0): ?>
                <div class="stats">
                    <strong>Total Registered Users: <?php echo count($users); ?></strong>
                </div>
                
                <div class="user-list">
                    <?php foreach ($users as $index => $user): ?>
                        <div class="user-item">
                            <div class="user-number">
                                <?php echo $index + 1; ?>
                            </div>
                            <div class="user-info">
                                <div class="user-name">
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </div>
                                <div class="user-email">
                                    Email: <?php echo htmlspecialchars($user['email']); ?>
                                </div>
                                <div class="user-date">
                                    Registered: <?php echo date('F j, Y g:i A', strtotime($user['created_at'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-users">
                    <h3>No users found</h3>
                    <p>There are currently no registered users in the system.</p>
                    <p><a href="mail_fixed.php">Click here to register the first user</a></p>
                </div>
            <?php endif; ?>
            
        <?php endif; ?>

        <div style="margin-top: 30px; text-align: center; padding-top: 20px; border-top: 1px solid #ddd;">
            <p><a href="mail_fixed.php" style="color: #4CAF50; text-decoration: none;">← Back to Registration</a></p>
        </div>
    </div>
</body>
</html>
