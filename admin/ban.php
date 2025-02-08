<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['banperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}


// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$bans = $pdo->query("SELECT * FROM bans");
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

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <title><?php echo $serverName; ?> | Admin - Bans</title>

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
                    <span class="sub-text text-center">Bans</span>
                </div>
            </div>
        </div>

        <section class="pt-50 pb-100 white-container">
            <div class="container admin-container">
                <?php include "menu.inc.php"; ?>
                <hr style="color: black;">

                <div class="row pb-15">
                <?php if($actionMessage){echo $actionMessage;} ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Add Ban</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="ban_discordid">Discord ID</label>
                                        <input type="text" name="ban_discordid" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ban_name">Name Known By</label>
                                        <input type="text" name="ban_name" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="ban_reason">Reason</label>
                                        <input type="text" name="ban_reason" class="form-control" placeholder="" required>
                                    </div>
                                </div>

                                <button class="btn btn-outline-info" type="submit" name="add_ban">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Current Bans</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Discord ID</td>
                                            <td>Name</td>
                                            <td>Reason</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach($bans as $row)
                                        {
                                          echo '<tr>
                                                <td class="table-text">'.$row['discordid'].'</td>
                                                <td class="table-text">'.$row['name'].'</td>
                                                <td class="table-text">'.$row['reason'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteBan(`'.$row['ID'].'`)">Delete</a></td>
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
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

        <!-- JS -->
        <script>
		function deleteBan(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deleteban : id, token : document.getElementById("token").value },
					success: function(res){  
								// success
								location.reload();
							}
        	});

		}
        </script>

        <!-- JS -->
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