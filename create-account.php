<?php
$commonNameTitle = parse_ini_file("./common.ini");

ob_start();
session_start();
if (isset($_SESSION["customer"]))
{
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="css/bootstrap-pulse.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <title>Create New Account</title>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#"><?php echo $commonNameTitle['siteName']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
            </ul>
            <ul class="nav my-2 my-md-0">
                <li class="dropdown">
                    <a class="nav-link pl-0 dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Hello, Sign in</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="mr-2" data-feather="shopping-cart"></i>Cart</a>
                        <a class="dropdown-item" href="login.php"><i class="mr-2" data-feather="log-in"></i>Log in</a>
                        <a class="dropdown-item" href="create-account.php"><i class="mr-2" data-feather="user-plus"></i>Register</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main">
        <div class="alert alert-success d-none" id="successMessage" role="alert">
            Registration successful. You can now log in.
            <hr/>
            Refreshing the page in <span class="badge badge-light" id="refreshSeconds"></span> seconds.
        </div>
        <div class="jumbotron">
            <h3 class="text-center">Customer Registration</h3>
            <div class="col-sm-8 mx-auto">
                <form class="needs-validation" id="registerForm" novalidate>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" aria-describedby="fullNameHelp"
                               placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email Address</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                               placeholder="Enter email" required>
                        <div class="invalid-feedback">
                            Please use a valid email.
                        </div>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone">Phone number</label>
                        <input type="text" class="form-control" id="inputPhone" aria-describedby="phoneHelp"
                               placeholder="(514) 111-2222" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputProvince">Province</label>
                            <select id="inputProvince" class="form-control">
                                <option value="">Choose province</option>
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NU">Nunavut</option>
                                <option value="YT">Yukon</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" value="admin123" class="form-control" id="inputPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPassword">Confirm Password</label>
                        <input type="password" value="admin123" class="form-control" id="inputConfirmPassword" >
                        <div class="invalid-feedback">
                            Password not match.
                        </div>
                    </div>
                    <div class="form-group d-none">
                        <label for="registerAs"></label>
                        <input type="text" class="form-control" id="registerAs" value="customer">
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-success" id="inputRegister" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<script>
    feather.replace();
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script src="js/util.js"></script>
<script src="js/register.js"></script>
</body>
</html>