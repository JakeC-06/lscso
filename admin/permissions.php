<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['adminperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Updated Successfully!</div>';
}

$permissions = $pdo->query("SELECT * FROM permissions WHERE ID='1'");

foreach($permissions as $row)
{
    $application_perms = $row['application'];
    $ban_perms = $row['ban'];
    $gallery_perms = $row['gallery'];
    $settings_perms = $row['settings'];
    $nav_perms = $row['nav'];
    $pages_perms = $row['pages'];
    $rules_perms = $row['rules'];
    $team_perms = $row['team'];
    $response_perms = $row['response'];
    $board_perms = $row['boards'];
    $feedback_perms = $row['feedback'];
}
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

        <title><?php echo $serverName; ?> | Admin - Permissions</title>

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
                    <span class="sub-text text-center">Permissions</span>
                </div>
            </div>
        </div>

        <section class="pt-50 pb-100 white-container">
            <div class="container admin-container">
                <?php include "menu.inc.php"; ?>
                <hr style="color: black;">

                <div class="row pb-15">
                <?php if($actionMessage){echo $actionMessage;} ?>
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Update Permission</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="application_perms">Application Perms</label>
                                        <input type="text" name="application_perms" class="form-control" value="<?php echo $application_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ban_perms">Ban Perms</label>
                                        <input type="text" name="ban_perms" class="form-control" value="<?php echo $ban_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="gallery_perms">Gallery Perms</label>
                                        <input type="text" name="gallery_perms" class="form-control" value="<?php echo $gallery_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="settings_perms">Main Settings Perms</label>
                                        <input type="text" name="settings_perms" class="form-control" value="<?php echo $settings_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nav_perms">Nav Menu Perms</label>
                                        <input type="text" name="nav_perms" class="form-control" value="<?php echo $nav_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="pages_perms">Custom Pages Perms</label>
                                        <input type="text" name="pages_perms" class="form-control" value="<?php echo $pages_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rules_perms">Rules Perms</label>
                                        <input type="text" name="rules_perms" class="form-control" value="<?php echo $rules_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="team_perms">Team Perms</label>
                                        <input type="text" name="team_perms" class="form-control" value="<?php echo $team_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="response_perms">Application Response Perms</label>
                                        <input type="text" name="response_perms" class="form-control" value="<?php echo $response_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="board_perms">Board Perms</label>
                                        <input type="text" name="board_perms" class="form-control" value="<?php echo $board_perms; ?>" placeholder="Eg. roleid1, roleid2">
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <button class="btn btn-outline-info" type="submit" name="update_permission">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

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