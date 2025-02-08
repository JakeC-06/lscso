<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['applicationperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Added Successfully!</div>';
}

$applications = $pdo->query("SELECT * FROM application");
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

        <title><?php echo $serverName; ?> | Admin - Application</title>

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
                    <span class="sub-text text-center">Create Application</span>
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
                            <h2 style="text-align: center;">Add Form</h2>

                            <form action="../actions/functions.php"  method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="form_title">Title</label>
                                        <input type="text" name="form_title" class="form-control" placeholder="Eg. Moderator Application" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="form_subtext">Sub Text</label>
                                        <input type="text" name="form_subtext" class="form-control" placeholder="Eg. Please fill out with detail">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="form_logid">Discord Log Channel ID or Webhook</label>
                                        <input type="text" name="form_logid" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="form_whitelist">Whitelist Role ID</label>
                                        <input type="text" name="form_whitelist" class="form-control" placeholder="Eg: id1, id2 - Leave Blank for No Whitelist">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="form_viewid">Reponses Viewing Role ID</label>
                                        <input type="text" name="form_viewid" class="form-control" placeholder="Eg: id1, id2 - Leave Blank for Default Response Perms">
                                    </div>
                                    <hr>
                                </div>
                                <div class="row" id="dynamic_field">
                                    <div class="row field1">
                                        <div class="form-group col-md-2">
                                            <label for="form_type[]">Type</label>
                                            <select class="form-control" onChange="changeFields(this, 1)" name="form_type[]">
                                                <option value="Input">Normal Input Field</option>
                                                <option value="Textarea">Large Input FIeld</option>
                                                <option value="Dropdown">Dropdown</option>
                                                <option value="Date">Date</option>
                                                <option value="Number">Number Only Field</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="form_question[]">Question</label>
                                            <input type="text" name="form_question[]" class="form-control" placeholder="Eg. Name?" required>
                                        </div>
                                        <div class="form-group col-md-3" id="fieldPlaceholder1">
                                            <label for="form_placeholder[]">Placeholder</label>
                                            <input type="text" name="form_placeholder[]" class="form-control" placeholder="Eg. what this is">
                                        </div>
                                        <div class="form-group col-md-3" id="fieldOptions1" style="display: none;">
                                            <label for="form_options[]">Options</label>
                                            <input type="text" name="form_options[]" class="form-control" placeholder="Eg. option1, option2, option3">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="form_required[]">Required</label>
                                            <select class="form-control" name="form_required[]">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="form_boxsize[]">Box Size</label>
                                            <select class="form-control" name="form_boxsize[]" required>
                                                <option value="6">Half Width</option>
                                                <option value="12">Full Width</option>
                                                <option value="4">1/3 Width</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" name="add" id="add" class="btn btn-outline-success">Add Field</button></td>
                                <br><br><br>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="create_form">Create</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Forms</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Title</td>
                                            <td>Sub Text</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($applications as $row)
                                        {
                                            $applicationID = $row['ID'];

                                            $applicationsFields = $pdo->prepare("SELECT * FROM application_fields WHERE applicationID=?");
                                            $applicationsFields->execute([$applicationID]);

                                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            $charactersLength = strlen($characters);
                                            $modalstr = '';
                                            for ($i = 0; $i < 10; $i++) {
                                                $modalstr .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr2 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr3 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr4 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr5 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr6 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr7 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr8 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr9 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr10 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr11 .= $characters[rand(0, $charactersLength - 1)];
                                                $idstr12 .= $characters[rand(0, $charactersLength - 1)];
                                            }

                                            echo '<tr>
                                                    <td class="table-text">'.$row['title'].'</td>
                                                    <td class="table-text">'.$row['subtext'].'</td>';
                                                    if ($row['status'] == "1") {
                                                        echo '<td><a class="btn btn-outline-warning" onclick="opencloseForm(`'.$row['ID'].'`, `0`)">Close</a></td>';
                                                    } else {
                                                        echo '<td><a class="btn btn-outline-success" onclick="opencloseForm(`'.$row['ID'].'`, `1`)">Open</a></td>';
                                                    }
                                                    if ($row['hide'] == "0") {
                                                        echo '<td><a class="btn btn-outline-warning" onclick="hideForm(`'.$row['ID'].'`, `1`)">Hide</a></td>';
                                                    } else {
                                                        echo '<td><a class="btn btn-outline-success" onclick="hideForm(`'.$row['ID'].'`, `0`)">Show</a></td>';
                                                    }
                                                    echo '<td><p class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">Edit</p>
                                                    </td>
                                                    <td><a class="btn btn-outline-danger" onclick="deleteForm(`'.$row['ID'].'`)">Delete</a></td>
                                                    </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Form</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-4">';
                                                echo '<label>Title</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr.'" value="'.$row['title'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-4">';
                                                echo '<label>Sub Text</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['subtext'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-4">';
                                                echo '<label>Channel ID or Webhook</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr3.'" value="'.$row['logid'].'"></input>';
                                                echo '</div>';

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">';
                                                echo '<label>View Responses Role ID</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr12.'" value="'.$row['viewid'].'"></input>';
                                                echo '</div>';

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">
                                                <label>Whitelist Role ID</label>
                                                <input type="text" class="form-control" placeholder="Eg: id1, id2 - Leave Blank for No Whitelist" value="'.$row['whitelistid'].'" id="'.$idstr9.'">
                                                </div></div><hr>';

                                                foreach($applicationsFields as $row2)
                                                {
                                                    echo'<div class="row"><div style="padding-top: 36px;" class="col-md-1">
                                                    <a onclick="deleteField(`'.$row2['ID'].'`)" class="btn btn-danger">X</a>
                                                    </div>';

                                                    echo '<div class="form-group col-md-2">
                                                    <label>Type</label>
                                                    <select class="form-control" name="'.$idstr10.'[]" disabled>
                                                    <option value="'.$row2['type'].'">'.$row2['type'].'</option>
                                                    </select>
                                                    </div>';

                                                    echo '<div class="form-group col-md-3">
                                                    <label>Question</label>
                                                    <input type="text" class="form-control" placeholder="Eg. Name?" value="'.$row2['question'].'" name="'.$idstr4.'[]" required>
                                                    </div>';

                                                    echo '<div class="form-group col-md-3" '.(($row2['type']=='Dropdown' || $row2['type']=='Date')?'style="display: none;"':"").'>
                                                    <label>Placeholder</label>
                                                    <input type="text" class="form-control" placeholder="Eg. what this is" value="'.$row2['placeholder'].'" name="'.$idstr5.'[]" required>
                                                    </div>';

                                                    echo '<div class="form-group col-md-3" '.(($row2['type']=='Dropdown')?'style="display: block;"':'style="display: none;"').'>
                                                    <label>Options</label>
                                                    <input type="text" class="form-control" placeholder="Eg. option1, option2" value="'.$row2['options'].'" name="'.$idstr6.'[]" required>
                                                    </div>';

                                                    echo '<div class="form-group col-md-1">
                                                    <label>Required</label>
                                                    <select class="form-control" name="'.$idstr7.'[]">
                                                    <option value="'.$row2['required'].'">'.$row2['required'].'</option>
                                                    <option value="No">No</option>
                                                    <option value="Yes">Yes</option>
                                                    </select>
                                                    </div>';
                                                    if ($row2['boxsize'] == "12") {
                                                        $boxsizetext = "Full Width";
                                                    } else if ($row2['boxsize'] == "6") {
                                                        $boxsizetext = "Half Width";
                                                    } else if ($row2['boxsize'] == "4") {
                                                        $boxsizetext = "1/3 Width";
                                                    }
                                                    echo '<div class="form-group col-md-2">
                                                    <label for="form_boxsize[]">Box Size</label>
                                                    <select class="form-control" name="'.$idstr11.'[]" required>
                                                    <option value="'.$row2['boxsize'].'">'.$boxsizetext.'</option>
                                                    <option value="6">Half Width</option>
                                                    <option value="12">Full Width</option>
                                                    <option value="4">1/3 Width</option>
                                                    </select>
                                                    </div></div><br>';

                                                    echo '<input type="text" value="'.$row2['ID'].'" name="'.$idstr8.'[]" hidden>
                                                    ';

                                                }
                                                ?>
                                                <br>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateForm(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>', '<?php echo $idstr4; ?>', '<?php echo $idstr5; ?>', '<?php echo $idstr6; ?>', '<?php echo $idstr7; ?>', '<?php echo $idstr8; ?>', '<?php echo $idstr9; ?>', '<?php echo $idstr10; ?>', '<?php echo $idstr11; ?>', '<?php echo $idstr12; ?>')" class="btn btn-outline-info">Update</a>
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
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<div class="row field'+i+'"><div style="padding-top: 36px;" class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div><div class="form-group col-md-2"><label for="form_type[]">Type</label><select class="form-control" onChange="changeFields(this, '+i+')" name="form_type[]" id="'+i+'"><option value="Input">Normal Input Field</option><option value="Textarea">Large Input FIeld</option><option value="Dropdown">Dropdown</option><option value="Date">Date</option><option value="Number">Number Only Field</option></select></div><div class="form-group col-md-3"><label for="form_question[]">Question</label><input type="text" name="form_question[]" class="form-control" placeholder="Eg. Name?" required></div><div class="form-group col-md-3" id="fieldPlaceholder'+i+'"><label for="form_placeholder[]">Placeholder</label><input type="text" name="form_placeholder[]" class="form-control" placeholder="Eg. what this is"></div><div class="form-group col-md-3" id="fieldOptions'+i+'" style="display: none;"><label for="form_options[]">Options</label><input type="text" name="form_options[]" class="form-control" placeholder="Eg. option1, option2, option3"></div><div class="form-group col-md-1"><label for="form_required[]">Required</label><select class="form-control" name="form_required[]"><option value="No">No</option><option value="Yes">Yes</option></select></div><div class="form-group col-md-2"><label for="form_boxsize[]">Box Size</label><select class="form-control" name="form_boxsize[]"><option value="6">Half Width</option><option value="12">Full Width</option><option value="4">1/3 Width</option></select></div></div>');
        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('.field'+button_id+'').remove();
                });
        });

        function changeFields(that, id) {
            var value = that.value;
            if(value == "Dropdown") {
                $('#fieldPlaceholder'+id).hide();
                $('#fieldOptions'+id).show();
            } else if(value == "Date") {
                $('#fieldPlaceholder'+id).hide();
                $('#fieldOptions'+id).hide();
            } else {
                $('#fieldPlaceholder'+id).show();
                $('#fieldOptions'+id).hide();
            }
        }

		function deleteForm(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deleteform : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
		}

        function opencloseForm(id, status) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { opencloseform : id, updatestatus: status, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function hideForm(id, status) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { hideform : id, hidestatus: status, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function deleteField(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletefield : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});

		}

        function updateForm(formid, titleid, subtextid, logid, questionid, placeholderid, optionsid, requiredid, fieldid, whitelistid, typeid, boxsizeid, responsesviewid) {
            var formTitle = document.getElementById(titleid).value;
            var formSubText = document.getElementById(subtextid).value;
            var formLogID = document.getElementById(logid).value;
            var formWhitelistID = document.getElementById(whitelistid).value;
            var formResponseID = document.getElementById(responsesviewid).value;

            $.ajax({
                type : "POST",
                url  : "../actions/functions.php",
                data : { updateform : formid, updatetitle : formTitle, updatesubtext: formSubText, updatelogid: formLogID, updatewhitelist: formWhitelistID, updateviewid: formResponseID },
                success: function(res){
                            // success
                        }
            });

            var questionsValue = {};
            var placeholderValue = {};
            var optionsValue = {};

            var question = document.getElementsByName(questionid+'[]');
            var placeholder = document.getElementsByName(placeholderid+'[]');
            var options = document.getElementsByName(optionsid+'[]');
            var required = document.getElementsByName(requiredid+'[]');
            var fieldID = document.getElementsByName(fieldid+'[]');
            var type = document.getElementsByName(typeid+'[]');
            var boxsize = document.getElementsByName(boxsizeid+'[]');

            for (var i = 0; i < question.length; i++) {

                if (placeholder[i] === undefined) {
                    placeholderValue = placeholder[i];
                } else {
                    placeholderValue = placeholder[i].value;
                }
                if (options[i] === undefined) {
                    optionsValue = options[i];
                } else {
                    optionsValue = options[i].value;
                }

                questionsValue = question[i].value;

                $.ajax({
                type : "POST",
                url  : "../actions/functions.php",
                data : { updatefield : fieldID[i].value, updatequestion : questionsValue, updateplaceholder: placeholderValue, updateoptions: optionsValue, updaterequired: required[i].value, updateboxsize: boxsize[i].value },
                success: function(res){
                            // success
                            location.reload();
                        }
                });
            }
        }
        </script>
    </body>
</html>