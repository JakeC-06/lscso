<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['pagesperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$pages = $pdo->query("SELECT * FROM pages");
$pages2 = $pdo->query("SELECT * FROM pages");

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

        <title><?php echo $serverName; ?> | Admin - Custom Pages</title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

        <style>
            #copy:hover {
                color: var(--mainColor);
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
                    <span class="sub-text text-center">Custom Pages</span>
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
                            <h2 class="text-center">Add a New Page</h2>
                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="pages_title">Title</label>
                                        <input type="text" name="pages_title" class="form-control" placeholder="Eg. Documents" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pages_subtext">Sub Text</label>
                                        <input type="text" name="pages_subtext" class="form-control" placeholder="Eg. Be sure to read over important documents section.">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pages_whitelistid">Whitelist Role ID</label>
                                        <input type="text" name="pages_whitelistid" class="form-control" placeholder="Eg. id1, id2 - Leave empty for no whitelist">
                                    </div>
                                    <div class="form-group">
                                        <label for="pages_html">HTML Content</label>
                                        <textarea type="text" name="pages_html" class="form-control" style="height: 300px;" placeholder="Uses html and css for design. &#10;Premade templates are provided for an idea, or you can use online examples and tutorials to learn more"></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_page">Add</button>
                                </div>
                                <br>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Pages</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Title</td>
                                            <td>Sub Text</td>
                                            <td>Whitelist ID</td>
                                            <td>Link <i>(click to copy)</i></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($pages2 as $row)
                                        {

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

                                            echo '<tr>
                                                    <td class="table-text">'.$row['title'].'</td>
                                                    <td class="table-text">'.$row['subtext'].'</td>
                                                    <td class="table-text">'.$row['whitelistid'].'</td>
                                                    <td class="table-text" title="Copy to Clipboard" id="copy" onclick="copy(`'."/pages.php?id=".$row['ID'].'`)">'."/pages.php?id=".$row['ID'].'</td>
                                                    <td><p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">Edit</p>
                                                    </td>
                                                    <td><a class="btn btn-outline-danger" onclick="deletePage(`'.$row['ID'].'`)">Delete</a></td>
                                                    </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Page</h2>
                                                <?php
                                                echo '<div class="row">'; 
                                                echo '<div class="form-group col-md-12">';
                                                echo '<label>Title</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr.'" value="'.$row['title'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Sub Text</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['subtext'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Whitelist ID</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr4.'" value="'.$row['whitelistid'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-12">';
                                                echo '<label>HTML Content</label>';
                                                echo '<textarea type="text" class="form-control" style="height: 300px;" id="'.$idstr3.'">'.html_entity_decode($row['html']).'</textarea>';
                                                echo '</div><br>';
                                                echo '</div>'; 
                                                ?>  
                                                <br>
                                                <a class="btn btn-outline-info" onclick="updatePage(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>', '<?php echo $idstr4; ?>')" class="btn btn-outline-info">Update</a>                             
                                            <br><br><br><br>
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
            </div>
            
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

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
        <script>
        function copy(text) {
            navigator.clipboard.writeText(text);
            $("body").css("cursor", "wait");
            setTimeout(() => { $("body").css("cursor", "default"); }, 250);
        }

        function deletePage(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletepage : id, token : document.getElementById("token").value },
					success: function(res){  
								// success
								location.reload();
							}
        	});
		}

        function updatePage(pageid, titleid, subtextid, htmlid, whitelistid) {
            var pageTitle = document.getElementById(titleid).value; 
            var pageText = document.getElementById(subtextid).value; 
            var pageHTML = document.getElementById(htmlid).value;
            var pageWhitelist = document.getElementById(whitelistid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updatepage : pageid, updatepagetitle : pageTitle, updatepagetext : pageText, updatepagehtml : pageHTML, updatepagewhitelist: pageWhitelist },
			success: function(res){  
						// success
						location.reload();
					}
            });
        }
        </script>
    </body>
</html>