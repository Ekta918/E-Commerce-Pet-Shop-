<?php
include("../includes/connect.php");
@session_start();

// Check if the email parameter is set
if (isset($_GET['email'])) {
    $user_email = $_GET['email'];
} else {
    echo "<script>alert('No email provided.'); window.location.href='forgot_password.php';</script>";
    exit();
}

// Handle password reset submission
if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that the new password and confirm password match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Query to update the password
        $update_query = "UPDATE `user_table` SET user_password='$hashed_password' WHERE user_email='$user_email'";

        if (mysqli_query($con, $update_query)) {
            // Optionally delete the OTP after use
            $user_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `user_table` WHERE user_email='$user_email'"));
            $user_id = $user_data['user_id'];
            mysqli_query($con, "DELETE FROM `otp_table` WHERE user_id='$user_id'");

            echo "<script>alert('Password reset successful!'); window.location.href='user_login.php';</script>";
        } else {
            echo "<script>alert('Failed to reset password.');</script>";
        }
    }
}

// Display the reset password form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Reset Your Password</h2>
        <form action="" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($user_email); ?>">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="reset_password">Reset Password</button>
        </form>
    </div>
</body>
</html>
