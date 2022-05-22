<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => site_url('/Register/getalluser'),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response);

?>

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
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 14px;
        }

        .title {
            font-size: 15px;
            font-weight: 600;
            margin: 0.5px;
        }

        .sub-title {
            font-size: 13px;
            font-weight: 600;
        }

        .delete-link:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body class="container-body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Work Order</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('register') ?>">Worker Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('BreakdownPoints') ?>">Breakdown Points</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-8">
                <p class="title text-success">Worker Registration</p>
                <p class="sub-title text-primary">Worker Registration List</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="<?php echo site_url('register/createuser') ?>" class="btn btn-primary">Create Workers</a>
            </div>
        </div>
        <div class="mt-3" id="table">
            <?php
            if (count($data) > 0) {
            ?>
                <table class="table table-striped">
                    <tr>
                        <th>SI.No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Division</th>
                        <th>Sub Division</th>
                        <th>Section</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    $id = 0;
                    foreach ($data as $worker) {
                        $id = $id + 1;
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $worker->fname; ?></td>
                            <td><?php echo $worker->lname; ?></td>
                            <td><?php echo $worker->phoneNumber; ?></td>
                            <td><?php echo $worker->division; ?></td>
                            <td><?php echo $worker->subDivision; ?></td>
                            <td><?php echo $worker->section; ?></td>
                            <td><a href="Register/updateWorker?id=<?php echo $worker->id; ?>">View / Edit</a></td>
                            <td>
                                <p class="text-primary delete-link" onclick="delete_user(<?php echo $worker->id; ?>)">Delete</p>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>

<script>
    function delete_user(selectedValue) {
        if (confirm("are you suer you want to delete this user?")) {
            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                let data = JSON.parse(this.responseText);
                let msg;
                if (data.status === 201) {
                    alert('Something went wrong');
                } else {
                    alert('User Has Been deleted Successfully!');
                    document.location = '<?php echo site_url('register') ?>';
                }
            }
            xhr.open('GET', '<?php echo site_url('Register/deleteuser/'); ?>'+selectedValue);
            xhr.send();
        }
    }
</script>