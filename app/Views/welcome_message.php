<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title></title> -->
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- Bootstrap scripts starts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Bootstrap scripts ends -->

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Admin Login</title>
    <style>
        .container-body {
            height: 100vh;
            background: #F7F9FB;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #ffffff;
            padding: 25px;
            width: 30%;
            border-radius: 10px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container-body">
        <div class="login-container">
            <div id="msg"></div>
            <h1 class="login-title">Admin Login</h1>
            <form method="post" id="loginForm" class="mt-3" autocomplete="off">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="Username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>

<script>
    document.querySelector("#loginForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
        formData.append('phoneNumber', document.getElementById('username').value);
        formData.append('password', document.getElementById('Password').value);
        formData.append('type', 'admin');
        xhr.onload = function() {
            let data = JSON.parse(this.responseText);
            let msg;
            if (data.status === 201) {
                msg = '<p class="alert alert-danger">Please enter correct username and password!</p>'
            } else {
                msg = '<p class="alert alert-success">Login Success!</p>'
                document.location = '<?php echo site_url('AdminHome'); ?>';
            }
            document.getElementById('msg').innerHTML = msg;
        }
        xhr.open('POST', '<?php echo site_url('Register/userlogin'); ?>');
        xhr.send(formData);
    });
</script>