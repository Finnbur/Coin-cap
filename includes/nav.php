<?php 
// Get the current filename
$activePage = basename($_SERVER['PHP_SELF']); 
?>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="https://coincap.io/static/logos/banner.png" alt="Logo" width="40" height="40">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="index.php" class="nav-link px-2 <?php echo ($activePage == 'index.php') ? 'text-secondary' : 'text-white'; ?>">Home</a>
                </li>
                <li>
                    <a href="exchanges.php" class="nav-link px-2 <?php echo ($activePage == 'exchanges.php') ? 'text-secondary' : 'text-white'; ?>">Exchanges</a>
                </li>
                <li>
                    <a href="news.php" class="nav-link px-2 <?php echo ($activePage == 'news.php') ? 'text-secondary' : 'text-white'; ?>">Crypto news</a>
                </li>
                <?php if(isset($_SESSION['loggedIn'])) { ?>
                    <li>
                        <a href="cryptoportfolio.php" class="nav-link px-2 <?php echo ($activePage == 'cryptoportfolio.php') ? 'text-secondary' : 'text-white'; ?>">Crypto portfolio</a>
                    </li>
                <?php } ?>
            </ul>

            <div class="text-end">
                <?php if(!isset($_SESSION['loggedIn'])) { ?>
                    <a class="btn btn-primary" href="login.php">Login</a>
                    <a class="btn btn-primary" href="register.php">Register</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>