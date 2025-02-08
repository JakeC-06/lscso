<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");
require_once(__DIR__ . "/../actions/discord_functions.php");
checkBan();
$_SESSION['userq'] = "";
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (empty($_SESSION['logged_in']))
{
	header('Location: '.BASE_URL.'/actions/register.php');
}

if(isset($_GET['success']))
{
    $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 50px; text-align: center; font-size: 18px;" role="alert">Application Submitted Successfully!</div>';
}

$applicationViewId = $pdo->query("SELECT * FROM application");
foreach ($applicationViewId as $row)
{
    if (checkWhitelist($_SESSION['user_discordid'], $row['viewid']) == true) {
        $viewresponses = true;
    } else {
        // Doesnt have roles to view any applications.
    }
}
if ($_SESSION['responseperms'] == 1 || $viewresponses == true) {

} else {
    header('Location: '.BASE_URL.'/applications/index.php');
}


$application_responses = $pdo->query("SELECT * FROM application_response");
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

        <title><?php echo $serverName; ?> | Responses</title>

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

            .dataTables_filter {
                padding-bottom: 20px !important;
                text-align: center !important;
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
                    <span class="main-section-title text-center">Responses</span>
                </div>
            </div>
        </div>
        <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <section class="pt-50 pb-100 white-container">
            <div class="container admin-container">
                <div class="row pb-15">
                <?php if($actionMessage){echo $actionMessage;} ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="login-form">
                            <h2 class="text-center">Search User</h2>

                            <form autocomplete="off" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Discord ID or Name" onkeyup="showResult(this.value)">
                                </div>
                                <div id="formsearch"></div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['userq']))
                    {
                        $searchDiscordID = $_GET['userq'];
                        $result = $pdo->prepare("SELECT * FROM users WHERE discordid=?");
                        $result->execute([$searchDiscordID]);
                        foreach($result as $row)
                        {
                            $name = $row['name'];
                            $identifier = " | ".$row['identifier'];
                        }
                        if ($identifier == " | ") {
                            $identifier = "";
                        }

                        $result2 = $pdo->prepare("SELECT * FROM application_response WHERE discordID=?");
                        $result2->execute([$searchDiscordID]);
                    ?>
                    <?php
                    }
                    ?>
                </div>
                <div class="row pb-15">
                    <?php
                    if (isset($_GET['userq']))
                    {
                    ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2 class="text-center" style="margin: 0;">Submitted Applications</h2>
                            <p style="text-align: center; padding-top: 10px; font-size: 18px; font-weight: 600;"><?php echo $name.$identifier; ?></p>
                            <hr>
                            <br>
                            <?php
                            foreach($result2 as $row)
                            {
                                $applicationID = $row['applicationID'];
                                $date = $row['date'];
                                $status = $row['status'];
                                $result3 = $pdo->prepare("SELECT * FROM application WHERE ID=?");
                                $result3->execute([$applicationID]);
                                foreach($result3 as $row2)
                                {
                                    $title = $row2['title'];
                                    $viewid = $row2['viewid'];
                                }

                                if ($_SESSION['responseperms'] == 1 || checkWhitelist($_SESSION['user_discordid'], $viewid) == true) {
                                    if ($status == "Pending") {
                                        echo '<div class="text-center"><a class="btn btn-outline-warning" href="responses.php?userq='.$searchDiscordID.'&formq='.$row['ID'].'">'.$title." | ".$date.'</a></div><br>';
                                    }
                                    if ($status == "Viewed") {
                                        echo '<div class="text-center"><a class="btn btn-outline-info" href="responses.php?userq='.$searchDiscordID.'&formq='.$row['ID'].'">'.$title." | ".$date.'</a></div><br>';
                                    }
                                    if ($status == "Approved") {
                                        echo '<div class="text-center"><a class="btn btn-outline-success" href="responses.php?userq='.$searchDiscordID.'&formq='.$row['ID'].'">'.$title." | ".$date.'</a></div><br>';
                                    }
                                    if ($status == "Denied") {
                                        echo '<div class="text-center"><a class="btn btn-outline-danger" href="responses.php?userq='.$searchDiscordID.'&formq='.$row['ID'].'">'.$title." | ".$date.'</a></div><br>';
                                    }
                                }
                            }

                            if (empty($title)) {
                                echo '<div class="text-center"><span class="text-warning">No Submitted Applications</span></div>';
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    }

                if (isset($_GET['formq']))
                {
                    $formID = $_GET['formq'];
                    $result4 = $pdo->prepare("SELECT * FROM application_response WHERE ID=?");
                    $result4->execute([$formID]);
                    foreach($result4 as $row)
                    {
                        $responseID = $row['ID'];
                        $form_applicationID = $row['applicationID'];
                        $form_answer = $row['answer'];
                        $form_date = $row['date'];
                        $form_status = $row['status'];
                    }
                    if ($form_status == "Pending") {
                        $form_statusColor = "warning";
                    } else if ($form_status == "Viewed") {
                        $form_statusColor = "info";
                    } else if ($form_status == "Approved") {
                        $form_statusColor = "success";
                    } else if ($form_status == "Denied") {
                        $form_statusColor = "danger";
                    }

                    $result5 = $pdo->prepare("SELECT * FROM application WHERE ID=?");
                    $result5->execute([$form_applicationID]);
                    foreach($result5 as $row)
                    {
                        $form_title = $row['title'];
                    }

                    $answer_array = json_decode($form_answer, true);

                    $stmt = $pdo->prepare("SELECT * FROM application_comments WHERE responseID=?");
                    $stmt->execute([$responseID]);
                    $comments = $stmt->fetchAll();
                ?>
                    <div class="col-md-6">
                        <div class="login-form">
                            <h2 class="text-center"><?php echo $form_title." | ".$form_date; ?></h2>
                            <hr>
                            <?php
                            foreach($answer_array as $key => $value)
                            {
                                echo "<b>".$key."</b><br>".$value."<br><br>";
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <p class="btn btn-outline-info" style="margin-top: 25px;" data-bs-toggle="modal" data-bs-target="#comments">Comments</p>
                                </div>
                                <div class="col-md-8">
                                    <p class="text-center" style="font-size: 18px; font-weight: 600;">Current Status: <span class="text-<?php echo $form_statusColor; ?>"><?php echo $form_status; ?></span></p>
                                    <select class="form-control" onchange="updateStatus(<?php echo $formID; ?>, this.value)">
                                        <option value="<?php echo $form_status; ?>"><?php echo $form_status; ?></option>
                                        <option value="Pending">Pending</option>
                                        <option value="Viewed">Viewed</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Denied">Denied</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="comments" tabindex="-1" role="dialog">
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

                                    <div class="col-md-8" style="text-align: left !important; padding-bottom: 10px;">
                                        '.$comment.'<br>

                                        <span class="text-muted" style="font-size: 15px;">'.$commentName.' <i style="font-size: 12px; padding: 1em;"> '.$commentDatePosted.'</i></span>
                                    </div>
                                ';

                                echo '<div class="col-md-2">
                                        <button class="btn btn-outline-danger" style="float: right;" onClick="deleteComment(`'.$row['ID'].'`)"><i class="bi bi-trash"></i></button>
                                    </div>';

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

                            echo '</div><div class="row justify-content-center">
                                    <div class="col-md-12" style="padding-top: 55px;">
                                        <input type="text" name="comment" id="comment" class="form-control" placeholder="Leave a comment">
                                    </div>
                                    <div class="col-md-3" style="padding-top: 10px; padding-bottom: 20px;">
                                        <button onClick="addComment('.$responseID.')" class="btn btn-info">Comment</button>
                                    </div>
                                </div>';
                            ?>
                        </div>
                        </div>
                    </div>
                    </div>
                <?php
                }
                ?>
                </div>
                <div class="row pb-15">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 class="text-center">Recently Submitted Applications</h2>
                            <div class="table-responsive">
                            <table id="basic-datatable" class="table table-dark table-responsive nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Discord ID</th>
                                        <th>Application Title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($application_responses as $row)
                                {
                                    $recent_ID = $row['ID'];
                                    $recent_applicationID = $row['applicationID'];
                                    $recent_discordID = $row['discordID'];
                                    $recent_date = $row['date'];
                                    $recent_status = $row['status'];
                                    if ($recent_status == "Pending") {
                                        $statusColor = "warning";
                                    } else if ($recent_status == "Viewed") {
                                        $statusColor = "info";
                                    } else if ($recent_status == "Approved") {
                                        $statusColor = "success";
                                    } else if ($recent_status == "Denied") {
                                        $statusColor = "danger";
                                    }

                                    $result6 = $pdo->prepare("SELECT * FROM application WHERE ID=?");
                                    $result6->execute([$recent_applicationID]);
                                    foreach($result6 as $row2)
                                    {
                                        $recent_title = $row2['title'];
                                        $recent_viewid = $row2['viewid'];
                                    }

                                    $result7 = $pdo->prepare("SELECT * FROM users WHERE discordid=?");
                                    $result7->execute([$recent_discordID]);
                                    foreach($result7 as $row2)
                                    {
                                        $recent_name = $row2['name'];
                                        $recent_identifier = " | ".$row2['identifier'];
                                    }
                                    if ($recent_identifier == " | ") {
                                        $recent_identifier = "";
                                    }

                                    if ($_SESSION['responseperms'] == 1 || checkWhitelist($_SESSION['user_discordid'], $recent_viewid) == true) {
                                        echo '<tr><td>'.$recent_name.$recent_identifier.'</td>';
                                        echo '<td>'.$recent_discordID.'</td>';
                                        echo '<td>'.$recent_title.'</td>';
                                        echo '<td>'.$recent_date.'</td>';
                                        echo '<td class="text-'.$statusColor.'"">'.$recent_status.'</td>';
                                        echo '<td><a href="responses.php?userq='.$recent_discordID.'&formq='.$recent_ID.'" class="btn btn-outline-info">View</a></td>';
                                        echo '<td><a onclick="deleteResponse(`'.$row['ID'].'`)" class="btn btn-outline-danger">Delete</a></td>';
                                        echo '</tr>';
                                    }
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
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/magnific-popup.min.js"></script>
        <script src="../assets/js/parallax.min.js"></script>
        <script src="../assets/js/meanmenu.min.js"></script>
        <script src="../assets/js/fancybox.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/datatables/dataTables.bootstrap4.js"></script>
        <script src="../assets/js/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/js/datatables/responsive.bootstrap4.min.js"></script>
        <script src="../assets/js/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/js/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/js/datatables/buttons.html5.min.js"></script>
        <script src="../assets/js/datatables/buttons.flash.min.js"></script>
        <script src="../assets/js/datatables/buttons.print.min.js"></script>
        <script src="../assets/js/datatables/dataTables.keyTable.min.js"></script>
        <script src="../assets/js/datatables/dataTables.select.min.js"></script>
        <script src="../assets/js/datatables.init.js"></script>
        <script>
		function showResult(str) {
            if (str.length==0) {
                document.getElementById("formsearch").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("formsearch").innerHTML = this.responseText;
                }
            }

            xmlhttp.open("GET", "../actions/functions.php?searchuser=" + str, true);
            xmlhttp.send();
        }

		function deleteResponse(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deleteresponse : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});

		}

        function updateStatus(id, that) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { updatestatus : id, updateto: that, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function addComment(id)
        {
            $.ajax({
                url: '../actions/functions.php',
                type: 'POST',
                data: {addcomment: id, type: "application", comment: document.getElementById("comment").value, token : document.getElementById("token").value},
                success: function(res)
                {
                    location.reload();
                }
            });
        }

        function deleteComment(id)
        {
            $.ajax({
                url: '../actions/functions.php',
                type: 'POST',
                data: {deleteComment: true, type: "application", id: id},
                success: function(data)
                {
                    location.reload();
                }
            });
        }
        </script>
    </body>
</html>