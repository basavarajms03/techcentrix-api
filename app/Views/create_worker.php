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
    CURLOPT_URL => base_url() . '/division',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$allDivisions = curl_exec($curl);

curl_close($curl);
$getAllDivisions = json_decode($allDivisions);

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

        input[type="text"],
        input[type="number"],
        input[type="email"],
        .btn {
            font-size: 15px;
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
                <p class="sub-title text-primary">Update worker Details</p>
            </div>
        </div>
        <div class="mt-3" id="table">
            <form id="createForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="First Name">First Name</label>
                            <input type="text" name="fname" class="form-control" id="First Name" aria-describedby="fname" placeholder="Enter First Name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="number" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Division">Division</label>
                            <select class="form-control" name="division" id="division" onchange="UpdateWorker()">
                                <option value="">Select</option>
                                <?php
                                foreach ($getAllDivisions as $divisions) {
                                ?>
                                    <option value="<?php echo $divisions->division; ?>">
                                        <?php echo $divisions->division; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subDivision">Sub Division</label>
                            <select class="form-control" name="subDivision" id="subDivision" onchange="getAllSections(subDivision.value)">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select class="form-control" name="section" id="section">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" name="password" class="form-control" id="Password" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="confPassword">Confirm Password</label>
                            <input type="password" name="confPassword" class="form-control" id="confPassword" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
    </div>
</body>

</html>


<script>
    function UpdateWorker() {
        let division = document.getElementById('division').value;
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            let subDivision = document.getElementById('subDivision');
            subDivision.innerHTML = '';
            document.getElementById('section').innerHTML = '';
            $data = JSON.parse(this.responseText);
            $data.forEach((element, i) => {
                var opt = document.createElement('option');
                opt.value = element.subDivision;
                opt.innerHTML = element.subDivision;
                subDivision.appendChild(opt);
            });
        }
        xhr.open('GET', '<?php echo site_url('Division/getsubdivisions/'); ?>' + division);
        xhr.send();
    }

    function getAllSections(value) {
        let subDivision = value;
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            let section = document.getElementById('section');
            section.innerHTML = '';
            $data = JSON.parse(this.responseText);
            $data.forEach((element, i) => {
                var opt = document.createElement('option');
                opt.value = element.section;
                opt.innerHTML = element.section;
                section.appendChild(opt);
            });
        }
        xhr.open('GET', '<?php echo site_url('Division/getsections/'); ?>' + subDivision);
        xhr.send();
    }
</script>

<script>
    document.querySelector("#createForm").addEventListener("submit", function(e) {
        e.preventDefault();
        let password = document.getElementById('Password').value;
        let confPassword = document.getElementById('confPassword').value;
        if (password === confPassword) {
            const xhr = new XMLHttpRequest();
            const formElements = document.forms.createForm;
            const formData = new FormData(formElements);
            xhr.onload = function() {
                let data = JSON.parse(this.responseText);
                let msg;
                alert('User Has Been Created Successfully!');
                document.location = '<?php echo site_url('register') ?>';
            }
            xhr.open('POST', '<?php echo site_url('Register/create'); ?>');
            xhr.send(formData);
        } else {
            alert("Passwords are not matching");
        }
    });
</script>