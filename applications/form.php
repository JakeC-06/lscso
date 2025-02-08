<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");
require_once(__DIR__ . "/../actions/functions.php");
checkBan();

if (empty($_SESSION['logged_in']))
{
	header('Location: '.BASE_URL.'/actions/register.php');
}

$formAppID = $_GET['id'];
if (is_numeric($formAppID))
{
    $application = $pdo->prepare("SELECT * FROM application WHERE ID=?");
    $application->execute([$formAppID]);
}
if (empty($formAppID))
{
    header('Location: index.php');
}

foreach($application as $row)
{
    $applicationID = $row['ID'];
    $title = $row['title'];
    $subtext = $row['subtext'];
    $logid = $row['logid'];

    if (!empty($row['whitelistid'])) {
        if (checkWhitelist($_SESSION['user_discordid'], $row['whitelistid']) == true) {
            $whitelisted = true;
        } else {
            $whitelisted = false;
        }
    } else {
        $whitelisted = true;
    }

    if ($whitelisted == false) {
        header('Location: index.php');
    }

    if ($row['status'] == 0) {
        header('Location: index.php');
    }
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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

        <title><?php echo $serverName; ?> | <?php echo $title; ?></title>

        <!--OPEN GRAPH FOR DISCORD RICH PRESENCE-->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo BASE_URL; ?>" />
        <meta property="og:title" content="<?php echo $serverName; ?>" />
        <meta property="og:description" content="Community Site By Hamz#0001">
        <meta name="theme-color" content="<?php echo $accentColor; ?>">

        <link rel="icon" type="image/png" href="<?php echo $serverLogo; ?>">

        <style>
            .main-section-title {
                font-size: 50px;
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
                    <span class="main-section-title text-center"><?php echo $title; ?></span>
                </div>
            </div>
        </div>

        <section class="faq-area ptb-100 white-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="login-form">
                        <h2 style="text-align: center;"><?php echo $subtext; ?></h2>

                            <form>
                                <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                                <div class="row" id="formRequired">
                            <?php
                            $fields = $pdo->prepare("SELECT * FROM application_fields WHERE applicationID=? ORDER BY ID ASC");
                            $fields->execute([$formAppID]);

                            foreach($fields as $row)
                            {
                                if ($row['type'] == "Input") {
                                    echo '<div class="form-group col-md-'.$row['boxsize'].'">
                                    <label>'.$row['question'].'</label>
                                    <input type="text" name="form_answers[]" id="'.$row['question'].'" class="form-control" placeholder="'.$row['placeholder'].'" '.(($row['required']=='Yes')?'required':"").'>
                                    </div>';
                                }

                                if ($row['type'] == "Textarea") {
                                    echo '<div class="form-group col-md-'.$row['boxsize'].'">
                                    <label>'.$row['question'].'</label>
                                    <textarea type="text" name="form_answers[]" id="'.$row['question'].'" class="form-control" placeholder="'.$row['placeholder'].'" '.(($row['required']=='Yes')?'required':"").'></textarea>
                                    </div>';
                                }

                                if ($row['type'] == "Date") {
                                    echo '<div class="form-group col-md-'.$row['boxsize'].'">
                                    <label>'.$row['question'].'</label>
                                    <input type="date" name="form_answers[]" id="'.$row['question'].'" class="form-control" '.(($row['required']=='Yes')?'required':"").'>
                                    </div>';
                                }

                                if ($row['type'] == "Number") {
                                    echo '<div class="form-group col-md-'.$row['boxsize'].'">
                                    <label>'.$row['question'].'</label>
                                    <input type="number" name="form_answers[]" id="'.$row['question'].'" class="form-control" placeholder="'.$row['placeholder'].'" '.(($row['required']=='Yes')?'required':"").'>
                                    </div>';
                                }

                                if ($row['type'] == "Dropdown") {
                                    echo '<div class="form-group col-md-'.$row['boxsize'].'">
                                    <label>'.$row['question'].'</label>
                                    <select class="form-control" name="form_answers[]" id="'.$row['question'].'">';
                                    $options = explode(', ', $row['options']);
                                    foreach($options as $value)
                                    {
                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                    }
                                    echo '</select></div>';
                                }
                            }
                            ?>
                                </div>
                            </form>
                            <div class="text-center">
                                    <button class="btn btn-outline-success" id="submit_button" onclick="submitForm()">Submit</button>
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

        <script>
        function submitForm() {
            let allAreFilled = true;
            document.getElementById("formRequired").querySelectorAll("[required]").forEach(function(i) {
                if (!allAreFilled) return;
                if (!i.value) { allAreFilled = false;  return; }
            })
            if (!allAreFilled) {
                alert('Fill all the required fields!');
            } else {
                document.getElementById('submit_button').style.visibility = 'hidden';

                var submitarray = {};
                var answers = document.getElementsByName('form_answers[]');

                for (var i = 0; i < answers.length; i++) {
                    var question = answers[i].getAttribute('id');
                    var answer = answers[i].value;
                    submitarray[question] = answer;
                }

                $.ajax({
                    type : "POST",
                    url  : "../actions/functions.php",
                    data : { submitID : "<?php echo $formAppID; ?>", csrf: document.getElementById("csrf_token").value, submitAnswer: JSON.stringify(submitarray)},
                    success: function(res){
                            location.href = "index.php?success";
                        }
                });
            }
        }
        </script>
    </body>
</html>