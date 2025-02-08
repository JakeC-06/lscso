<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");
require_once(__DIR__ . "/../actions/discord_functions.php");
checkBan();

if (empty($_SESSION['logged_in']))
{
	header('Location: '.BASE_URL.'/actions/register.php');
}

if(isset($_GET['success']))
{
    $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 50px; text-align: center; font-size: 18px;" role="alert">Application Submitted Successfully!</div>';
}

$user_discordid = $_SESSION['user_discordid'];

$applications = $pdo->query("SELECT * FROM application");
$applicationViewId = $pdo->query("SELECT * FROM application");
foreach ($applicationViewId as $row)
{
    if (checkWhitelist($_SESSION['user_discordid'], $row['viewid']) == true) {
        $viewresponses = true;
    } else {
        // Doesnt have roles to view any applications.
    }
}
$application_response = $pdo->prepare("SELECT * FROM application_response WHERE discordID=?");
$application_response->execute([$user_discordid]);

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

        <title><?php echo $serverName; ?> | Applications</title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

        <style>
            .custom-btn {
                padding: 15px;
                font-weight: 500;
                font-size: 20px;
            }
        </style>
    </head>

    <body>

        <!-- NAVBAR -->
        <?php include "../includes/navbar.inc.php"; ?>

        <!-- MAIN -->
        <div class="hero-banner-area" id="home">
            <div class="container">
                <div class="row justify-content-center">
                    <span class="main-section-title text-center">Applications</span>
                    <?php
                    if ($_SESSION['responseperms'] == 1 || $viewresponses == true) {
                    ?>
                    <div class="col-md-3 text-center">
                        <a href="responses.php" class="btn btn-outline-light" style="margin-top: 20px;">Application Responses</a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <section class="faq-area white-container">
            <div class="pt-50 pb-100 container">
                <div class="row justify-content-center">
                <?php if($actionMessage){echo $actionMessage;} ?>
                    <div class="col-md-6 text-center" style="margin-top: 25px;">
                    <div class="login-form">
                        <h4>Current Applications:</h4>
                        <br>
                    <?php
                    foreach($applications as $row)
                    {
                        $whitelistid = preg_replace('/\s+/', '', $row['whitelistid']);
                        if (!empty($whitelistid)) {
                            if (checkWhitelist($_SESSION['user_discordid'], $whitelistid) == true) {
                                $whitelisted = true;
                            } else {
                                $whitelisted = false;
                            }
                        } else {
                            $whitelisted = true;
                        }

                        if ($whitelisted == true) {
                            if ($row['hide'] == 0) {
                                if ($row['status'] == 1) {
                                    echo '<a href="form.php?id='.$row['ID'].'" class="btn btn-outline-light custom-btn">'.$row['title'].'</a><br><br>';
                                } else {
                                    echo '<a class="btn btn-outline-light custom-btn">'.$row['title'].' | Status: <span style="color: orange;">Closed</span></a><br><br>';
                                }
                            }
                        }
                    }
                    ?>
                    </div>
                    </div>
                    <div class="col-md-6 text-center" style="margin-top: 25px;">
                    <div class="login-form">
                        <h4>Your Submitted Applications:</h4>
                        <div class="table-responsive">
                            <table class="table table-dark text-center">
                                <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>Status</td>
                                        <td>Date</td>
                                        <td>Comments</td>
                                        <td>Application</td>
                                    </tr>
                                    <?php
                                    foreach ($application_response as $row)
                                    {
                                        $responseID = $row['ID'];
                                        $applicationID = $row['applicationID'];
                                        $date = $row['date'];
                                        $status = $row['status'];
                                        $answer = $row['answer'];
                                        $answer_array = json_decode($answer, true);

                                        if ($status == "Pending") {
                                            $statusColor = "warning";
                                        } else if ($status == "Viewed") {
                                            $statusColor = "info";
                                        } else if ($status == "Approved") {
                                            $statusColor = "success";
                                        } else if ($status == "Denied") {
                                            $statusColor = "danger";
                                        }

                                        $applicationTitle = $pdo->prepare("SELECT * FROM application WHERE ID=?");
                                        $applicationTitle->execute([$applicationID]);
                                        foreach($applicationTitle as $row2)
                                        {
                                            $title = $row2['title'];
                                        }

                                        $stmt = $pdo->prepare("SELECT * FROM application_comments WHERE responseID=?");
                                        $stmt->execute([$responseID]);
                                        $comments = $stmt->fetchAll();

                                        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $modalstr = '';
                                        for ($i = 0; $i < 10; $i++) {
                                            $modalstr .= $characters[rand(0, $charactersLength - 1)];
                                            $commentstr .= $characters[rand(0, $charactersLength - 1)];
                                        }

                                        echo '<tr>
                                            <td class="table-text">'.$title.'</td>
                                            <td class="table-text text-'.$statusColor.'">'.$status.'</td>
                                            <td class="table-text">'.$date.'</td>
                                            <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$commentstr.'">View</a></td>
                                            <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">View</a></td>
                                            </tr>';
                                    ?>
                                    <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body text-left">
                                        <?php
                                        foreach($answer_array as $key => $value)
                                        {
                                            echo "<b>".$key."</b><br>".$value."<br><br>";
                                        }
                                        ?>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="modal fade" id="<?php echo $commentstr; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body text-left">
                                        <?php
                                            echo '<hr><div class="row">';

                                        if (!empty($comments))
                                        {

                                        foreach($comments as $row)
                                        {
                                            $comment = $row['comment'];
                                            $commentDiscordID = $row['discordid'];
                                            $commentDatePosted = $row['datePosted'];

                                            $stmt = $pdo->prepare("SELECT * FROM users WHERE discordid=?");
                                            $stmt->execute([$commentDiscordID]);
                                            $commentuser = $stmt->fetchAll();

                                            foreach($commentuser as $row2)
                                            {
                                                $commentName = $row2['name'];
                                                $commentAvatar = $row2['avatar'];
                                            }

                                            echo '
                                                <div class="col-md-2">
                                                    <img class="rounded-circle" style="width: 80%; margin-left: auto; display: block; margin-right: auto;" src="'.$commentAvatar.'" alt="Avatar">
                                                </div>

                                                <div class="col-md-10" style="text-align: left !important; padding-bottom: 10px;">
                                                    '.$comment.'<br>

                                                    <span class="text-muted" style="font-size: 15px;">'.$commentName.' <i style="font-size: 12px; padding: 1em;"> '.$commentDatePosted.'</i></span>
                                                </div>
                                            ';

                                            echo '<hr><br>';
                                        }

                                        } else {
                                            echo '
                                                <div class="col-md-12" style="text-align: center !important; padding: 30px;">
                                                    <p class="text-muted" style="font-style: italic;">There are no comments yet.</p>
                                                </div>
                                            <hr><br>
                                            ';
                                        }

                                        echo '</div>';
                                        ?>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <br><br>
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