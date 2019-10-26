<ul class="nav my-2 my-md-0">
    <li class="dropdown">
        <?php if (isset($_SESSION["employee"])) { ?>
            <a class="nav-link pl-0 dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Hello, <?php echo $employee->getEmpName(); ?></a>
        <?php } else { ?>
            <a class="nav-link pl-0 dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Hello, Sign in</a>
        <?php } ?>
        <div class="dropdown-menu">
            <?php if (isset($_SESSION["employee"])) { ?>
                <a class="dropdown-item btn-success" href="#">
                    <i class="mr-2" data-feather="user-check"></i>
                    Your account
                </a>
            <?php } ?>
            <?php if (!isset($_SESSION["employee"])) { ?>
                <a class="dropdown-item" href="login.php">
                    <i class="mr-2" data-feather="log-in"></i>
                    Log in
                </a>
            <?php } ?>
            <?php if (isset($_SESSION["employee"])) { ?>
                <a class="dropdown-item" href="logout.php">
                    <i class="mr-2" data-feather="log-out"></i>
                    Log out
                </a>
            <?php } ?>
            <?php if (!isset($_SESSION["employee"])) { ?>
                <a class="dropdown-item" href="create-account.php">
                    <i class="mr-2" data-feather="user-plus"></i>
                    Register
                </a>
            <?php } ?>
        </div>
    </li>
</ul>
