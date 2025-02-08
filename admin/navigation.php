<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['navperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Updated Successfully!</div>';
}

$nav = $pdo->query("SELECT * FROM navigation ORDER BY position ASC");
$nav2 = $pdo->query("SELECT * FROM navigation WHERE type='dropdown'");

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

        <title><?php echo $serverName; ?> | Admin - Navigation</title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

        <style>
            .custom-form-nav {
                height: 40px !important;
                font-size: 13px !important;
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
                    <span class="main-section-title text-center">Admin</span>
                    <span class="sub-text text-center">Navigation</span>
                </div>
            </div>
        </div>
        <section class="faq-area pt-50 pb-100 white-container">
            <div class="container">
                <?php include "menu.inc.php"; ?>
                <hr style="color: black;">
                <div class="row">
                    <?php if($actionMessage){echo $actionMessage;} ?>
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 class="text-center">Add Navigation</h2>
                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-3 change-col change-col1">
                                        <label>Select Type</label>
                                        <select class="form-control custom-form-nav" name="nav_type" id="nav_type">
                                            <option value="button">Button</option>
                                            <option value="dropdown">Dropdown Category</option>
                                            <option value="dropdownoption">Dropdown Option</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 change-col change-col2">
                                        <label for="nav_text">Text</label>
                                        <input type="text" name="nav_text" class="form-control custom-form-nav" placeholder="Eg. Documents" required>
                                    </div>
                                    <div class="form-group col-md-3 change-col change-col3" id="nav_link">
                                        <label for="nav_link">Link</label>
                                        <input type="text" name="nav_link" class="form-control custom-form-nav" placeholder="Eg. google.com">
                                    </div>
                                    <div class="form-group col-md-3 change-col change-col4">
                                        <label for="nav_position">Position</label>
                                        <input type="number" name="nav_position" class="form-control custom-form-nav" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-3 change-col change-col5" id="nav_dropdownid" style="display: none;">
                                        <label for="nav_dropdownid">Dropdown Category</label>
                                        <select class="form-control custom-form-nav" name="nav_dropdownid">
                                            <?php
                                            foreach($nav2 as $row)
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['text'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_nav">Add</button>
                                </div>
                                <br>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Nav Links</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Type</td>
                                            <td>Text</td>
                                            <td>Link</td>
                                            <td>Position</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($nav as $row)
                                        {
                                            $dropdownID = $row['dropdownID'];
                                            $nav3 = $pdo->prepare("SELECT * FROM navigation WHERE ID=?");
                                            $nav3->execute([$dropdownID]);
                                            foreach ($nav3 as $row2)
                                            {
                                                $dropdownText = $row2['text'] ." -> ";
                                            }

                                            if ($row['type'] != "dropdownoption")
                                            {
                                                $dropdownText = "";
                                            }

                                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            $charactersLength = strlen($characters);
                                            $modalstr = '';
                                            for ($i = 0; $i < 10; $i++) {
                                                $modalstr .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr2 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr3 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr4 .= $characters[rand(0, $charactersLength - 1)];
                                            }

                                            if ($row['type'] == "button") {
                                                $typeText = "Button";
                                            } else if ($row['type'] == "dropdown") {
                                                $typeText = "Dropdown";
                                            } else if ($row['type'] == "dropdownoption") {
                                                $typeText = "Dropdown Option";
                                            }

                                            echo '<tr>
                                                    <td class="table-text">'.$typeText.'</td>
                                                    <td class="table-text">'.$dropdownText.$row['text'].'</td>
                                                    <td class="table-text">'.$row['link'].'</td>
                                                    <td class="table-text">'.$row['position'].'</td>
                                                    <td><p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">Edit</p>
                                                    </td>
                                                    <td><a class="btn btn-outline-danger" onclick="deleteNav(`'.$row['ID'].'`)">Delete</a></td>
                                                    </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Navigation</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Text</label>';
                                                echo '<input type="text" class="form-control custom-form-nav" id="'.$idstr.'" value="'.$row['text'].'"></input>';
                                                echo '</div><br>';

                                                if ($row['type'] != "dropdown") {
                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Link</label>';
                                                echo '<input type="text" class="form-control custom-form-nav" id="'.$idstr2.'" value="'.$row['link'].'"></input>';
                                                echo '</div><br>';
                                                } else {
                                                    echo '<input type="text" class="form-control custom-form-nav" id="'.$idstr2.'" value="#" hidden></input>';
                                                }

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">';
                                                echo '<label>Position</label>';
                                                echo '<input type="number" class="form-control custom-form-nav" id="'.$idstr3.'" value="'.$row['position'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">';
                                                echo '<label>Whitelist ID</label>';
                                                echo '<input type="number" class="form-control custom-form-nav" id="'.$idstr4.'" placeholder="Eg: id1, id2 - Leave Empty for None" value="'.$row['whitelistid'].'"></input>';
                                                echo '</div></div><br>';
                                                ?>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateNav(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>', '<?php echo $idstr4; ?>')" class="btn btn-outline-info">Update</a>
                                                </div>
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
                <br><br>
                <div class="row" id="socials">
                    <div class="col-md-12">
                        <div class="login-form text-center">
                            <h2>Update Socials</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="social_email">Email</label>
                                        <input type="text" name="social_email" class="form-control" placeholder="None" value="<?php echo $emailSocial ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="social_twitter">Twitter</label>
                                        <input type="text" name="social_twitter" class="form-control" placeholder="None" value="<?php echo $twitterSocial ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="social_youtube">Youtube</label>
                                        <input type="text" name="social_youtube" class="form-control" placeholder="None" value="<?php echo $youtubeSocial ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="social_tiktok">Tiktok</label>
                                        <input type="text" name="social_tiktok" class="form-control" placeholder="None" value="<?php echo $tiktokSocial ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="social_instagram">Instagram</label>
                                        <input type="text" name="social_instagram" class="form-control" placeholder="None" value="<?php echo $instaSocial ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="social_github">Github</label>
                                        <input type="text" name="social_github" class="form-control" placeholder="None" value="<?php echo $githubSocial ?>">
                                    </div>
                                </div>
                                <button class="btn btn-outline-info" type="submit" name="update_socials">Update</button>
                            </form>
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
        <script>
        $("#nav_type").change(function () {
            var value = this.value;
            if(value == "dropdown") {
                $('#nav_link').hide();
                $('#nav_dropdownid').hide();
                $('.change-col').removeClass("col-md-3");
                $('.change-col').addClass("col-md-4");
            } else if (value == "dropdownoption") {
                $('#nav_dropdownid').show();
                $('#nav_link').show();
                $('.change-col').removeClass("col-md-3");
                $('.change-col').removeClass("col-md-4");
                $('.change-col').addClass("col-md-2");
                $('.change-col1').removeClass("col-md-2");
                $('.change-col1').addClass("col-md-3");
                $('.change-col2').removeClass("col-md-2");
                $('.change-col2').addClass("col-md-3");
                $('.change-col4').removeClass("col-md-2");
                $('.change-col4').addClass("col-md-1");
                $('.change-col5').removeClass("col-md-2");
                $('.change-col5').addClass("col-md-3");
            } else {
                $('#nav_link').show();
                $('#nav_dropdownid').hide();
                $('.change-col').removeClass("col-md-2");
                $('.change-col').removeClass("col-md-3");
                $('.change-col').removeClass("col-md-4");
                $('.change-col').addClass("col-md-3");
            }
        });

        function deleteNav(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletenav : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
		}

        function updateNav(navid, textid, linkid, positionid, whitelistid) {
            var navText = document.getElementById(textid).value;
            var navLink = document.getElementById(linkid).value;
            var navPosition = document.getElementById(positionid).value;
            var navWhitelistID = document.getElementById(whitelistid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updatenav : navid, updatetext : navText, updatelink : navLink, updateposition : navPosition, updatewhitelist: navWhitelistID },
			success: function(res){
						// success
						location.reload();
					}
            });
        }
        </script>
    </body>
</html>