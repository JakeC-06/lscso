<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['rulesperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$categories = $pdo->query("SELECT * FROM rules WHERE type='category'");
$categories2 = $pdo->query("SELECT * FROM rules WHERE type='category' ORDER BY position ASC");
$rules = $pdo->query("SELECT * FROM rules WHERE type='rule' ORDER BY position ASC");
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

        <title><?php echo $serverName; ?> | Admin - Rules</title>

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
                    <span class="sub-text text-center">Rules</span>
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
                            <h2>Add Category</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" placeholder="Eg. Discord Rules" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="category_position">Position</label>
                                        <input type="number" name="category_position" class="form-control" placeholder="Eg. 2" required>
                                    </div>
                                </div>

                                <button class="btn btn-outline-info" type="submit" name="add_category">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Add Rule</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <label>Select Category</label>
                                        <select class="form-control" name="category_name">
                                            <?php
                                            foreach($categories as $row)
                                            {
                                                echo '<option value="'.$row['categoryName'].'">'.$row['categoryName'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rule_position">Position</label>
                                        <input type="number" name="rule_position" class="form-control" placeholder="Eg. 2" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rule_name">Rule Name</label>
                                    <input type="text" name="rule_name" class="form-control" placeholder="Eg. RDM">
                                </div>
                                <div class="form-group">
                                    <label for="rule_description">Rule Description</label>
                                    <textarea style="height: 200px;" type="text" name="rule_description" class="form-control" placeholder="You can use html tags to style your text. 
Eg. 
- <b>Bold</b> 
- <i>Italics</i> 
- <u>Underline</u> 
- <br> Break Link 
- <span style='color: red;'>Test</span>
Search online for more html styling."></textarea>
                                </div>

                                <button class="btn btn-outline-info" type="submit" name="add_rule">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Current Categories</h2>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Position</td>
                                            <td>Name</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach($categories2 as $row)
                                        {
                                          echo '<tr>
                                                <td class="table-text">'.$row['position'].'</td>
                                                <td class="table-text">'.$row['categoryName'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteRule(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Current Rules</h2>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <tbody>
                                        <tr>
                                            <td>Position</td>
                                            <td>Category</td>
                                            <td>Name</td>
                                            <td>Description</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($rules as $row)
                                        {

                                        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $modalstr = '';
                                        for ($i = 0; $i < 10; $i++) {
                                            $modalstr .= $characters[rand(0, $charactersLength - 1)];
                                            $editstr .= $characters[rand(0, $charactersLength - 1)];

                                            $idstr .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr2 .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr3 .= $characters[rand(0, $charactersLength - 1)];
                                        }

                                          echo '<tr>
                                                <td class="table-text">'.$row['position'].'</td>
                                                <td class="table-text">'.$row['categoryName'].'</td>
                                                <td class="table-text">'.$row['ruleName'].'</td>
                                                <td><p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">View</p></td>
                                                <td><p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$editstr.'">Edit</p></td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteRule(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                            <h4>Description:</h4>
                                            <p><?php echo $row['ruleDescription']; ?></p>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="modal fade" id="<?php echo $editstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Rule</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-3">';
                                                echo '<label>Position</label>';
                                                echo '<input type="number" class="form-control" id="'.$idstr.'" value="'.$row['position'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-9">';
                                                echo '<label>Name</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['ruleName'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-12" style="padding-top: 10px;">';
                                                echo '<label>Description</label>';
                                                echo '<textarea type="text" class="form-control" style="height: 150px;" id="'.$idstr3.'">'.$row['ruleDescription'].'</textarea>';
                                                echo '</div><br>';
                                                echo '</div>';
                                                ?>
                                                <br>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateRule(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>')" class="btn btn-outline-info">Update</a>
                                                </div>
                                                <br><br>
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
            </div>
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

        <!-- JS -->
        <script>
		function deleteRule(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deleterule : id, token : document.getElementById("token").value },
					success: function(res){  
								// success
								location.reload();
							}
        	});

		}

        function updateRule(ruleid, positionid, nameid, descriptionid) {
            var rulePosition = document.getElementById(positionid).value;
            var ruleName = document.getElementById(nameid).value;
            var ruleDescription = document.getElementById(descriptionid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updaterule : ruleid, updateruleposition : rulePosition, updaterulename : ruleName, updateruledescription : ruleDescription },
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