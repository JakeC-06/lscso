<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

if (empty($_SESSION['mainadminperms']))
{
	header('Location: '.BASE_URL.'/index.php');
    die();
}

$actionMessage = "";

// ACTION NOTIFICATIONS
if(isset($_GET['success']))
{
  $actionMessage = '<div class="alert alert-success alert-dismissible fade show" style="text-align: center; font-size: 18px;" role="alert">Updated Successfully!</div>';
}

$status = $pdo->query("SELECT * FROM status");
$faq = $pdo->query("SELECT * FROM faq ORDER BY position ASC");
$features = $pdo->query("SELECT * FROM features");
$downloads = $pdo->query("SELECT * FROM downloads");
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

        <title><?php echo $serverName; ?> | Admin - General Settings</title>

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
                    <span class="sub-text text-center">General Settings</span>
                </div>
            </div>
        </div>

        <section class="faq-area pt-50 pb-100 white-container">
            <?php
            if (!empty($_SESSION['settingsperms']))
            {
            ?>
            <div class="container">
                <?php include "menu.inc.php"; ?>
                <hr style="color: black;">

                <div class="row">
                    <div class="col-md-12">
                        <?php if($actionMessage){echo $actionMessage;} ?>
                        <div class="login-form">
                            <h2 style="text-align: center;">Edit Settings</h2>

                            <form action="../actions/functions.php" method="post" enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="server_name">Server Name</label>
                                        <input type="text" name="server_name" class="form-control" placeholder="Eg. HAMZRP" value="<?php echo $serverName; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="discord_invite">Discord Invite</label>
                                        <input type="text" name="discord_invite" class="form-control" placeholder="" value="<?php echo $discordInvite; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="server_ip">Server IP</label>
                                        <input type="text" name="server_ip" class="form-control" placeholder="Eg. 192.168.0.1:30120" value="<?php echo $serverIP; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="accent_color">Accent Color</label>
                                        <input type="text" name="accent_color" class="form-control" placeholder="Eg. #00B9FF" value="<?php echo $accentColor; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="background_color">Background Color</label>
                                        <input type="text" name="background_color" class="form-control" placeholder="Eg. #FFFFFF" value="<?php echo $backgroundColor; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="server_logo">Server Logo</label>
                                        <input type="file" name="server_logo" style="padding-top: 5px;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="banner_image">Banner Image</label>
                                        <input type="file" name="banner_image" style="padding-top: 5px;">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="footer_text">Footer Text</label>
                                        <input type="text" name="footer_text" class="form-control" placeholder="Eg. © 2022 HAMZRP" value="<?php echo $footerText; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="faq_status">Enable FAQ?</label>
                                        <select class="form-control" name="faq_status">
                                            <option value="<?php echo $faqStatus; ?>"><?php if($faqStatus == 0){echo "Disabled";} else {echo "Enabled";} ?></option>
                                            <option value="0">Disabled</option>
                                            <option value="1">Enabled</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="maintenance_mode">Maintenance Mode</label>
                                        <select class="form-control" name="maintenance_mode">
                                            <option value="<?php echo $maintenance; ?>"><?php if($maintenance == 0){echo "Disabled";} else {echo "Enabled";} ?></option>
                                            <option value="0">Disabled</option>
                                            <option value="1">Enabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="about">About</label>
                                        <textarea style="height: 100px;" type="text" name="about" placeholder="Leave empty to disable." class="form-control"><?php echo $about; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status">Status Notification</label>
                                        <textarea style="height: 100px;" type="text" name="status" class="form-control" placeholder="This will show a notification in the status page. If one of your services are down you can put a message here going into more detail if you wish."><?php echo $statusNotification; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="settings_log">Settings Log</label>
                                        <input type="text" name="settings_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $settings_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="navigation_log">Navigation Log</label>
                                        <input type="text" name="navigation_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $navigation_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_log">Form Log</label>
                                        <input type="text" name="form_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $form_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="page_log">Page Log</label>
                                        <input type="text" name="page_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $page_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ban_log">Ban Log</label>
                                        <input type="text" name="ban_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $ban_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rules_log">Rules Log</label>
                                        <input type="text" name="rules_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $rules_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="gallery_log">Gallery Log</label>
                                        <input type="text" name="gallery_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $gallery_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="team_log">Team Log</label>
                                        <input type="text" name="team_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $team_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="dev_log">Dev Log</label>
                                        <input type="text" name="dev_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $dev_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="feedback_log">Feedback Log</label>
                                        <input type="text" name="feedback_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $feedback_log; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="permissions_log">Permissions Log</label>
                                        <input type="text" name="permissions_log" class="form-control" placeholder="Eg. Channel ID" value="<?php echo $permissions_log; ?>">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="update_settings">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" id="serverStatus">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Add Server to Status Page</h2>

                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="server_name">Server Name</label>
                                        <input type="text" name="server_name" class="form-control" placeholder="Eg. Menu Server">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="server_ip">IP</label>
                                        <input type="text" name="server_ip" class="form-control" placeholder="Eg. 192.168.0.1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="server_port">Port</label>
                                        <input type="text" name="server_port" class="form-control" placeholder="Eg. 30120">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_server_status">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Servers</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>IP</td>
                                            <td>Port</td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($status as $row)
                                        {
                                          echo '<tr>
                                                <td class="table-text">'.$row['serviceName'].'</td>
                                                <td class="table-text">'.$row['serviceIP'].'</td>
                                                <td class="table-text">'.$row['servicePort'].'</td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteStatus(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" id="download">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Add Downloads</h2>
                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="download_title">Title</label>
                                        <input type="text" name="download_title" class="form-control" placeholder="Eg. Sound Pack" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="download_image">Image Link</label>
                                        <input type="text" name="download_image" class="form-control" placeholder="Eg. Imgur/Discord Image Link" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="download_whitelist">Whitelist Role IDs</label>
                                        <input type="text" name="download_whitelist" class="form-control" placeholder="Eg. id1, id2 - Leave Empty for None" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="download_link">Download Link</label>
                                        <input type="text" name="download_link" class="form-control" placeholder="Eg. Google Drive Link" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="download_text">Subtext</label>
                                        <textarea type="text" name="download_text" class="form-control" placeholder="" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_download">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Downloads</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Title</td>
                                            <td>Whitelist</td>
                                            <td>Subtext</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($downloads as $row)
                                        {

                                        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $modalstr = '';
                                        for ($i = 0; $i < 10; $i++) {
                                            $viewstr .= $characters[rand(0, $charactersLength - 1)];
                                            $editstr .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr2 .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr3 .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr4 .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr5 .= $characters[rand(0, $charactersLength - 1)];
                                        }

                                          echo '<tr>
                                                <td class="table-text">'.$row['title'].'</td>
                                                <td class="table-text">'.$row['whitelistid'].'</td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$viewstr.'">View</a></td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$editstr.'">Edit</a></td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteDownload(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $viewstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                            <?php echo $row['subtext']; ?>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="modal fade" id="<?php echo $editstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Downloads</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Title</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr.'" value="'.$row['title'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Image Link</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['image'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">';
                                                echo '<label>Download Link</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr3.'" value="'.$row['link'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6" style="padding-top: 10px;">';
                                                echo '<label>Whitelist ID</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr4.'" value="'.$row['whitelistid'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-12" style="padding-top: 10px;">';
                                                echo '<label>Sub Text</label>';
                                                echo '<textarea type="text" class="form-control" style="height: 100px;" id="'.$idstr5.'">'.$row['subtext'].'</textarea>';
                                                echo '</div><br>';
                                                echo '</div>';
                                                ?>
                                                <br>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateDownload(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>', '<?php echo $idstr4; ?>', '<?php echo $idstr5; ?>')" class="btn btn-outline-info">Update</a>
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
                <br><br>
                <div class="row" id="feature">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Add About Features</h2>
                            <p class="text-center">Recommended Max 3 or 4. Get icons from <a href=" https://icons.getbootstrap.com/" target="_blank">here</a></p>
                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="features_icon">Icon</label>
                                        <input type="text" name="features_icon" class="form-control" placeholder="Eg. file-bar-graph-fill" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="features_title">Title</label>
                                        <input type="text" name="features_title" class="form-control" placeholder="Eg. Fast Systems" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="features_text">Text</label>
                                        <textarea type="text" name="features_text" class="form-control" placeholder="" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_features">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current Features</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Icon</td>
                                            <td>Title</td>
                                            <td>Text</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($features as $row)
                                        {

                                        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $modalstr = '';
                                        for ($i = 0; $i < 10; $i++) {
                                            $viewstr .= $characters[rand(0, $charactersLength - 1)];
                                            $editstr .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr2 .= $characters[rand(0, $charactersLength - 1)];
                                            $idstr3 .= $characters[rand(0, $charactersLength - 1)];
                                        }

                                          echo '<tr>
                                                <td class="table-text">'.$row['icon'].'</td>
                                                <td class="table-text">'.$row['title'].'</td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$viewstr.'">View</a></td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$editstr.'">Edit</a></td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteFeature(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $viewstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                            <?php echo $row['text']; ?>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="modal fade" id="<?php echo $editstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update Features</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Icon</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr.'" value="'.$row['icon'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-6">';
                                                echo '<label>Title</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['title'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-12" style="padding-top: 10px;">';
                                                echo '<label>Text</label>';
                                                echo '<textarea type="text" class="form-control" style="height: 100px;" id="'.$idstr3.'">'.$row['text'].'</textarea>';
                                                echo '</div><br>';
                                                echo '</div>';
                                                ?>
                                                <br>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateFeatures(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>')" class="btn btn-outline-info">Update</a>
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
                <br><br>
                <div class="row" id="faq">
                    <div class="col-md-12">
                        <div class="login-form">
                            <h2 style="text-align: center;">Add FAQ</h2>

                            <form action="../actions/functions.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label for="faq_question">Question</label>
                                        <input type="text" name="faq_question" class="form-control" placeholder="Eg. Is this a whitelisted server?">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="faq_answer">Answer</label>
                                        <textarea type="text" name="faq_answer" class="form-control" placeholder="Eg. You just need to be in the discord to play on the server!"></textarea>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="faq_order">Order</label>
                                        <input type="number" name="faq_order" class="form-control" placeholder="Eg. 2">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-info" type="submit" name="add_faq">Add</button>
                                </div>
                            </form>
                            <hr>
                            <br>
                            <h2 style="text-align: center;">Current FAQ</h2>
                            <div class="table-responsive">
                                <table class="table table-dark text-center">
                                    <tbody>
                                        <tr>
                                            <td>Position</td>
                                            <td>Question</td>
                                            <td>Answer</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($faq as $row)
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
                                                <td class="table-text">'.$row['question'].'</td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$modalstr.'">View</a></td>
                                                <td><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#'.$editstr.'">Edit</a></td>
                                                <td><a class="btn btn-outline-danger" onclick="deleteFAQ(`'.$row['ID'].'`)">Delete</a></td>
                                                </tr>';
                                        ?>
                                        <div class="modal fade" id="<?php echo $modalstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                            <?php echo $row['answer']; ?>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="modal fade" id="<?php echo $editstr; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body text-left">
                                                <h2 class="text-center" style="padding-top: 10px !important;">Update FAQ</h2>
                                                <?php
                                                echo '<div class="row">';
                                                echo '<div class="form-group col-md-3">';
                                                echo '<label>Position</label>';
                                                echo '<input type="number" class="form-control" id="'.$idstr.'" value="'.$row['position'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-9">';
                                                echo '<label>Question</label>';
                                                echo '<input type="text" class="form-control" id="'.$idstr2.'" value="'.$row['question'].'"></input>';
                                                echo '</div><br>';

                                                echo '<div class="form-group col-md-12" style="padding-top: 10px;">';
                                                echo '<label>Answer</label>';
                                                echo '<textarea type="text" class="form-control" style="height: 100px;" id="'.$idstr3.'">'.$row['answer'].'</textarea>';
                                                echo '</div><br>';
                                                echo '</div>';
                                                ?>
                                                <br>
                                                <div class="text-center">
                                                    <a class="btn btn-outline-info" onclick="updateFAQ(<?php echo $row['ID']; ?>, '<?php echo $idstr; ?>', '<?php echo $idstr2; ?>', '<?php echo $idstr3; ?>')" class="btn btn-outline-info">Update</a>
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
            <?php
            } else {
                echo '<div class="container"><h3 style="text-align: center; color: black;">Please choose a menu option: '.$_SESSION['banperms'].'</h3>';
                include "menu.inc.php";
                echo'</div>';
            }
            ?>
        </section>

        <!-- FOOTER -->
        <?php include "../includes/footer.inc.php"; ?>

        <!-- JS -->
        <script>
		function deleteStatus(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletestatus : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
		}

        function deleteFAQ(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletefaq : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function deleteFeature(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletefeatures : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function deleteDownload(id) {
			$.ajax({
					type : "POST",
					url  : "../actions/functions.php",
					data : { deletedownload : id, token : document.getElementById("token").value },
					success: function(res){
								// success
								location.reload();
							}
        	});
        }

        function updateFeatures(featureid, iconid, titleid, textid) {
            var featureIcon = document.getElementById(iconid).value;
            var featureTitle = document.getElementById(titleid).value;
            var featureText = document.getElementById(textid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updatefeature : featureid, updatefeatureicon : featureIcon, updatefeaturetitle : featureTitle, updatefeaturetext : featureText },
			success: function(res){
						// success
						location.reload();
					}
            });
        }

        function updateFAQ(faqid, positionid, questionid, answerid) {
            var faqPosition = document.getElementById(positionid).value;
            var faqQuestion = document.getElementById(questionid).value;
            var faqAnswer = document.getElementById(answerid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updatefaq : faqid, updatefaqposition : faqPosition, updatefaqquestion : faqQuestion, updatefaqanswer : faqAnswer },
			success: function(res){
						// success
						location.reload();
					}
            });
        }

        function updateDownload(downloadid, titleid, imageid, linkid, whitelistid, textid) {
            var downloadTitle = document.getElementById(titleid).value;
            var downloadImage = document.getElementById(imageid).value;
            var downloadLink = document.getElementById(linkid).value;
            var downloadWhitelist = document.getElementById(whitelistid).value;
            var downloadText = document.getElementById(textid).value;

            $.ajax({
			type : "POST",
			url  : "../actions/functions.php",
			data : { updatedownload : downloadid, updatedownloadtitle : downloadTitle, updatedownloadimage : downloadImage, updatedownloadlink : downloadLink, updatedownloadwhitelist : downloadWhitelist, updatedownloadtext: downloadText },
			success: function(res){
						// success
						location.reload();
					}
            });
        }
        </script>
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