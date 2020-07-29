        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <ul class="navbar-nav">

                    <?php
                    
                    if (isset($_SESSION['login'])) {
                        if($_SESSION['statut'] =="admin")
                        {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?admin">Administration</a>
                        </li>
                    <?php
                        }
                    ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?logout">Logout</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?login">Login</a>
                        </li>

                    <?php
                    }
                    ?>


                </ul>
            </div>
        </nav>
        <!-- END NAVBAR -->