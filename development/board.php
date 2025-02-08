<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");
require_once(__DIR__ . "/../actions/functions.php");
checkBan();

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$result = $pdo->query("SELECT * FROM boards");
$result2 = $pdo->query("SELECT * FROM feedback_type");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/boxicons.min.css">
        <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="../assets/css/fancybox.min.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/css/jkanban.css" />

        <title><?php echo $serverName; ?> | Development Board</title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

        <style>
            #myKanban {
                overflow-x: auto;
                padding: 20px 0;
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
                    <span class="main-section-title text-center">Development Board</span>
                </div>
            </div>
        </div>

        <section class="faq-area ptb-100 white-container">
            <div class="container">
            <?php if($actionMessage){echo $actionMessage;} ?>
            <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <div class="login-form">
                            <p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addCard">Add a Card</p>
                        </div>
                    </div>

                    <div class="modal fade" id="addCard" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-body text-left">
                                <h3 class="text-center" style="padding-top: 10px !important;">Add Card</h3>
                                <br>
                                <form action="../actions/functions.php" method="post">
                                    <div class="form-group" style="padding-bottom: 12px;">
                                        <label for="card_status">Status</label>
                                        <select class="form-control" name="card_status">
                                            <?php
                                            foreach($result as $row)
                                            {
                                            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="padding-bottom: 12px;">
                                        <label for="card_type">Type</label>
                                        <select class="form-control" name="card_type">
                                            <?php
                                            foreach($result2 as $row)
                                            {
                                            echo '<option value="'.$row['type'].'">'.$row['type'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" style="padding-bottom: 12px;">
                                        <label for="card_title">Title</label>
                                        <input type="text" name="card_title" class="form-control" required>
                                    </div>
                                    <div class="form-group" style="padding-bottom: 12px;">
                                        <label for="card_text">Text</label>
                                        <textarea type="text" name="card_text" class="form-control" required></textarea>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button class="btn btn-outline-info" type="submit" name="add_card">Add</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

            </div>
            </div>

                <br>
                <div id="myKanban" class="row text-center justify-content-center"></div>

				<?php
                                if (isset($_GET['cardid']))
                                {
                                    $row_id = $_GET['cardid'];

                                    $stmt = $pdo->prepare("SELECT * FROM cards WHERE id=?");
                                    $stmt->execute([$row_id]);
                                    $row = $stmt->fetch();

                                    $cardid = $row['id'];
                                    $card_type = $row['type'];
                                    $card_title = $row['title'];
                                    $card_text = $row['text'];


                                    $feedback_types = $pdo->query("SELECT * FROM feedback_type");
                                    $feedback_types = $feedback_types->fetchAll();


                                    echo '<div class="modal fade" id="cardModal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">

                                                        <form>
                                                            <h3 style="text-align: center;">Edit Card</h3>

                                                            <div class="form-group mb-4 mt-4">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" id="floatingInputGroup1" value="' .$card_title.'"></input>
                                                            </div>

                                                            <div class="form-group mb-4 mt-4">
                                                                <label>Text</label>
                                                                <textarea type="text" class="form-control" id="floatingInputGroup2">'.$card_text.'</textarea>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Type</label>
                                                                <select class="form-control" id="floatingInputGroup3">';
                                                                    if (!empty($card_type)) {
                                                                    echo '<option value="'.$card_type.'">'.$card_type.'</option>';
                                                                    }
                                                                    foreach($feedback_types as $row2) {
                                                                        echo '<option value="'.$row2['type'].'">'.$row2['type'].'</option>';
                                                                    }   
                                                                echo '</select>
                                                            </div>

                                                            <div class="mt-3 p-3 justify-content-center text-center">
                                                                <button onClick="saveChanges('.$cardid.')" type="button" class="btn btn-outline-info">Update</button>
                                                                <button onClick="deleteCard('.$cardid.')" type="button" class="btn btn-outline-danger" style="margin-left: 15px;">Delete</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                }
                ?>
            </div>
            <br>
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
        <script src="../assets/js/jkanban.js"></script>

        <script>

		function saveChanges(id)
		{
			var edittitle = document.getElementById("floatingInputGroup1").value;
			var edittext = document.getElementById("floatingInputGroup2").value;
			var edittype = document.getElementById("floatingInputGroup3").value;

            $.ajax({
				url: '../actions/functions.php',
				type: 'POST',
				data: {edit_card_id: id, edit_card_title: edittitle, edit_card_text: edittext, edit_card_type: edittype},
				success: function(data)
				{
					location.replace('<?php echo BASE_URL; ?>/development/board.php');
				}
			});
		}

        function deleteCard(id)
        {
            $.ajax({
				url: '../actions/functions.php',
				type: 'POST',
				data: {delete_card_id: id},
				success: function(data)
				{
					location.replace('<?php echo BASE_URL; ?>/development/board.php');
				}
			});
        }

		$(window).on('load',function(){
            $('#cardModal').modal('show');
        });

		var KanbanTest = new jKanban({
			element: "#myKanban",
			gutter: "15px",
			widthBoard: "425px",
			itemHandleOptions:{
			enabled: false,
			},
			click: function(el) {
				var card_id = el.getAttribute("data-eid");
				window.location.href = "board.php?cardid=" + card_id;
			},
			dropEl: function(el, target, source, sibling){
			var boardnametext = target.parentElement.getElementsByClassName("kanban-title-board")[0].innerHTML;

			$.ajax({
				url: '../actions/functions.php',
				type: 'POST',
				data: {changecardboard: el.dataset.eid, boardname: boardnametext},
				success: function(data)
				{
					//location.reload();
				}
			});
			},
			boards: [
			<?php
			$boardids = $pdo->query("SELECT * FROM boards");
			foreach($boardids as $row)
			{
				$dragToIds .= "'".$row['id']."',";
			}
			?>
			,{
				id: "0",
				title: "Feedbacks",
				dragTo: [<?php echo $dragToIds; ?>],
				item: [
				<?php
				$stmt = $pdo->prepare("SELECT * FROM cards WHERE boardname=?");
				$stmt->execute(['Feedbacks']);
				$feedbacks = $stmt->fetchAll();

				foreach($feedbacks as $row)
				{
				?>
				,{
					id: "<?php echo $row['id']; ?>",
					title: "<b><u><?php echo $row['title']."</u> <span class='badge badge-pill bg-dark' style='color: white;'>".$row['type']."</span></b><br>".$row['text']; ?>"
				},
				<?php
				}
				?>
				]
			},
			<?php
			$boards = $pdo->query("SELECT * FROM boards ORDER BY boardorder ASC");
			foreach($boards as $row)
			{
				$boardName = $row['name'];
			?>
			,{
				id: "<?php echo $row['id']; ?>",
				title: "<?php echo $boardName; ?>",
				dragTo: ['0',<?php echo $dragToIds; ?>],
				item: [
				<?php
				$stmt = $pdo->prepare("SELECT * FROM cards WHERE boardname=?");
				$stmt->execute([$boardName]);
				$cards = $stmt->fetchAll();

				foreach($cards as $row2)
				{
				?>
				,{
					id: "<?php echo $row2['id']; ?>",
					title: "<b><u><?php echo $row2['title']."</u> <span class='badge badge-pill bg-dark' style='color: white;'>".$row2['type']."</span></b><br>".$row2['text']; ?>"
				},
				<?php
				}
				?>
				]
			},
			<?php
			}
			?>
			]
		});

        $('#cardModal').on('hidden.bs.modal', function () {
            location.replace('<?php echo BASE_URL; ?>/development/board.php');
        })
    </script>
    </body>
</html>