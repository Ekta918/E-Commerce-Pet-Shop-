<?php 
include("../includes/connect.php"); 
include("../functions/common_function.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Forgot Password</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Send OTP</button>
        </form>
    </div>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    if (isset($_POST['submit'])) {
        $admin_email = $_POST['email'];

        // Check if the email exists
        $select_query = "SELECT * FROM `admin_table` WHERE admin_email='$admin_email'";
        $result = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result) > 0) {
            $admin_data = mysqli_fetch_assoc($result);
            $admin_id = $admin_data['admin_id'];

            // Generate OTP
            $otp = rand(100000, 999999);
            $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            // Store OTP in the database
            $insert_query = "INSERT INTO `admin_otp_table` (user_id, otp, created_at, expires_at) VALUES ('$admin_id', '$otp', NOW(), '$expires_at')";
            mysqli_query($con, $insert_query);

            // Send OTP via email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ektavaghasiya9@gmail.com'; // Your email
                $mail->Password   = 'twyh vxdk lbin qpnm'; // Your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('ektavaghasiya9@gmail.com', 'Admin Support');
                $mail->addAddress($admin_email);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for Admin Password Reset';
                $mail->Body    = "Your OTP is: <strong>$otp</strong>. This OTP is valid for 10 minutes.";

                $mail->send();
                echo "<script>alert('An OTP has been sent to your email. Please enter it to verify.');</script>";
                echo "<script>window.location.href='admin_otp_verification.php?email=$admin_email';</script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>alert('Email address not found.');</script>";
        }
    }
    ?>
</body>
</html>
