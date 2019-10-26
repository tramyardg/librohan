<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
  <a class="navbar-brand" href="#"><?php echo $commonNameTitle['siteName']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
          aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo strlen($_GET['indexActive']) > 0 ? 'active' : ''; ?>">
              <a class="nav-link" href="index.php?indexActive=true">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php if (isset($_SESSION["customer"])) { ?>
            <li class="nav-item <?php echo strlen($_GET['cartActive']) > 0 ? 'active' : ''; ?>">
              <a class="nav-link" href="cart.php?cartActive=true">Cart<span class="sr-only"></span></a>
            </li>
            <li class="nav-item <?php echo strlen($_GET['ordersActive']) > 0 ? 'active' : ''; ?>">
              <a class="nav-link" href="orders.php?ordersActive=true">My Orders<span class="sr-only"></span></a>
            </li>
          <?php } ?>
      </ul>
      <ul class="nav my-2 my-md-0">
          <li class="dropdown">
              <?php if (isset($_SESSION["customer"])) { ?>
              <a class="nav-link pl-0 dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Hello, <?php echo $customer->getCustomerName(); ?></a>
              <?php } else { ?>
              <a class="nav-link pl-0 dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Hello, Sign in</a>
              <?php } ?>
              <div class="dropdown-menu">
                  <?php if (isset($_SESSION["customer"])) { ?>
                  <a class="dropdown-item" href="#"><i class="mr-2" data-feather="shopping-cart"></i>Cart</a>
                  <a class="dropdown-item" href="logout.php"><i class="mr-2" data-feather="log-out"></i>Log out</a>
                  <?php } ?>
                  <?php if (!isset($_SESSION["customer"])) { ?>
                  <a class="dropdown-item" href="login.php"><i class="mr-2" data-feather="log-in"></i>Log in</a>
                  <a class="dropdown-item" href="create-account.php"><i class="mr-2" data-feather="user-plus"></i>Register</a>
                  <?php } ?>
              </div>
          </li>
      </ul>
  </div>
</nav>