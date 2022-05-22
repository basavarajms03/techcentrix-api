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
        }
    </style>
</head>

<body>
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
                    <a class="nav-link" href="<?php echo site_url('breakdownpoints') ?>">Breakdown Points</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="mt-3">
        <div id="table"></div>
    </div>
</body>

</html>

<script>
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        let table = '<table class="table table-striped mt-3">' + '<tr><td>Serial Number</td><td>RMU Name</td><td>Date</td><td>Name Plate Photo</td><td>Before Work Photo</td><td>Work In Progress</td><td>Work Completed</td></tr>';
        let tableBody = [];
        for (let index = 0; index < data['result'].length; index++) {
            const element = data['result'][index];
            data['result'][index]['Before_work_photo'] = data['result'][index]['Before_work_photo'].split(',');
            data['result'][index]['after_work_photo_progress'] = data['result'][index]['after_work_photo_progress'].split(',');
            data['result'][index]['work_completes_photo'] = data['result'][index]['work_completes_photo'].split(',');
            tableBody.push('<tr><td>' + element['SINO'] +'</td><td>' + element['RMUName']  +'</td><td>'+element['date']+'</td><td>'+element['namePlatePhoto']+'</td><td><img width="100px" src="'+ window.location.href.split('/public')[0] + '/' + element['work_completes_photo'][0]+'" /></td><td><img width="100px" src="'+ window.location.href.split('/public')[0] + '/' + element['after_work_photo_progress'][0]+'" /></td><td><img width="100px" src="'+ window.location.href.split('/public')[0] + '/' + element['work_completes_photo'][0]+'" /></td></tr>');
        }
        document.getElementById('table').innerHTML = table + '' + tableBody;
    }
    xhr.open('GET', '<?php echo site_url('BreakdownPoints/getallbreakdownpoints'); ?>');
    xhr.send();
</script>