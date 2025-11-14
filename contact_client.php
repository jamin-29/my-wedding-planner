<?php
include('includes/db_connect.php'); // Assuming this is your project root connection

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message_text']);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill out all required fields.";
    } else {
        $query = "INSERT INTO messages (client_name, client_email, subject, message_text) 
                  VALUES ('$name', '$email', '$subject', '$message')";

        if (mysqli_query($conn, $query)) {
            $success = "Your message has been sent successfully. We will reply soon!";
            // Optionally, send an automated email notification to yourself here
        } else {
            $error = "Error sending message: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* --- CSS for contact_client.php --- */

        /* --- Global Variables --- */
        :root {
            --color-primary: #004f99;
            /* Dark Blue */
            --color-accent: #007bff;
            /* Bright Blue */
            --color-text-dark: #333;
            --color-border: #d1d5db;
            --color-success: #157347;
            /* Darker green for accessibility */
            --color-cancelled: #bb2124;
            /* Darker red for accessibility/error */
            --color-required: #dc3545;
            /* Red for required indicator */
            --border-radius-sm: 6px;
            --shadow-base: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        /* --- Base Styles --- */
        body {
            font-family: 'Poppins', sans-serif;
            /* Ensure you link this font in HTML if not global */
            color: var(--color-text-dark);
            background-color: #f8f9fa;
            line-height: 1.6;
        }

        /* --- Form Container --- */
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow-base);
            border: 1px solid #e0e0e0;
        }

        .form-container h2 {
            color: var(--color-primary);
            border-bottom: 3px solid var(--color-accent);
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-size: 26px;
        }

        /* --- Input Grouping and Labeling --- */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-weight: 600;
            color: var(--color-text-dark);
            margin-bottom: 5px;
            font-size: 15px;
        }

        /* Required Field Indicator (Fix) */
        .input-group label[required]::after {
            content: ' *';
            color: var(--color-required);
            font-weight: 700;
        }

        /* Input and Textarea Styling */
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container textarea {
            width: 100%;
            padding: 12px;
            border-radius: var(--border-radius-sm);
            border: 1px solid var(--color-border);
            font-size: 15px;
            color: var(--color-text-dark);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-container textarea {
            resize: vertical;
        }

        .form-container input:focus,
        .form-container textarea:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(0, 79, 153, 0.2);
        }

        /* --- Button Styling (Send Message) --- */
        .form-container button[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background-color: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.1s;
            margin-bottom: 10px;
        }

        .form-container button[type="submit"]:hover {
            background-color: #003366;
        }

        .form-container button[type="submit"]:active {
            transform: translateY(1px);
        }

        /* --- Back Button Styling (Link styled as a button) --- */
        .back-to-home {
            display: block;
            width: 100%;
            padding: 12px 20px;
            text-align: center;
            background-color: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            border-radius: var(--border-radius-sm);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.2s, color 0.2s;
        }

        .back-to-home:hover {
            background-color: var(--color-primary);
            color: #fff;
        }


        /* --- Message Styling --- */
        .success,
        .error {
            padding: 15px;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: var(--color-success);
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: var(--color-cancelled);
            border: 1px solid #f5c6cb;
        }

        /* --- Media Query --- */
        @media (max-width: 540px) {
            .form-container {
                margin: 20px 10px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Send Us a Message</h2>
        <?php if ($success): ?>
            <p class="success"><?= $success ?></p><?php endif; ?>
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p><?php endif; ?>

        <form method="POST" action="contact_client.php">
            <div class="input-group">
                <label for="name" required>Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email" required>Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="subject" required>Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="input-group">
                <label for="message_text" required>Message:</label>
                <textarea id="message_text" name="message_text" rows="6" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>

        <a href="index.php" class="back-to-home">Back to Landing Page</a>
    </div>

</body>

</html>