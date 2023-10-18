<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("dbconfig.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <form class="border shadow p-3 rounded" method="post" style="width: 450px;">
            <h1 class="text-center p-3">LOGIN</h1>
            <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?= $_GET['success'] ?>
            </div>
            <?php } ?>
            <?php
            $username = isset($_GET['username']) ? $_GET['username'] : '';
            ?>
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <div class="mb-3">
                <label class="form-label">Verify code</label>
                <input type="text" name="verification_code" class="form-control" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary">Verify</button>
        </form>
    </div>

    <?php
    if (isset($_POST['sub'])) {
        $username = $_POST['username'];
        $verification_code = $_POST['verification_code'];

        if ($_SESSION['login_type'] == 'student_list') {
            $sql = "UPDATE `student_list` SET `email_verified_at`= NOW() WHERE email='" . $username . "' AND verification_code = '" . $verification_code . "'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn) == 0) {
                die("Verification code failed.");
            } else {
                header("Location: email-verification.php?success=Verified successed");
            }
        } else {
            die("Verification code failed.");
        }
    }
    ?>
</body>

</html>