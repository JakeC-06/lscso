<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['teamperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$team = $pdo->query("SELECT * FROM team WHERE type='category' ORDER BY position ASC");
$team2 = $pdo->query("SELECT * FROM team WHERE type='member'");
$team3 = $pdo->query("SELECT * FROM team WHERE type='category'");
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

        <title><?php echo $serverName; ?> | Admin - Team</title>

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
                    <span class="sub-text text-center">Team</span>
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
                            <h2>Add Team Category</h2>
                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="team_category">Category Name</label>
                                        <input type="text" name="team_category" class="form-control" placeholder="Eg. Staff" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="team_position">Position</label>
                                        <input type="number" name="team_position" class="form-control" placeholder="Eg. 1" required>
                                    </div>
                                </div>
                                <button class="btn btn-outline-info" type="submit" name="add_team">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Current Team Categories</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>Position</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach($team as $row)
                                        {
                                          echo '<tr>
                                                <td class="table-text">'.$row['name'].'</td>
                                                <td class="table-text">'.$row['position'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteTeam(`'.$row['ID'].'`)">Delete</a></td>
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
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Add Team Member</h2>
                            <form action="../actions/functions.php"  method="post">
                            <div class="row">    
                                <div class="form-group col-md-6">
                                    <label for="team_name">Name</label>
                                    <input type="text" name="team_name" class="form-control" placeholder="Eg. Hamz" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="team_discordid">Discord ID</label>
                                    <input type="text" name="team_discordid" class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="team_memberCategory">Category</label>
                                    <select class="form-control" name="team_memberCategory">
                                        <?php
                                        foreach($team3 as $row)
                                        {
                                            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                                <button class="btn btn-outline-info" type="submit" name="add_team">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Current Team Members</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>Discord ID</td>
                                            <td>Category</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach($team2 as $row)
                                        {
                                          echo '<tr>
                                                <td class="table-text">'.$row['name'].'</td>
                                                <td class="table-text">'.$row['discordid'].'</td>
                                                <td class="table-text">'.$row['category'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteTeam(`'.$row['ID'].'`)">Delete</a></td>
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
		function deleteTeam(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deleteteam : id, token : document.getElementById("token").value },
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
        <script src="../assets/js/parallax.min.js"></script>
        <script src="../assets/js/magnific-popup.min.js"></script>
        <script src="../assets/js/meanmenu.min.js"></script>
        <script src="../assets/js/fancybox.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>