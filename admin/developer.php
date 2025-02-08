<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['mainadminperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

$actionMessage = "";

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
    $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Action Successful!</div>';
}

$board = $pdo->query("SELECT * FROM boards ORDER BY boardorder ASC");
$feedbackType = $pdo->query("SELECT * FROM feedback_type");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="../assets/css/boxicons.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <title><?php echo $serverName; ?> | Admin - Developer Settings</title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

    </head>

    <body>

        <!-- NAVBAR -->
        <?php include "../includes/navbar.inc.php"; ?>

        <!-- MAIN -->
        <div class="hero-banner-area" id="home">
            <div class="container">
                <div class="row justify-content-center">
                    <span class="main-section-title text-center">Admin</span>
                    <span class="sub-text text-center">Developer Settings</span>
                </div>
            </div>
        </div>

        <section class="faq-area pt-50 pb-100 white-container">
            <?php
            if (!empty($_SESSION['settingsperms']))
            {
            ?>
            <div class="container">
                <?php include "menu.inc.php"; ?>
                <?php if($actionMessage){echo $actionMessage;} ?>
                <hr style="color: black;">

                <div class="row" id="develoeprBoard">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Developer Board</h2>

                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="board_name">Board Name</label>
                                        <input type="text" name="board_name" class="form-control" placeholder="Eg. In-Progress" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="board_order">Board Order</label>
                                        <input type="text" name="board_order" class="form-control" placeholder="Eg. 1" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="addboard">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Boards</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>Order</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($board as $row)
                                        {
                                            // display the results
                                          echo '<tr>
                                                <td class="table-text">'.$row['name'].'</td>
                                                <td class="table-text">'.$row['boardorder'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteBoard(`'.$row['id'].'`)">Delete</a></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" id="feedbackPerms">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Feedback Types</h2>

                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="type">Types</label>
                                        <input type="text" name="type" class="form-control" placeholder="Eg. Vehicle Suggestion" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="addType">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Types</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Types</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($feedbackType as $row)
                                        {
                                            // display the results
                                          echo '<tr>
                                                <td style="padding-top: 15px;"><span class="badge badge-pill bg-secondary">'.$row['type'].'</span></td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteType(`'.$row['id'].'`)">Delete</a></td>
                                                </tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } else {
                echo '<div class="container"><h3 style="text-align: center; color: black;">Please choose a menu option: '.$_SESSION['banperms'].'</h3>';
                include "menu.inc.php";
                echo'</div>';
            }
            ?>
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

        <!-- JS -->
        <script>
        function deleteBoard(id) {
            // send the data to the server
            $.ajax({
                type : "POST",
                url  : "../actions/functions.php",
                data : { deleteboard : true, id : id, token : document.getElementById("token").value },
                success: function(res){
                            // success
                            location.reload();
                        }
            });
        }

        function deleteType(id)
        {
            $.ajax({
                type : "POST",
                url  : "../actions/functions.php",
                data : { deleteType : true, id : id, token : document.getElementById("token").value },
                success: function(res){
                            // success
                            location.reload();
                        }
            });
        }

        </script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/magnific-popup.min.js"></script>
        <script src="../assets/js/parallax.min.js"></script>
        <script src="../assets/js/meanmenu.min.js"></script>
        <script src="../assets/js/fancybox.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>

