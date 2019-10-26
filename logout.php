<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="css/bootstrap-pulse.css" rel="stylesheet">
    <title>Home</title>

</head>
<body>
<div class="container">
    <main role="main">
        <div class="jumbotron">
            <div class="col-sm-8 mx-auto">
                <h3>You are now logged out</h3>
                <p>You have logged out and will be redirected to our homepage in a few seconds</p>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    (function () {
        $.get('service/logout.php', function (data) {
            if (data) {
                let locHref = location.href;
                let siteRoot = locHref.substring(0, locHref.lastIndexOf('/'));
                let homePageLink = siteRoot + '/index.php?indexActive=true';
                window.location.replace(homePageLink);
            }
        });
    })();
</script>
</body>
</html>