<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Publisher Sign-in</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href="css/publisher-signin.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" id="publisherSignInForm">
    <div class="alert alert-success d-none" id="successMessage" role="alert">
        Log in successful. You are being redirected in few <span class="badge badge-dark" id="refreshSeconds"></span> seconds.
    </div>
    <div class="alert alert-warning d-none" id="warningMessage" role="alert"></div>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputCompanyEmail" class="sr-only">Company email</label>
    <input type="text" id="inputCompanyEmail" class="form-control" placeholder="Company email" value="hbg@support.com" required autofocus>
    <label for="inputCompanyPassword" class="sr-only">Password</label>
    <input type="password" id="inputCompanyPassword" class="form-control" placeholder="Password" value="5wtFjM3olg" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/util.js"></script>
<script src="js/login.js"></script>
</body>
</html>
