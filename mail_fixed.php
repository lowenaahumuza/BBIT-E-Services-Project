<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

// Function to validate email address
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Initialize variables
$userEmail = '';
$userName = '';
$errors = [];
$successMessage = '';

// Check if form data is submitted
if ($_POST) {
    // Get and sanitize user input
    $userEmail = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $userName = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';

    // Validate email address
    if (empty($userEmail)) {
        $errors[] = 'Email address is required.';
    } elseif (!validateEmail($userEmail)) {
        $errors[] = 'Please enter a valid email address.';
    }
    
    // Validate name
    if (empty($userName)) {
        $errors[] = 'Name is required.';
    }
    
    // If no errors, proceed with sending email
    if (empty($errors)) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       //Disable debug output for production
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'lowengel10@gmail.com';                //SMTP username
            $mail->Password   = 'lhyj ltpk pvqb apjm';                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        //Enable explicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to

            //Recipients
            $mail->setFrom('lowengel10@gmail.com', 'BBIT E Services System');
            $mail->addAddress($userEmail, $userName);                   //Add the user as recipient
            $mail->addReplyTo('lowengel10@gmail.com', 'BBIT E Services Support');

            //Content
            $mail->isHTML(true);                                        //Set email format to HTML
            $mail->Subject = 'Welcome to BBIT E Services, ' . $userName . '!';
            
            // Customized email body with user's name
            $mail->Body = '
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; }
                    .content { padding: 20px; }
                    .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>Welcome to BBIT E Services!</h1>
                </div>
                <div class="content">
                    <h2>Hello ' . htmlspecialchars($userName) . ',</h2>
                    <p>We are excited to welcome you to our BBIT E Services platform!</p>
                    <p>Your account has been registered with the email address: <strong>' . htmlspecialchars($userEmail) . '</strong></p>
                    <p>This is a new semester, and we\'re ready to embark on an amazing coding journey together. Get ready to:</p>
                    <ul>
                        <li>Learn cutting-edge programming technologies</li>
                        <li>Work on exciting projects</li>
                        <li>Collaborate with fellow students</li>
                        <li>Build amazing applications</li>
                    </ul>
                    <p><strong>Let\'s enjoy coding together and make this semester memorable!</strong></p>
                    <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
                    <p>Best regards,<br>The BBIT E Services Team</p>
                </div>
                <div class="footer">
                    <p>© 2025 BBIT E Services | Strathmore University</p>
                </div>
            </body>
            </html>';
            
            $mail->AltBody = 'Hello ' . $userName . ',\n\n' .
                           'Welcome to BBIT E Services!\n\n' .
                           'Your account has been registered with: ' . $userEmail . '\n\n' .
                           'This is a new semester, and we are ready to embark on an amazing coding journey together.\n\n' .
                           'Let\'s enjoy coding together and make this semester memorable!\n\n' .
                           'Best regards,\nThe BBIT E Services Team';

            $mail->send();
            $successMessage = 'Welcome email has been sent successfully to ' . htmlspecialchars($userEmail) . '!';
            
        } catch (Exception $e) {
            $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

// Display results
if (!empty($errors)) {
    echo '<div style="color: red; border: 1px solid red; padding: 10px; margin: 10px; border-radius: 5px;">';
    echo '<h3>Errors:</h3>';
    foreach ($errors as $error) {
        echo '<p>• ' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
}
if (!empty($successMessage)) {
    echo '<div style="color: green; border: 1px solid green; padding: 10px; margin: 10px; border-radius: 5px;">';
    echo '<h3>Success!</h3>';
    echo '<p>' . $successMessage . '</p>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBIT E Services Registration</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px;
            background-color: #f9f9f9;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #4CAF50;
            outline: none;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #4CAF50;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <h1>BBIT E Services</h1>
            <p>Register to receive your welcome email</p>
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" 
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                       placeholder="Enter your full name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                       placeholder="Enter your email address" required>
            </div>
            
            <button type="submit" class="submit-btn">Send Welcome Email</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center; color: #666; font-size: 14px;">
            <p>Enter your details above to receive a personalized welcome email!</p>
        </div>
    </div>
</body>
</html>
