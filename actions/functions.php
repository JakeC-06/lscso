<?php
require_once(__DIR__ . "/discord_functions.php");
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");


if (isset($_POST['rulesshow']))
{
	showRule();
}

if (isset($_POST['deleterule']))
{
	if ($_SESSION['rulesperms'] == 1) {
		deleteRule();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_category']))
{
	if ($_SESSION['rulesperms'] == 1) {
		addCategory();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_rule']))
{
	if ($_SESSION['rulesperms'] == 1) {
		addRule();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['update_settings']))
{
	if ($_SESSION['settingsperms'] == 1) {
		updateSettings();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_gallery']))
{
	if ($_SESSION['galleryperms'] == 1) {
		addGallery();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteimage']))
{
	if ($_SESSION['galleryperms'] == 1) {
		deleteGallery();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_server_status']))
{
	if ($_SESSION['settingsperms'] == 1) {
		addServer();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletestatus']))
{
	if ($_SESSION['settingsperms'] == 1) {
		deleteStatus();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_nav']))
{
	if ($_SESSION['navperms'] == 1) {
		addNavigation();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletenav']))
{
	if ($_SESSION['navperms'] == 1) {
		deleteNav();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatenav']))
{
	if ($_SESSION['navperms'] == 1) {
		updateNav();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['update_socials']))
{
	if ($_SESSION['navperms'] == 1) {
		updateSocials();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_page']))
{
	if ($_SESSION['pagesperms'] == 1) {
		addPage();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_download']))
{
	if ($_SESSION['settingsperms'] == 1) {
		addDownload();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletepage']))
{
	if ($_SESSION['pagesperms'] == 1) {
		deletePage();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatepage']))
{
	if ($_SESSION['pagesperms'] == 1) {
		updatePage();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatefeature']))
{
	if ($_SESSION['settingsperms'] == 1) {
		updateFeature();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatedownload']))
{
	if ($_SESSION['settingsperms'] == 1) {
		updateDownload();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updaterule']))
{
	if ($_SESSION['rulesperms'] == 1) {
		updateRule();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatefaq']))
{
	if ($_SESSION['settingsperms'] == 1) {
		updateFAQ();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_ban']))
{
	if ($_SESSION['banperms'] == 1) {
		addBan();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteban']))
{
	if ($_SESSION['banperms'] == 1) {
		deleteBan();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['addboard']))
{
	if ($_SESSION['adminperms'] == 1) {
		updateBoard('addboard');
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteboard']))
{
	if ($_SESSION['adminperms'] == 1) {
		updateBoard('deleteboard');
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_team']))
{
	if ($_SESSION['teamperms'] == 1) {
		addTeam();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteteam']))
{
	if ($_SESSION['teamperms'] == 1) {
		deleteTeam();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['create_form']))
{
	if ($_SESSION['applicationperms'] == 1) {
		createForm();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteform']))
{
	if ($_SESSION['applicationperms'] == 1) {
		deleteForm();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletefield']))
{
	if ($_SESSION['applicationperms'] == 1) {
		deleteField();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updateform']))
{
	if ($_SESSION['applicationperms'] == 1) {
		updateForm();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatefield']))
{
	if ($_SESSION['applicationperms'] == 1) {
		updateField();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['submitID']))
{
	if (!empty($_SESSION['logged_in'])) {
		submitApplication();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['opencloseform']))
{
	if ($_SESSION['applicationperms'] == 1) {
		formStatus();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['hideform']))
{
	if ($_SESSION['applicationperms'] == 1) {
		formHide();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['update_permission']))
{
	if ($_SESSION['adminperms'] == 1) {
		updatePermission();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_faq']))
{
	if ($_SESSION['settingsperms'] == 1) {
		addFAQ();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletefaq']))
{
	if ($_SESSION['settingsperms'] == 1) {
		deleteFAQ();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_features']))
{
	if ($_SESSION['settingsperms'] == 1) {
		addFeatures();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletefeatures']))
{
	if ($_SESSION['settingsperms'] == 1) {
		deleteFeatures();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deletedownload']))
{
	if ($_SESSION['settingsperms'] == 1) {
		deleteDownload();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_GET['searchuser']))
{
	searchUser();
}

if (isset($_POST['deleteresponse']))
{
	if ($_SESSION['responseperms'] == 1) {
		deleteResponse();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['updatestatus']))
{
	if ($_SESSION['responseperms'] == 1) {
		updateStatus();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['upvote']))
{
	if (!empty($_SESSION['logged_in'])) {
		upvote();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['downvote']))
{
	if (!empty($_SESSION['logged_in'])) {
		downvote();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['create_suggestion']))
{
	if (!empty($_SESSION['logged_in'])) {
		createSuggestion();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['addcomment']))
{
	if (!empty($_SESSION['logged_in'])) {
		addComment();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['changecardboard']))
{
	if (!empty($_SESSION['boardperms'])) {
		changeCard();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['add_card']))
{
	if (!empty($_SESSION['boardperms'])) {
		addCard();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['pushtoboard']))
{
	if (!empty($_SESSION['boardperms'])) {
		pushToBoard();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['addType']))
{
	if ($_SESSION['adminperms'] == 1) {
		addType();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteType']))
{
	if ($_SESSION['adminperms'] == 1) {
		deleteType();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['edit_card_id']))
{

	if ($_SESSION['boardperms'] == 1) {
		editCard();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['delete_card_id']))
{

	if ($_SESSION['boardperms'] == 1) {
		deleteCard();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteComment']))
{
	if (!empty($_SESSION['logged_in'])) {
		deleteComment();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['deleteFeedback']))
{
	if (!empty($_SESSION['logged_in'])) {
		deleteFeedback();
	} else {
		header('Location: ../index.php');
	}
}

if (isset($_POST['downloadlog']))
{
	downloadLog();
}

function searchUser()
{
	global $pdo;

	$searchuser = htmlspecialchars($_GET['searchuser']);

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
		if (strlen($searchuser) > 0)
		{

			// SEARCH DATABASE
			$result = $pdo->query("SELECT * FROM users WHERE discordid LIKE '%$searchuser%' OR name LIKE '%$searchuser%' OR identifier LIKE '%$searchuser%'");
			$resultcount = $pdo->query("SELECT * FROM users WHERE discordid LIKE '%$searchuser%' OR name LIKE '%$searchuser%' OR identifier LIKE '%$searchuser%'");

			if (sizeof($resultcount->fetchAll()) > 0) {
				foreach ($result as $row)
				{
					$userName = $row['name'];
					$userDiscordid = $row['discordid'];
					$userIdentifier = "(".$row['identifier'].")";
					if ($userIdentifier == "()") {
						$userIdentifier = "";
					}
					echo "<p class='text-success text-center'><a style='text-decoration: none;' href=?userq=" . $row['discordid'] . "#searched>" . $userName . " ".$userIdentifier." - " . $userDiscordid ."</a></p>";
				}
			} else {
				echo '<p class="text-success text-center">No Search Results</p>';
			}

		} else {
			echo '<p class="text-success text-center">No Search Results</p>';
		}
	}
}

function showRule()
{
	global $pdo;

	$categoryName = htmlspecialchars($_POST['rulesshow']);

	$stmt = $pdo->prepare("SELECT * FROM rules WHERE type='rule' AND categoryName=? ORDER BY position ASC");
	$stmt->execute([$categoryName]);
	$rules = $stmt->fetchAll();

    foreach ($rules as $row)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomid = '';
        for ($i = 0; $i < 6; $i++) {
            $randomid .= $characters[rand(0, $charactersLength - 1)];
        }

        echo '
                <li class="accordion-item">
                    <a class="accordion-title" onclick="showContent(`'.$randomid.'`)" href="javascript:void(0)">
                        <i style="color: black; width: 50%; padding-top: 2px;" class="bi bi bi-arrow-down-short"></i>
                        '.$row['ruleName'].'
                    </a>

                    <div class="accordion-content" id="'.$randomid.'">
                        <p>'.html_entity_decode($row['ruleDescription']).'</p>
                    </div>
                </li>
            ';
    }

}

function deleteRule()
{
	global $pdo, $rules_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleterule = htmlspecialchars($_POST['deleterule']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {

		// SELECT OLD RULE INFORMATION
		$stmt = $pdo->prepare("SELECT * FROM rules WHERE ID=?");
		$stmt->execute([$deleterule]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$categoryType = $row['type'];
			$categoryName = $row['categoryName'];
			$ruleName = $row['ruleName'];
			$ruleDescription = $row['ruleDescription'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM rules WHERE ID=? ");
		$stmt->execute([$deleterule]);

		// LOG IT
		if ($categoryType == "category")
		{
			$log = new richEmbed("DELETED CATEGORY", "By <@{$user_discordid}>");
			$log->addField("Category Name:", $categoryName, false);
			$log = $log->build();
			sendLog($log, $rules_log);
		} else {
			$log = new richEmbed("DELETED RULE", "By <@{$user_discordid}>");
			$log->addField("Category Name:", $categoryName, false);
			$log->addField("Rule Name:", $ruleName, false);
			$log->addField("Rule Description:", $ruleDescription, false);
			$log = $log->build();
			sendLog($log, $rules_log);
		}
	}
}

function addCategory()
{
	global $pdo, $rules_log;

	$user_discordid = $_SESSION['user_discordid'];
	$category_name = htmlspecialchars($_POST['category_name']);
	$category_position = htmlspecialchars($_POST['category_position']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO rules (type, categoryName, position) VALUES (?, ?, ?)");
	$result = $stmt->execute(array('category', $category_name, $category_position));

	// LOG IT
	$log = new richEmbed("NEW RULE CATEGORY", "By <@{$user_discordid}>");
	$log->addField("Name:", $category_name, false);
	$log->addField("Position:", $category_position, false);
	$log = $log->build();
	sendLog($log, $rules_log);

	header('Location: ../admin/rules.php?success');
}

function addRule()
{
	global $pdo, $rules_log;

	$user_discordid = $_SESSION['user_discordid'];
	$category_name = htmlspecialchars($_POST['category_name']);
	$rule_name = htmlspecialchars($_POST['rule_name']);
	$rule_description = htmlspecialchars($_POST['rule_description']);
	$rule_position = htmlspecialchars($_POST['rule_position']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO rules (type, categoryName, ruleName, ruleDescription, position) VALUES (?, ?, ?, ?, ?)");
	$result = $stmt->execute(array('rule', $category_name, $rule_name, $rule_description, $rule_position));

	// LOG IT
	$log = new richEmbed("NEW RULE", "By <@{$user_discordid}>");
	$log->addField("Category Name:", $category_name, false);
	$log->addField("Rule Name:", $rule_name, false);
	$log->addField("Rule Description:", $rule_description, false);
	$log->addField("Position:", $rule_position, false);
	$log = $log->build();
	sendLog($log, $rules_log);

	header('Location: ../admin/rules.php?success');
}

function updateSettings()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$server_name = htmlspecialchars($_POST['server_name']);
	$server_ip = htmlspecialchars($_POST['server_ip']);
	$discord_invite = htmlspecialchars($_POST['discord_invite']);
	$footer_text = htmlspecialchars($_POST['footer_text']);
	$about = htmlspecialchars($_POST['about']);
	$status = htmlspecialchars($_POST['status']);
	$accent_color = htmlspecialchars($_POST['accent_color']);
	$background_color = htmlspecialchars($_POST['background_color']);
	$maintenance_mode = htmlspecialchars($_POST['maintenance_mode']);
	$faq_status = htmlspecialchars($_POST['faq_status']);

	$settings_log = htmlspecialchars($_POST['settings_log']);
	$navigation_log = htmlspecialchars($_POST['navigation_log']);
	$form_log = htmlspecialchars($_POST['form_log']);
	$page_log = htmlspecialchars($_POST['page_log']);
	$ban_log = htmlspecialchars($_POST['ban_log']);
	$rules_log = htmlspecialchars($_POST['rules_log']);
	$gallery_log = htmlspecialchars($_POST['gallery_log']);
	$team_log = htmlspecialchars($_POST['team_log']);
	$dev_log = htmlspecialchars($_POST['dev_log']);
	$permissions_log = htmlspecialchars($_POST['permissions_log']);
	$feedback_log = htmlspecialchars($_POST['feedback_log']);

	// SELECT OLD SETTINGS INFORMATION
	$stmt = $pdo->prepare("SELECT * FROM settings WHERE ID=?");
	$stmt->execute(['1']);
	$result = $stmt->fetchAll();
	foreach ($result as $row)
	{
		$old_serverName = $row['serverName'];
		$old_accentColor = $row['accentColor'];
		$old_backgroundColor= $row['backgroundColor'];
		$old_serverIP = $row['serverIP'];
		$old_discordInvite = $row['discordInvite'];
		$old_footerText = $row['footerText'];
		$old_about = $row['about'];
		$old_statusNotification = $row['statusNotification'];
		$old_maintenance = $row['maintenance'];
		$old_faqstatus = $row['faqStatus'];

		$old_rule_log = $row['rule_log'];
		$old_settings_log = $row['settings_log'];
		$old_gallery_log = $row['gallery_log'];
		$old_navigation_log = $row['navigation_log'];
		$old_page_log = $row['page_log'];
		$old_ban_log = $row['ban_log'];
		$old_team_log = $row['team_log'];
		$old_form_log = $row['form_log'];
		$old_dev_log = $row['dev_log'];
		$old_permissions_log = $row['permissions_log'];
		$old_feedback_log = $row['feedback_log'];

		$old_image = $row['serverLogo'];
		$old_background = $row['backgroundImage'];
	}

	$errors = [];
	$fileExtensionsAllowed = ['jpeg','jpg','png'];
	$fileName = $_FILES['server_logo']['name'];
    $fileSize = $_FILES['server_logo']['size'];
    $fileTmpName  = $_FILES['server_logo']['tmp_name'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
	$uploadPath = "../assets/img/".$fileName;

	if( $fileName != "" ) {
		if (! in_array($fileExtension,$fileExtensionsAllowed)) {
			$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
		  }

		  if ($fileSize > 4000000) {
			$errors[] = "File exceeds maximum size (4MB)";
		  }

		  if (empty($errors)) {
			$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

			if ($old_image != "") {
				if ($old_image != "hamz.png") {
					unlink("../assets/img/".$old_image);
				}
			}

			if (!$didUpload) {
			  die("An error occurred. Please contact the administrator.");
			}
		  } else {
			foreach ($errors as $error) {
			  die($error . "These are the errors" . "\n");
			}
		  }
	}  else if ($old_image != "") {
		$fileName = $old_image;
	} else {
		$fileName = "hamz.png";
	}

	$fileName2 = $_FILES['banner_image']['name'];
    $fileSize2 = $_FILES['banner_image']['size'];
    $fileTmpName2  = $_FILES['banner_image']['tmp_name'];
    $fileExtension2 = strtolower(end(explode('.',$fileName2)));
	$uploadPath2 = "../assets/img/".$fileName2;

	if( $fileName2 != "" ) {
		if (! in_array($fileExtension2,$fileExtensionsAllowed)) {
			$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
		  }

		  if ($fileSize2 > 4000000) {
			$errors[] = "File exceeds maximum size (4MB)";
		  }

		  if (empty($errors)) {
			$didUpload = move_uploaded_file($fileTmpName2, $uploadPath2);

			if ($old_background != "") {
				if ($old_background != "background.jpg") {
					unlink("../assets/img/".$old_background);
				}
			}

			if (!$didUpload) {
			  die("An error occurred. Please contact the administrator.");
			}
		  } else {
			foreach ($errors as $error) {
			  die($error . "These are the errors" . "\n");
			}
		  }
	}  else if ($old_background != "") {
		$fileName2 = $old_background;
	} else {
		$fileName2 = "background.jpg";
	}

	if (empty($status)) {
		$statusLog = "";
	} else {
		$statusLog = $status;
	}

    // LOG IT
	$log = new richEmbed("SETTINGS UPDATED", "By <@{$user_discordid}>");
	if ($server_name != $old_serverName) {
		$log->addField("Server Name:", $server_name, false);
	}
	if ($fileName != $old_image) {
		$log->addField("Logo:", $fileName, false);
	}
	if ($server_ip != $old_serverIP) {
		$log->addField("IP:", $server_ip, false);
	}
	if ($discord_invite != $old_discordInvite) {
		$log->addField("Discord Invite:", $discord_invite, false);
	}
	if ($footer_text != $old_footerText) {
		$log->addField("Footer Text:", $footer_text, false);
	}
	if ($about != $old_about) {
		$log->addField("About:", $about, false);
	}
	if ($fileName2 != $old_background) {
		$log->addField("Background Image:", $fileName2, false);
	}
	if ($statusLog != $old_statusNotification) {
		$log->addField("Status Notification:", $statusLog, false);
	}
	if ($accent_color != $old_accentColor) {
		$log->addField("Accent Color:", $accent_color, false);
	}
	if ($maintenance_mode != $old_maintenance) {
		$log->addField("Maintenance:", $maintenance_mode, false);
	}
	if ($settings_log != $old_settings_log) {
		$log->addField("Settings Log:", $settings_log, false);
	}
	if ($navigation_log != $old_navigation_log) {
		$log->addField("Navigation Log:", $navigation_log, false);
	}
	if ($form_log != $old_form_log) {
		$log->addField("Form Log:", $form_log, false);
	}
	if ($page_log != $old_page_log) {
		$log->addField("Page Log:", $page_log, false);
	}
	if ($ban_log != $old_ban_log) {
		$log->addField("Ban Log:", $ban_log, false);
	}
	if ($rules_log != $old_rule_log) {
		$log->addField("Rules Log:", $rules_log, false);
	}
	if ($gallery_log != $old_gallery_log) {
		$log->addField("Gallery Log:", $gallery_log, false);
	}
	if ($team_log != $old_team_log) {
		$log->addField("Team Log:", $team_log, false);
	}
	if ($dev_log != $old_dev_log) {
		$log->addField("Dev Log:", $dev_log, false);
	}
	if ($permissions_log != $old_permissions_log) {
		$log->addField("Permissions Log:", $permissions_log, false);
	}
	if ($feedback_log != $old_feedback_log) {
		$log->addField("Feedback Log:", $feedback_log, false);
	}
	if ($faq_status != $old_faqstatus) {
		$log->addField("FAQ Status:", $faq_status, false);
	}
	if ($background_color != $old_backgroundColor) {
		$log->addField("Background Color:", $background_color, false);
	}

	$log = $log->build();
	sendLog($log, $settings_log);

	// UPDATE DATABASE
    $stmt = $pdo->prepare("UPDATE settings SET serverName=?, serverLogo=?, serverIP=?, discordInvite=?, footerText=?, about=?, backgroundImage=?, statusNotification=?, accentColor=?, backgroundColor=?, maintenance=?, faqStatus=?, settings_log=?, navigation_log=?, form_log=?, page_log=?, ban_log=?, rule_log=?, gallery_log=?, team_log=?, dev_log=?, permissions_log=?, feedback_log=? WHERE ID='1'");
    $stmt->execute([$server_name, $fileName, $server_ip, $discord_invite, $footer_text, $about, $fileName2, $status, $accent_color, $background_color, $maintenance_mode, $faq_status, $settings_log, $navigation_log, $form_log, $page_log, $ban_log, $rules_log, $gallery_log, $team_log, $dev_log, $permissions_log, $feedback_log]);

	header('Location: ../admin/main.php?success');
}

function addGallery()
{
	global $pdo, $gallery_log;

	$user_discordid = $_SESSION['user_discordid'];

	$errors = [];
	$fileExtensionsAllowed = ['jpeg','jpg','png'];
	$fileName = $_FILES['gallery_image']['name'];
	$fileSize = $_FILES['gallery_image']['size'];
	$fileTmpName  = $_FILES['gallery_image']['tmp_name'];
	$fileExtension = strtolower(end(explode('.',$fileName)));
	$uploadPath = "../assets/img/gallery/".$fileName;

	if( $fileName != "" ) {
		if (! in_array($fileExtension,$fileExtensionsAllowed)) {
			$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
			}

			if ($fileSize > 4000000) {
			$errors[] = "File exceeds maximum size (4MB)";
			}

			if (empty($errors)) {
			$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

			if (!$didUpload) {
				die("An error occurred. Please contact the administrator.");
			}
			} else {
			foreach ($errors as $error) {
				die($error . "These are the errors" . "\n");
			}
			}
	}

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO gallery (link) VALUES (?)");
	$result = $stmt->execute(array($fileName));

	// LOG IT
	$log = new richEmbed("NEW GALLERY IMAGE", "By <@{$user_discordid}>");
	$log->addField("Link:", $fileName, false);
	$log = $log->build();
	sendLog($log, $gallery_log);

	header('Location: ../admin/gallery.php?success');
}

function deleteGallery()
{
	global $pdo, $gallery_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleteimage = htmlspecialchars($_POST['deleteimage']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD GALLERY
		$stmt = $pdo->prepare("SELECT * FROM gallery WHERE ID=?");
		$stmt->execute([$deleteimage]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$link = $row['link'];
		}
		if ($link != "") {
			unlink("../assets/img/gallery/".$link);
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM gallery WHERE ID=? ");
		$stmt->execute([$deleteimage]);

		// LOG IT
		$log = new richEmbed("DELETED GALLERY IMAGE", "By <@{$user_discordid}>");
		$log->addField("Link:", $link, false);
		$log = $log->build();
		sendLog($log, $gallery_log);
	}
}

function addServer()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$server_name = htmlspecialchars($_POST['server_name']);
	$server_ip = htmlspecialchars($_POST['server_ip']);
	$server_port = htmlspecialchars($_POST['server_port']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO status (serviceName, serviceIP, servicePort) VALUES (?, ?, ?)");
	$result = $stmt->execute(array($server_name, $server_ip, $server_port));

	// LOG IT
	$log = new richEmbed("NEW SERVER STATUS", "By <@{$user_discordid}>");
	$log->addField("Server Name:", $server_name, false);
	$log->addField("Server IP:", $server_ip, false);
	$log->addField("Server Port:", $server_port, false);
	$log = $log->build();
	sendLog($log, $settings_log);

	header('Location: ../admin/main.php?success#server');
}

function deleteStatus()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletestatus = htmlspecialchars($_POST['deletestatus']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD STATUS
		$stmt = $pdo->prepare("SELECT * FROM status WHERE ID=?");
		$stmt->execute([$deletestatus]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$serviceName = $row['serviceName'];
			$serviceIP = $row['serviceIP'];
			$servicePort = $row['servicePort'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM status WHERE ID=? ");
		$stmt->execute([$deletestatus]);

			$log = new richEmbed("DELETED STATUS", "By <@{$user_discordid}>");
			$log->addField("Server Name:", $serviceName, false);
			$log->addField("Server IP:", $serviceIP, false);
			$log->addField("Server Port:", $servicePort, false);
			$log = $log->build();
			sendLog($log, $settings_log);
	}
}

function addNavigation()
{
	global $pdo, $navigation_log;

	$user_discordid = $_SESSION['user_discordid'];
	$nav_type = htmlspecialchars($_POST['nav_type']);
	$nav_text = htmlspecialchars($_POST['nav_text']);
	$nav_link = htmlspecialchars($_POST['nav_link']);
	$nav_position = htmlspecialchars($_POST['nav_position']);
	$nav_dropdownid = htmlspecialchars($_POST['nav_dropdownid']);

	if (empty($nav_link)) {
		$nav_link = "#";
	}

	if ($nav_type != "dropdownoption") {
		$nav_dropdownid = 0;
	}

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO navigation (type, text, link, position, dropdownID) VALUES (?, ?, ?, ?, ?)");
	$result = $stmt->execute(array($nav_type, $nav_text, $nav_link, $nav_position, $nav_dropdownid));

	// LOG IT
	$log = new richEmbed("NEW NAVIGATION OPTION", "By <@{$user_discordid}>");
	$log->addField("Type:", $nav_type, false);
	$log->addField("Text:", $nav_text, false);
	$log->addField("Link:", $nav_link, false);
	$log->addField("Position:", $nav_position, false);
	$log->addField("Dropdown ID:", $nav_dropdownid, false);
	$log = $log->build();
	sendLog($log, $navigation_log);

	header('Location: ../admin/navigation.php?success');
}

function deleteNav()
{
	global $pdo, $navigation_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletenav = htmlspecialchars($_POST['deletenav']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD NAVIGATION
		$stmt = $pdo->prepare("SELECT * FROM navigation WHERE ID=?");
		$stmt->execute([$deletenav]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$type = $row['type'];
			$text = $row['text'];
			$link = $row['link'];
			$position = $row['position'];
			$dropdownID = $row['dropdownID'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM navigation WHERE ID=? ");
		$stmt->execute([$deletenav]);

		$log = new richEmbed("DELETED NAVIGATION OPTION", "By <@{$user_discordid}>");
		$log->addField("Type:", $type, false);
		$log->addField("Text:", $text, false);
		$log->addField("Link:", $link, false);
		$log->addField("Position:", $position, false);
		$log->addField("Dropdown ID:", $dropdownID, false);
		$log = $log->build();
		sendLog($log, $navigation_log);
	}
}

function updateNav()
{
	global $pdo, $navigation_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatenav = htmlspecialchars($_POST['updatenav']);
	$updatetext = htmlspecialchars($_POST['updatetext']);
	$updatelink = htmlspecialchars($_POST['updatelink']);
	$updateposition = htmlspecialchars($_POST['updateposition']);
	$updatewhitelist = htmlspecialchars($_POST['updatewhitelist']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE navigation SET text=?, link=?, position=?, whitelistid=? WHERE ID=?");
	$stmt->execute([$updatetext, $updatelink, $updateposition, $updatewhitelist, $updatenav]);

	// LOG IT
	$log = new richEmbed("NAVBAR UPDATED", "By <@{$user_discordid}>");
	$log->addField("Text:", $updatetext, false);
	$log->addField("Link:", $updatelink, false);
	$log->addField("Position:", $updateposition, false);
	if(!empty($updatewhitelist)) {
		$log->addField("Whitelist ID:", $updatewhitelist, false);
	}
	$log = $log->build();
	sendLog($log, $navigation_log);
}

function updateSocials()
{
	global $pdo, $navigation_log;

	$user_discordid = $_SESSION['user_discordid'];
	$social_email = htmlspecialchars($_POST['social_email']);
	$social_twitter = htmlspecialchars($_POST['social_twitter']);
	$social_youtube = htmlspecialchars($_POST['social_youtube']);
	$social_tiktok = htmlspecialchars($_POST['social_tiktok']);
	$social_instagram = htmlspecialchars($_POST['social_instagram']);
	$social_github = htmlspecialchars($_POST['social_github']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE settings SET emailSocial=?, twitterSocial=?, youtubeSocial=?, tiktokSocial=?, instaSocial=?, githubSocial=? WHERE ID='1'");
	$stmt->execute([$social_email, $social_twitter, $social_youtube, $social_tiktok, $social_instagram, $social_github]);

	// LOG IT
	$log = new richEmbed("SOCIALS UPDATED", "By <@{$user_discordid}>");
	if (!empty($social_email)) {
		$log->addField("Email:", $social_email, false);
	}
	if (!empty($social_twitter)) {
	$log->addField("Twitter:", $social_twitter, false);
	}
	if (!empty($social_youtube)) {
	$log->addField("Youtube:", $social_youtube, false);
	}
	if (!empty($social_tiktok)) {
	$log->addField("Tik Tok:", $social_tiktok, false);
	}
	if (!empty($social_instagram)) {
	$log->addField("Instagram:", $social_instagram, false);
	}
	if (!empty($social_github)) {
	$log->addField("Github:", $social_github, false);
	}
	$log = $log->build();
	sendLog($log, $navigation_log);

	header('Location: ../admin/navigation.php?success#socials');
}

function addPage()
{
	global $pdo, $page_log;

	$user_discordid = $_SESSION['user_discordid'];
	$pages_title = htmlspecialchars($_POST['pages_title']);
	$pages_subtext = htmlspecialchars($_POST['pages_subtext']);
	$pages_html = htmlspecialchars($_POST['pages_html']);
	$pages_whitelistid = htmlspecialchars($_POST['pages_whitelistid']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO pages (title, subtext, whitelistid, html) VALUES (?, ?, ?, ?)");
	$result = $stmt->execute(array($pages_title, $pages_subtext, $pages_whitelistid, $pages_html));

	// LOG IT
	$log = new richEmbed("NEW PAGE", "By <@{$user_discordid}>");
	$log->addField("Name:", $pages_title, false);
	if (!empty($pages_subtext)) {
		$log->addField("Sub Text:", $pages_subtext, false);
	}
	if (!empty($pages_whitelistid)) {
		$log->addField("Whitelist ID:", $pages_whitelistid, false);
	}
	$log = $log->build();
	sendLog($log, $page_log);

	header('Location: ../admin/pages.php?success');
}

function addDownload()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$download_title = htmlspecialchars($_POST['download_title']);
	$download_image = htmlspecialchars($_POST['download_image']);
	$download_whitelist = htmlspecialchars($_POST['download_whitelist']);
	$download_link = htmlspecialchars($_POST['download_link']);
	$download_text = htmlspecialchars($_POST['download_text']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO downloads (title, subtext, link, image, whitelistid) VALUES (?, ?, ?, ?, ?)");
	$result = $stmt->execute(array($download_title, $download_text, $download_link, $download_image, $download_whitelist));

	// LOG IT
	$log = new richEmbed("NEW DOWNLOAD", "By <@{$user_discordid}>");
	$log->addField("Title:", $download_title, false);
	$log->addField("Image Link:", $download_image, false);
	$log->addField("Download Link:", $download_link, false);
	$log->addField("Sub Text:", $download_text, false);
	if (!empty($download_whitelist)) {
		$log->addField("Whitelist ID:", $download_whitelist, false);
	}
	$log = $log->build();
	sendLog($log, $settings_log);

	header('Location: ../admin/main.php#download');
}

function deletePage()
{
	global $pdo, $page_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletepage = htmlspecialchars($_POST['deletepage']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD PAGES
		$stmt = $pdo->prepare("SELECT * FROM pages WHERE ID=?");
		$stmt->execute([$deletepage]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$title = $row['title'];
			$subtext = $row['subtext'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM pages WHERE ID=? ");
		$stmt->execute([$deletepage]);

		$log = new richEmbed("DELETED CUSTOM PAGE", "By <@{$user_discordid}>");
		$log->addField("ID:", $deletepage, false);
		$log->addField("Title:", $title, false);
		if (!empty($subtext)) {
			$log->addField("Sub Text:", $subtext, false);
		}
		$log = $log->build();
		sendLog($log, $page_log);
	}
}

function updatePage()
{
	global $pdo, $page_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatepage = htmlspecialchars($_POST['updatepage']);
	$updatepagetitle = htmlspecialchars($_POST['updatepagetitle']);
	$updatepagetext = htmlspecialchars($_POST['updatepagetext']);
	$updatepagehtml = htmlspecialchars($_POST['updatepagehtml']);
	$updatepagewhitelist = htmlspecialchars($_POST['updatepagewhitelist']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE pages SET title=?, subtext=?, whitelistid=?, html=? WHERE ID=?");
	$stmt->execute([$updatepagetitle, $updatepagetext, $updatepagewhitelist, $updatepagehtml, $updatepage]);

	// LOG IT
	$log = new richEmbed("PAGE UPDATED", "By <@{$user_discordid}>");
	$log->addField("ID:", $updatepage, false);
	$log->addField("Title:", $updatepagetitle, false);
	if (!empty($subtext)) {
		$log->addField("Sub Text:", $subtext, false);
	}
	if (!empty($updatepagewhitelist)) {
		$log->addField("Whitelist ID:", $updatepagewhitelist, false);
	}
	$log = $log->build();
	sendLog($log, $page_log);
}

function updateFeature()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatefeature = htmlspecialchars($_POST['updatefeature']);
	$updatefeatureicon = htmlspecialchars($_POST['updatefeatureicon']);
	$updatefeaturetitle = htmlspecialchars($_POST['updatefeaturetitle']);
	$updatefeaturetext = htmlspecialchars($_POST['updatefeaturetext']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE features SET icon=?, title=?, text=? WHERE ID=?");
	$stmt->execute([$updatefeatureicon, $updatefeaturetitle, $updatefeaturetext, $updatefeature]);

	// LOG IT
	$log = new richEmbed("FEATURE UPDATED", "By <@{$user_discordid}>");
	$log->addField("ID:", $updatefeature, false);
	$log->addField("Title:", $updatefeaturetitle, false);
	$log->addField("Icon:", $updatefeatureicon, false);
	$log->addField("Text:", $updatefeaturetext, false);
	$log = $log->build();
	sendLog($log, $settings_log);
}

function updateDownload()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatedownload = htmlspecialchars($_POST['updatedownload']);
	$updatedownloadtitle = htmlspecialchars($_POST['updatedownloadtitle']);
	$updatedownloadimage = htmlspecialchars($_POST['updatedownloadimage']);
	$updatedownloadlink = htmlspecialchars($_POST['updatedownloadlink']);
	$updatedownloadwhitelist = htmlspecialchars($_POST['updatedownloadwhitelist']);
	$updatedownloadtext = htmlspecialchars($_POST['updatedownloadtext']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE downloads SET title=?, subtext=?, image=?, link=?, whitelistid=? WHERE ID=?");
	$stmt->execute([$updatedownloadtitle, $updatedownloadtext, $updatedownloadimage, $updatedownloadlink, $updatedownloadwhitelist, $updatedownload]);

	// LOG IT
	$log = new richEmbed("DOWNLOAD UPDATED", "By <@{$user_discordid}>");
	$log->addField("ID:", $updatedownload, false);
	$log->addField("Title:", $updatedownloadtitle, false);
	if (!empty($updatedownloadwhitelist)) {
	$log->addField("Whitelist:", $updatedownloadwhitelist, false);
	}
	$log->addField("Image Link:", $updatedownloadimage, false);
	$log->addField("Download Link:", $updatedownloadlink, false);
	$log = $log->build();
	sendLog($log, $settings_log);
}

function updateRule()
{
	global $pdo, $rules_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updaterule = htmlspecialchars($_POST['updaterule']);
	$updateruleposition = htmlspecialchars($_POST['updateruleposition']);
	$updaterulename = htmlspecialchars($_POST['updaterulename']);
	$updateruledescription = htmlspecialchars($_POST['updateruledescription']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE rules SET position=?, ruleName=?, ruleDescription=? WHERE ID=?");
	$stmt->execute([$updateruleposition, $updaterulename, $updateruledescription, $updaterule]);

	// LOG IT
	$log = new richEmbed("RULE UPDATED", "By <@{$user_discordid}>");
	$log->addField("ID:", $updaterule, false);
	$log->addField("Name:", $updaterulename, false);
	$log->addField("Description:", $updateruledescription, false);
	$log->addField("Position:", $updateruleposition, false);
	$log = $log->build();
	sendLog($log, $rules_log);
}

function updateFAQ()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatefaq = htmlspecialchars($_POST['updatefaq']);
	$updatefaqposition = htmlspecialchars($_POST['updatefaqposition']);
	$updatefaqquestion = htmlspecialchars($_POST['updatefaqquestion']);
	$updatefaqanswer = htmlspecialchars($_POST['updatefaqanswer']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE faq SET position=?, question=?, answer=? WHERE ID=?");
	$stmt->execute([$updatefaqposition, $updatefaqquestion, $updatefaqanswer, $updatefaq]);

	// LOG IT
	$log = new richEmbed("FAQ UPDATED", "By <@{$user_discordid}>");
	$log->addField("ID:", $updatefaq, false);
	$log->addField("Position:", $updatefaqposition, false);
	$log->addField("Question:", $updatefaqquestion, false);
	$log->addField("Answer:", $updatefaqanswer, false);
	$log = $log->build();
	sendLog($log, $settings_log);
}

function addBan()
{
	global $pdo, $ban_log;

	$user_discordid = $_SESSION['user_discordid'];
	$ban_discordid = htmlspecialchars($_POST['ban_discordid']);
	$ban_name = htmlspecialchars($_POST['ban_name']);
	$ban_reason = htmlspecialchars($_POST['ban_reason']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO bans (discordid, name, reason) VALUES (?, ?, ?)");
	$result = $stmt->execute(array($ban_discordid, $ban_name, $ban_reason));

	// LOG IT
	$log = new richEmbed("NEW BAN", "By <@{$user_discordid}>");
	$log->addField("Discord ID:", $ban_discordid, false);
	$log->addField("Name:", $ban_name, false);
	$log->addField("Ban Reason:", $ban_reason, false);
	$log = $log->build();
	sendLog($log, $ban_log);

	header('Location: ../admin/ban.php?success');
}

function deleteBan()
{
	global $pdo, $ban_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleteban = htmlspecialchars($_POST['deleteban']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD BAN
		$stmt = $pdo->prepare("SELECT * FROM bans WHERE ID=?");
		$stmt->execute([$deleteban]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$discordid = $row['discordid'];
			$name = $row['name'];
			$reason = $row['reason'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM bans WHERE ID=? ");
		$stmt->execute([$deleteban]);

		$log = new richEmbed("DELETED BAN", "By <@{$user_discordid}>");
		$log->addField("Discord ID:", $discordid, false);
		$log->addField("Name:", $name, false);
		$log->addField("Ban Reason:", $reason, false);
		$log = $log->build();
		sendLog($log, $ban_log);
	}
}

function updateBoard($action)
{
	global $pdo, $dev_log;

	if (!empty($action) && !empty($_SESSION['user_discordid']))
	{
		if ($action == 'addboard')
		{
			$boardorder = htmlspecialchars($_POST['board_order']);
			$boardname = htmlspecialchars($_POST['board_name']);
			$user_discordid = $_SESSION['user_discordid'];

			// INERT INTO DATABASE
			$stmt = $pdo->prepare("INSERT INTO boards (name, boardorder) VALUES (?, ?)");
			$stmt->execute([$boardname, $boardorder]);

			// LOG IT
			$log = new richEmbed("BOARD ADDED", "By <@{$user_discordid}>");
			$log->addField("Board Name:", $boardname, false);
			$log->addField("Board Order:", $boardorder, false);
			$log = $log->build();
			sendLog($log, $dev_log);

			header('Location: ../admin/developer.php?success');
		}
		elseif ($action == 'deleteboard')
		{
			if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
				$boardid = htmlspecialchars($_POST['id']);
				$user_discordid = $_SESSION['user_discordid'];

				// GET OLD BOARD NAME
				$stmt = $pdo->prepare("SELECT name FROM boards WHERE id=?");
				$stmt->execute([$boardid]);
				$boardname = $stmt->fetchColumn();

				// DELETE FROM DATABASE
				$stmt = $pdo->prepare("DELETE FROM boards WHERE id=?");
				$stmt->execute([$boardid]);

				// DELETE CARDS FROM THAT BOARD
				$stmt = $pdo->prepare("DELETE FROM cards WHERE boardname=?");
				$stmt->execute([$boardname]);

				// LOG IT
				$log = new richEmbed("BOARD DELETED", "By <@{$user_discordid}>");
				$log->addField("Board Name:", $boardname, false);
				$log = $log->build();
				sendLog($log, $dev_log);
			}
		}
	}

}

function upvote()
{
	global $pdo, $feedback_log;

	$feedbackID = htmlspecialchars($_POST['id']);
	$feedbackUser = $_SESSION['user_discordid'];

	// get feedback info
	$stmt = $pdo->prepare("SELECT * FROM feedback WHERE id=?");
	$stmt->execute([$feedbackID]);
	$feedback = $stmt->fetch();

	// make sure has not upvoted this feedback before
	$stmt = $pdo->prepare("SELECT * FROM feedback_votes WHERE feedback_id=? AND discord_id=?");
	$stmt->execute([$feedbackID, $feedbackUser]);
	$feedbackVote = $stmt->fetch();

	// if its a downvote, change it to an upvote
	if ($feedbackVote['vote'] == 0)
	{
		// UPDATE DATABASE
		$stmt = $pdo->prepare("UPDATE feedback_votes SET vote = 1 WHERE feedback_id=? AND discord_id=?");
		$stmt->execute([$feedbackID, $feedbackUser]);

		// LOG IT
		$log = new richEmbed("FEEDBACK UPVOTED", "By <@{$feedbackUser}>");
		$log->addField("Title:", $feedback['title'], false);
		$log = $log->build();
		sendLog($log, $feedback_log);
	}

	if ($feedbackVote == NULL)
	{
		// UPDATE DATABASE
		$stmt = $pdo->prepare("INSERT INTO feedback_votes (feedback_id, discord_id, vote) VALUES (?, ?, ?)");
		$stmt->execute([$feedbackID, $feedbackUser, 1]);

		// LOG IT
		$log = new richEmbed("FEEDBACK UPVOTED", "By <@{$feedbackUser}>");
		$log->addField("Title:", $feedback['title'], false);
		$log = $log->build();
		sendLog($log, $feedback_log);
	}
}

function downvote()
{
	// downvote feedback
	global $pdo, $feedback_log;

	$feedbackID = htmlspecialchars($_POST['id']);
	$feedbackUser = $_SESSION['user_discordid'];

	// get feedback info
	$stmt = $pdo->prepare("SELECT * FROM feedback WHERE id=?");
	$stmt->execute([$feedbackID]);
	$feedback = $stmt->fetch();

	// make sure they haven't downvoted already
	$stmt = $pdo->prepare("SELECT * FROM feedback_votes WHERE feedback_id=? AND discord_id=?");
	$stmt->execute([$feedbackID, $feedbackUser]);
	$feedbackVote = $stmt->fetch();

	if ($feedbackVote['vote'] == 1)
	{
		// UPDATE DATABASE
		$stmt = $pdo->prepare("UPDATE feedback_votes SET vote = 0 WHERE feedback_id=? AND discord_id=?");
		$stmt->execute([$feedbackID, $feedbackUser]);

		// LOG IT
		$log = new richEmbed("FEEDBACK DOWNVOTED", "By <@{$feedbackUser}>");
		$log->addField("Title:", $feedback['title'], false);
		$log = $log->build();
		sendLog($log, $feedback_log);
	} elseif ($feedbackVote == NULL)
	{
		// UPDATE DATABASE
		$stmt = $pdo->prepare("INSERT INTO feedback_votes (feedback_id, discord_id, vote) VALUES (?, ?, ?)");
		$stmt->execute([$feedbackID, $feedbackUser, 0]);

		// LOG IT
		$log = new richEmbed("FEEDBACK DOWNVOTED", "By <@{$feedbackUser}>");
		$log->addField("Title:", $feedback['title'], false);
		$log = $log->build();
		sendLog($log, $feedback_log);
	}
}

function addTeam()
{
	global $pdo, $team_log;

	$user_discordid = $_SESSION['user_discordid'];
	$team_category = htmlspecialchars($_POST['team_category']);
	$team_name = htmlspecialchars($_POST['team_name']);
	$team_discordid = htmlspecialchars($_POST['team_discordid']);
	$team_memberCategory = htmlspecialchars($_POST['team_memberCategory']);
	$team_position = htmlspecialchars($_POST['team_position']);

	// INSERT INTO DATABASE
	if (!empty($team_category)) {
		$stmt = $pdo->prepare("INSERT INTO team (type, name, position) VALUES (?, ?, ?)");
		$result = $stmt->execute(array('category', $team_category, $team_position));
	} else {
		$stmt = $pdo->prepare("INSERT INTO team (type, name, discordid, category) VALUES (?, ?, ?, ?)");
		$result = $stmt->execute(array('member', $team_name, $team_discordid, $team_memberCategory));
	}

	if (!empty($team_category)) {
		$log = new richEmbed("NEW TEAM CATEGORY", "By <@{$user_discordid}>");
		$log->addField("Name:", $team_category, false);
		$log->addField("Position:", $team_position, false);
		$log = $log->build();
		sendLog($log, $team_log);
	} else {
		$log = new richEmbed("NEW TEAM MEMBER", "By <@{$user_discordid}>");
		$log->addField("Name:", $team_name, false);
		$log->addField("Discord ID:", $team_discordid, false);
		$log->addField("Category:", $team_memberCategory, false);
		$log = $log->build();
		sendLog($log, $team_log);
	}

	header('Location: ../admin/team.php?success');
}

function deleteTeam()
{
	global $pdo, $team_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleteteam = htmlspecialchars($_POST['deleteteam']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// SELECT OLD TEAM
		$stmt = $pdo->prepare("SELECT * FROM team WHERE ID=?");
		$stmt->execute([$deleteteam]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$type = $row['type'];
			$name = $row['name'];
			$discordid = $row['discordid'];
			$category = $row['category'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM team WHERE ID=? ");
		$stmt->execute([$deleteteam]);

		if ($type == "category") {
			$log = new richEmbed("DELETED TEAM CATEGORY", "By <@{$user_discordid}>");
			$log->addField("Name:", $name, false);
			$log = $log->build();
			sendLog($log, $team_log);
		} else {
			$log = new richEmbed("DELETED TEAM MEMBER", "By <@{$user_discordid}>");
			$log->addField("Name:", $name, false);
			$log->addField("Discord ID:", $discordid, false);
			$log->addField("Category:", $category, false);
			$log = $log->build();
			sendLog($log, $team_log);
		}
	}
}

function createForm()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$count = count($_POST['form_type']);

	$form_title = htmlspecialchars($_POST['form_title']);
	$form_subtext = htmlspecialchars($_POST['form_subtext']);
	$form_logid = htmlspecialchars($_POST['form_logid']);
	$form_whitelist = htmlspecialchars($_POST['form_whitelist']);
	$form_whitelist = preg_replace('/\s+/', '', $form_whitelist);
	$form_viewid = htmlspecialchars($_POST['form_viewid']);

	$form_type = $_POST['form_type'];
	$form_question = $_POST['form_question'];
	$form_placeholder = $_POST['form_placeholder'];
	$form_options = $_POST['form_options'];
	$form_required = $_POST['form_required'];
	$form_boxsize = $_POST['form_boxsize'];

	// Insert Application Info
	$stmt = $pdo->prepare("INSERT INTO application (title, subtext, logid, whitelistid, viewid) VALUES (?, ?, ?, ?, ?)");
	$result = $stmt->execute(array($form_title, $form_subtext, $form_logid, $form_whitelist, $form_viewid));

	// Get Application ID
	$stmt = $pdo->prepare("SELECT * FROM application WHERE title=? AND logid=?");
	$stmt->execute([$form_title, $form_logid]);
	$application = $stmt->fetchAll();
	foreach ($application as $row)
	{
		$applicationID = $row['ID'];
	}

	if ($count >= 1)
	{
		for($i=0; $i<$count; $i++)
		{
			if(trim($_POST["form_type"][$i] != ''))
			{
				$stmt = $pdo->prepare("INSERT INTO application_fields (type, question, placeholder, options, required, boxsize, applicationID) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$result = $stmt->execute(array($form_type[$i], $form_question[$i], $form_placeholder[$i], $form_options[$i], $form_required[$i], $form_boxsize[$i], $applicationID));
			}
		}
	}

	$log = new richEmbed("NEW FORM CREATED", "By <@{$user_discordid}>");
	$log->addField("Title:", $form_title, false);
	if (!empty($form_subtext)) {
		$log->addField("Sub Text:", $form_subtext, false);
	}
	if (!empty($form_logid)) {
		$log->addField("Log ID:", $form_logid, false);
	}
	if (!empty($form_whitelist)) {
		$log->addField("Whitelist:", $form_whitelist, false);
	}
	if (!empty($form_viewid)) {
		$log->addField("Responses View:", $form_viewid, false);
	}
	$log = $log->build();
	sendLog($log, $form_log);

	header('Location: ../admin/application.php?success');
}

function deleteForm()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleteform = htmlspecialchars($_POST['deleteform']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
		$stmt->execute([$deleteform]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$title = $row['title'];
			$subtext = $row['subtext'];
			$logid = $row['logid'];
			$applicationID = $row['ID'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM application WHERE ID=? ");
		$stmt->execute([$deleteform]);
		$stmt = $pdo->prepare("DELETE FROM application_fields WHERE applicationID=? ");
		$stmt->execute([$applicationID]);

		$log = new richEmbed("DELETED FORM", "By <@{$user_discordid}>");
		$log->addField("Title:", $title, false);
		$log->addField("Sub Text:", $subtext, false);
		$log->addField("Log ID:", $logid, false);
		$log = $log->build();
		sendLog($log, $form_log);
	}
}

function deleteField()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletefield = htmlspecialchars($_POST['deletefield']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		$stmt = $pdo->prepare("SELECT * FROM application_fields WHERE ID=?");
		$stmt->execute([$deletefield]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$type = $row['type'];
			$question = $row['question'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM application_fields WHERE ID=? ");
		$stmt->execute([$deletefield]);

		$log = new richEmbed("DELETED FORM FIELD", "By <@{$user_discordid}>");
		$log->addField("Type:", $type, false);
		$log->addField("Question:", $question, false);
		$log = $log->build();
		sendLog($log, $form_log);
	}
}

function updateField()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatefield = htmlspecialchars($_POST['updatefield']);
	$updatequestion = htmlspecialchars($_POST['updatequestion']);
	$updateplaceholder = htmlspecialchars($_POST['updateplaceholder']);
	$updateoptions = htmlspecialchars($_POST['updateoptions']);
	$updaterequired = htmlspecialchars($_POST['updaterequired']);
	$updateboxsize = htmlspecialchars($_POST['updateboxsize']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE application_fields SET question=?, placeholder=?, options=?, required=?, boxsize=? WHERE ID=?");
	$stmt->execute([$updatequestion, $updateplaceholder, $updateoptions, $updaterequired, $updateboxsize, $updatefield]);

	// LOG IT
	$log = new richEmbed("UPDATED FIELD", "By <@{$user_discordid}>");
	$log->addField("Question:", $updatequestion, false);
	$log = $log->build();
	sendLog($log, $form_log);
}

function updateForm()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updateformid = htmlspecialchars($_POST['updateform']);
	$updatetitle = htmlspecialchars($_POST['updatetitle']);
	$updatesubtext = htmlspecialchars($_POST['updatesubtext']);
	$updatelogid = htmlspecialchars($_POST['updatelogid']);
	$updatewhitelist = htmlspecialchars($_POST['updatewhitelist']);
	$updatewhitelist = preg_replace('/\s+/', '', $updatewhitelist);
	$updateviewid = htmlspecialchars($_POST['updateviewid']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE application SET title=?, subtext=?, logid=?, whitelistid=?, viewid=? WHERE ID=?");
	$stmt->execute([$updatetitle, $updatesubtext, $updatelogid, $updatewhitelist, $updateviewid, $updateformid]);

	// LOG IT
	$log = new richEmbed("FORM UPDATED", "By <@{$user_discordid}>");
	$log->addField("Title:", $updatetitle, false);
	$log->addField("Sub Text:", $updatesubtext, false);
	$log->addField("Log ID:", $updatelogid, false);
	$log->addField("Whitelist ID:", $updatewhitelist, false);
	$log->addField("View Responses ID:", $updateviewid, false);
	$log = $log->build();
	sendLog($log, $form_log);
}

function submitApplication()
{
	global $pdo, $serverName, $serverLogo, $accentColor;

	$user_discordid = $_SESSION['user_discordid'];
	$applicationID = htmlspecialchars($_POST['submitID']);
	$submitAnswer = $_POST['submitAnswer'];

	if (empty($_SESSION['logged_in'])) {
		header('Location: ../index.php');
	} else {
		if (!empty($_POST['csrf'])) {
			if (strcmp($_SESSION['csrf_token'], $_POST['csrf']) == 0) {
				$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
				$stmt->execute([$applicationID]);
				$result = $stmt->fetchAll();
				foreach ($result as $row) {
					$title = $row['title'];
					$logid = $row['logid'];
				}

				// Insert Application Info
				$stmt = $pdo->prepare("INSERT INTO application_response (applicationID, discordID, answer, date, status) VALUES (?, ?, ?, ?, ?)");
				$result = $stmt->execute(array($applicationID, $user_discordid, $submitAnswer, date('Y-m-d'), "Pending"));

				$answer_array = json_decode($submitAnswer, true);

				$logAnswer = "";
				foreach($answer_array as $key => $value)
				{
					$logAnswer .= "**".$key."**\n".$value."\n\n";
				}

				// LOG
				if(strpos($logid, 'webhooks') !== false){
					$hookObject = json_encode([
						"username" => $serverName,
						"avatar_url" => $serverLogo,

						"embeds" => [
							[
								"type" => "rich",
								"description" => "**__".$title."__**\n\n".$logAnswer."\n\n By <@".$user_discordid.">",
								"color" => hexdec($accentColor),

							]
						]

					], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

					$ch = curl_init();
					curl_setopt_array( $ch, [
						CURLOPT_URL => $logid,
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => $hookObject,
						CURLOPT_HTTPHEADER => [
							"Content-Type: application/json"
						]
					]);
					$response = curl_exec( $ch );
					curl_close( $ch );
				} else{
					if (!empty($logid)) {
						$log = new richEmbed("__".$title."__", $logAnswer);
						$log->addField("By:", "<@".$user_discordid.">", false);
						$log = $log->build();
						sendLog($log, $logid);
					}
				}

					// SEND DM TO USER
					$newDM = MakeRequest('/users/@me/channels', array("recipient_id" => "{$user_discordid}"));
					if(isset($newDM["id"])) {
						$newMessage = MakeRequest("/channels/".$newDM["id"]."/messages", array("content" => "-\n**Application Submitted Successfully:** {$title}"));
					}

			}
		}
	}
}

function formStatus()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$opencloseform = htmlspecialchars($_POST['opencloseform']);
	$updatestatus = htmlspecialchars($_POST['updatestatus']);

	// GET OLD INFO
	$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
	$stmt->execute([$opencloseform]);
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		$title = $row['title'];
	}

	if ($updatestatus == 0) {
		$statustext = "Closed";
	} else {
		$statustext = "Opened";
	}

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE application SET status=? WHERE ID=?");
	$stmt->execute([$updatestatus, $opencloseform]);

	// LOG IT
	$log = new richEmbed("UPDATED FORM STATUS", "By <@{$user_discordid}>");
	$log->addField("Title:", $title, false);
	$log->addField("Status:", $statustext, false);
	$log = $log->build();
	sendLog($log, $form_log);
}

function formHide()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$hideform = htmlspecialchars($_POST['hideform']);
	$hidestatus = htmlspecialchars($_POST['hidestatus']);

	// GET OLD INFO
	$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
	$stmt->execute([$hideform]);
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		$title = $row['title'];
	}

	if ($hidestatus == 0) {
		$statustext = "Show";
	} else {
		$statustext = "Hidden";
	}

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE application SET hide=? WHERE ID=?");
	$stmt->execute([$hidestatus, $hideform]);

	// LOG IT
	$log = new richEmbed("UPDATED FORM STATUS", "By <@{$user_discordid}>");
	$log->addField("Title:", $title, false);
	$log->addField("Status:", $statustext, false);
	$log = $log->build();
	sendLog($log, $form_log);
}

function updatePermission()
{
	global $pdo, $permissions_log;

	$user_discordid = $_SESSION['user_discordid'];
	$application_perms = htmlspecialchars($_POST['application_perms']);
	$ban_perms = htmlspecialchars($_POST['ban_perms']);
	$gallery_perms = htmlspecialchars($_POST['gallery_perms']);
	$settings_perms = htmlspecialchars($_POST['settings_perms']);
	$nav_perms = htmlspecialchars($_POST['nav_perms']);
	$pages_perms = htmlspecialchars($_POST['pages_perms']);
	$rules_perms = htmlspecialchars($_POST['rules_perms']);
	$team_perms = htmlspecialchars($_POST['team_perms']);
	$response_perms = htmlspecialchars($_POST['response_perms']);
	$board_perms = htmlspecialchars($_POST['board_perms']);
	$feedback_perms = htmlspecialchars($_POST['feedback_perms']);

	// GET OLD INFO
	$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
	$stmt->execute(['1']);
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		$application = $row['application'];
		$ban = $row['ban'];
		$gallery = $row['gallery'];
		$settings = $row['settings'];
		$nav = $row['nav'];
		$pages = $row['pages'];
		$rules = $row['rules'];
		$team = $row['team'];
		$response = $row['response'];
		$board = $row['boards'];
		$feedback = $row['feedback'];
	}

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE permissions SET application=?, ban=?, gallery=?, settings=?, nav=?, pages=?, rules=?, team=?, response=?, boards=? WHERE ID='1'");
	$stmt->execute([$application_perms, $ban_perms, $gallery_perms, $settings_perms, $nav_perms, $pages_perms, $rules_perms, $team_perms, $response_perms, $board_perms]);

	// LOG IT
	$log = new richEmbed("PERMISSIONS UPDATED", "By <@{$user_discordid}>");
	if ($application_perms != $application) {
		$log->addField("Application Perms:", $application_perms, false);
	}
	if ($ban_perms != $ban) {
		$log->addField("Ban Perms:", $ban_perms, false);
	}
	if ($gallery_perms != $gallery) {
		$log->addField("Gallery Perms:", $gallery_perms, false);
	}
	if ($settings_perms != $settings) {
		$log->addField("Settings Perms:", $settings_perms, false);
	}
	if ($nav_perms != $nav) {
		$log->addField("Nav Perms:", $nav_perms, false);
	}
	if ($pages_perms != $pages) {
		$log->addField("Pages Perms:", $pages_perms, false);
	}
	if ($rules_perms != $rules) {
		$log->addField("Rules Perms:", $rules_perms, false);
	}
	if ($team_perms != $team) {
		$log->addField("Team Perms:", $team_perms, false);
	}
	if ($response_perms != $response) {
		$log->addField("Application Response Perms:", $response_perms, false);
	}
	if ($board_perms != $board) {
		$log->addField("Board Perms:", $board_perms, false);
	}
	if ($feedback_perms != $feedback) {
		$log->addField("Feedback Perms:", $feedback_perms, false);
	}
		$log = $log->build();
	sendLog($log, $permissions_log);

	header('Location: ../admin/permissions.php?success');
}

function addFAQ()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$faq_question = htmlspecialchars($_POST['faq_question']);
	$faq_answer = htmlspecialchars($_POST['faq_answer']);
	$faq_order = htmlspecialchars($_POST['faq_order']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO faq (question, answer, position) VALUES (?, ?, ?)");
	$result = $stmt->execute(array($faq_question, $faq_answer, $faq_order));

	// LOG IT
	$log = new richEmbed("FAQ ADDED", "By <@{$user_discordid}>");
	$log->addField("Question:", $faq_question, false);
	$log->addField("Answer:", $faq_answer, false);
	$log->addField("Position:", $faq_order, false);
	$log = $log->build();
	sendLog($log, $settings_log);

	header('Location: ../admin/main.php?success#faq');
}

function deleteFAQ()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletefaq = htmlspecialchars($_POST['deletefaq']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {

		// SELECT OLD RULE INFORMATION
		$stmt = $pdo->prepare("SELECT * FROM faq WHERE ID=?");
		$stmt->execute([$deletefaq]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$question = $row['question'];
			$answer = $row['answer'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM faq WHERE ID=? ");
		$stmt->execute([$deletefaq]);

		// LOG IT
		$log = new richEmbed("DELETED FAQ", "By <@{$user_discordid}>");
		$log->addField("Question:", $question, false);
		$log->addField("Answer:", $answer, false);
		$log = $log->build();
		sendLog($log, $settings_log);
	}
}

function addFeatures()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$features_icon = htmlspecialchars($_POST['features_icon']);
	$features_title = htmlspecialchars($_POST['features_title']);
	$features_text = htmlspecialchars($_POST['features_text']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO features (icon, title, text) VALUES (?, ?, ?)");
	$result = $stmt->execute(array($features_icon, $features_title, $features_text));

	// LOG IT
	$log = new richEmbed("FEATURE ADDED", "By <@{$user_discordid}>");
	$log->addField("Icon:", $features_icon, false);
	$log->addField("Title:", $features_title, false);
	$log->addField("Text:", $features_text, false);
	$log = $log->build();
	sendLog($log, $settings_log);

	header('Location: ../admin/main.php?success#feature');
}

function deleteFeatures()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletefeatures = htmlspecialchars($_POST['deletefeatures']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {

		// SELECT OLD RULE INFORMATION
		$stmt = $pdo->prepare("SELECT * FROM features WHERE ID=?");
		$stmt->execute([$deletefeatures]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$title = $row['title'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM features WHERE ID=? ");
		$stmt->execute([$deletefeatures]);

		// LOG IT
		$log = new richEmbed("DELETED FEATURE", "By <@{$user_discordid}>");
		$log->addField("Title:", $title, false);
		$log = $log->build();
		sendLog($log, $settings_log);
	}
}

function deleteDownload()
{
	global $pdo, $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deletedownload = htmlspecialchars($_POST['deletedownload']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {

		// SELECT OLD RULE INFORMATION
		$stmt = $pdo->prepare("SELECT * FROM downloads WHERE ID=?");
		$stmt->execute([$deletedownload]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$title = $row['title'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM downloads WHERE ID=? ");
		$stmt->execute([$deletedownload]);

		// LOG IT
		$log = new richEmbed("DELETED DOWNLOAD", "By <@{$user_discordid}>");
		$log->addField("Title:", $title, false);
		$log = $log->build();
		sendLog($log, $settings_log);
	}
}

function deleteResponse()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$deleteresponse = htmlspecialchars($_POST['deleteresponse']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {

		// SELECT OLD FORM INFORMATION
		$stmt = $pdo->prepare("SELECT * FROM application_response WHERE ID=?");
		$stmt->execute([$deleteresponse]);
		$result = $stmt->fetchAll();
		foreach ($result as $row) {
			$discordID = $row['discordID'];
			$date = $row['date'];
			$applicationID = $row['applicationID'];
		}
		$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
		$stmt->execute([$applicationID]);
		$result2 = $stmt->fetchAll();
		foreach ($result2 as $row) {
			$title = $row['title'];
		}

		// DELETE FROM DATABASE
		$stmt = $pdo->prepare("DELETE FROM application_response WHERE ID=? ");
		$stmt->execute([$deleteresponse]);

		// LOG IT
		$log = new richEmbed("DELETED RESPONSE", "Submitted By <@{$discordID}>, Deleted By <@{$user_discordid}>");
		$log->addField("Date:", $date, false);
		$log->addField("Title:", $title, false);
		$log = $log->build();
		sendLog($log, $form_log);
	}
}

function updateStatus()
{
	global $pdo, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$updatestatus = htmlspecialchars($_POST['updatestatus']);
	$updateto = htmlspecialchars($_POST['updateto']);

	$stmt = $pdo->prepare("SELECT * FROM application_response WHERE ID=?");
	$stmt->execute([$updatestatus]);
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		$discordID = $row['discordID'];
		$date = $row['date'];
		$applicationID = $row['applicationID'];
	}
	$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
	$stmt->execute([$applicationID]);
	$result2 = $stmt->fetchAll();
	foreach ($result2 as $row) {
		$title = $row['title'];
	}

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE application_response SET status=? WHERE ID=?");
	$stmt->execute([$updateto, $updatestatus]);

	// LOG IT
	$log = new richEmbed("RESPONSE STATUS UPDATED", "By <@{$user_discordid}>");
	$log->addField("Status:", $updateto, false);
	$log->addField("Title:", $title, false);
	$log->addField("Date:", $date, false);
	$log = $log->build();
	sendLog($log, $form_log);

	// SEND DM TO USER
	$newDM = MakeRequest('/users/@me/channels', array("recipient_id" => "{$discordID}"));
	if(isset($newDM["id"])) {
		$newMessage = MakeRequest("/channels/".$newDM["id"]."/messages", array("content" => "-\n**Application:** {$title} \n**Submitted On:** {$date} \n**Status Changed:** {$updateto}"));
	}
}

function addType()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$type = htmlspecialchars($_POST['type']);

	// INSERT INTO DATABASE
	$stmt = $pdo->prepare("INSERT INTO feedback_type (type) VALUES (?)");
	$result = $stmt->execute(array($type));

	// LOG IT
	$log = new richEmbed("TYPE ADDED", "By <@{$user_discordid}>");
	$log->addField("Type:", $type, false);
	$log = $log->build();
	sendLog($log, $dev_log);

	header('Location: ../admin/developer.php?success');
}

function deleteType()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$id = htmlspecialchars($_POST['id']);

	// SELECT OLD PILL INFORMATION
	$stmt = $pdo->prepare("SELECT * FROM feedback_type WHERE id=?");
	$stmt->execute([$id]);
	$result = $stmt->fetchAll();

	// DELETE FROM DATABASE
	$stmt = $pdo->prepare("DELETE FROM feedback_type WHERE id=? ");
	$stmt->execute([$id]);

	// LOG IT
	$log = new richEmbed("TYPE DELETED", "By <@{$user_discordid}>");
	$log->addField("Type:", $result, false);
	$log = $log->build();
	sendLog($log, $dev_log);

}

function createSuggestion()
{
	global $pdo, $feedback_log;

	$user_discordid = $_SESSION['user_discordid'];
	$suggestion_type = htmlspecialchars($_POST['suggestion_type']);
	$suggestion_title = htmlspecialchars($_POST['suggestion_title']);
	$suggestion_text = htmlspecialchars($_POST['suggestion_text']);

	$feedbackTime = date('Y-m-d') . " " . date("h:i:s");

	// UPDATE DATABASE
	$stmt = $pdo->prepare("INSERT INTO feedback (title, text, type, user, timePosted) VALUES (?, ?, ?, ?, ?)");
	$stmt->execute([$suggestion_title, $suggestion_text, $suggestion_type, $user_discordid, $feedbackTime]);

	// LOG IT
	$log = new richEmbed("FEEDBACK ADDED", "By <@{$user_discordid}>");
	$log->addField("Title:", $suggestion_title, false);
	$log->addField("Text:", $suggestion_text, false);
	$log->addField("Type:", $suggestion_type, false);
	$log = $log->build();
	sendLog($log, $feedback_log);

	header("Location: ../feedback.php?success");
}

function addComment()
{
	global $pdo, $feedback_log, $form_log;

	$user_discordid = $_SESSION['user_discordid'];
	$addcomment = htmlspecialchars($_POST['addcomment']);
	$type = htmlspecialchars($_POST['type']);
	$comment = htmlspecialchars($_POST['comment']);
	$feedbackTime = date('Y-m-d') . " " . date("h:i:s");

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		if ($type == "feedback") {
			// UPDATE DATABASE
			$stmt = $pdo->prepare("INSERT INTO feedback_comments (feedbackid, discordid, comment, timePosted) VALUES (?, ?, ?, ?)");
			$stmt->execute([$addcomment, $user_discordid, $comment, $feedbackTime]);

			// LOG IT
			$log = new richEmbed("COMMENT ADDED", "By <@{$user_discordid}>");
			$log->addField("Comment:", $comment, false);
			$log = $log->build();
			sendLog($log, $feedback_log);
		}

		if ($type == "application") {
			if ($_SESSION['responseperms']) {
				// UPDATE DATABASE
				$stmt = $pdo->prepare("INSERT INTO application_comments (responseID, discordid, comment, datePosted) VALUES (?, ?, ?, ?)");
				$stmt->execute([$addcomment, $user_discordid, $comment, $feedbackTime]);

				// LOG IT
				$log = new richEmbed("APPLICATION COMMENT ADDED", "By <@{$user_discordid}>");
				$log->addField("Comment:", $comment, false);
				$log = $log->build();
				sendLog($log, $form_log);

				$stmt = $pdo->prepare("SELECT * FROM application_response WHERE ID=?");
				$stmt->execute([$addcomment]);
				$result = $stmt->fetchAll();
				foreach ($result as $row)
				{
					$discordID = $row['discordID'];
					$applicationID = $row['applicationID'];
				}

				$stmt = $pdo->prepare("SELECT * FROM application WHERE ID=?");
				$stmt->execute([$applicationID]);
				$result = $stmt->fetchAll();
				foreach ($result as $row)
				{
					$title = $row['title'];
				}

				// SEND DM TO USER
				$newDM = MakeRequest('/users/@me/channels', array("recipient_id" => "{$discordID}"));
				if(isset($newDM["id"])) {
					$newMessage = MakeRequest("/channels/".$newDM["id"]."/messages", array("content" => "-\n**New Comment Added** \n\n**Application:** {$title} \n**Comment:** {$comment} \n**By:** <@{$user_discordid}>"));
				}
			}
		}
	}
}

function changeCard()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$changecardboard = htmlspecialchars($_POST['changecardboard']);
	$boardname = htmlspecialchars($_POST['boardname']);

	$stmt = $pdo->prepare("SELECT * FROM cards WHERE id=?");
	$stmt->execute([$changecardboard]);
	$result = $stmt->fetchAll();
	foreach ($result as $row) {
		$old_boardname = $row['boardname'];
		$text = $row['text'];
		$feedbackid = $row['feedbackid'];
	}

	if (!empty($feedbackid))
	{
		// UPDATE DATABASE
		$stmt = $pdo->prepare("UPDATE feedback SET status=? WHERE id=?");
		$stmt->execute([$boardname, $feedbackid]);
	}

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE cards SET boardname=? WHERE id=?");
	$stmt->execute([$boardname, $changecardboard]);

	// LOG IT
	$log = new richEmbed("CARD BOARD UPDATED", "By <@{$user_discordid}>");
	$log->addField("Text:", $text, false);
	$log->addField("Old Board:", $old_boardname, false);
	$log->addField("New Board:", $boardname, false);
	$log = $log->build();
	sendLog($log, $dev_log);
}

function addCard()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$card_status = htmlspecialchars($_POST['card_status']);
	$card_text = htmlspecialchars($_POST['card_text']);
	$card_title = htmlspecialchars($_POST['card_title']);
	$card_type = htmlspecialchars($_POST['card_type']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("INSERT INTO cards (boardname, title, text, type) VALUES (?, ?, ?, ?)");
	$stmt->execute([$card_status, $card_title, $card_text, $card_type]);

	// LOG IT
	$log = new richEmbed("CARD ADDED", "By <@{$user_discordid}>");
	$log->addField("Board:", $card_status, false);
	$log->addField("Title:", $card_title, false);
	$log->addField("Text:", $card_text, false);
	$log->addField("Type:", $card_type, false);
	$log = $log->build();
	sendLog($log, $dev_log);

	header('Location: ../development/board.php?success');
}

function pushToBoard()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$pushtoboard = htmlspecialchars($_POST['pushtoboard']);
	$cardtext = htmlspecialchars($_POST['cardtext']);
	$cardtitle = htmlspecialchars($_POST['cardtitle']);
	$cardtype = htmlspecialchars($_POST['cardtype']);

	if (!empty($_POST['token']) || hash_equals($_SESSION['token'], $_POST['token'])) {
		// UPDATE DATABASE
		$stmt = $pdo->prepare("INSERT INTO cards (boardname, title, text, type, feedbackid) VALUES (?, ?, ?, ?, ?)");
		$stmt->execute(['Feedbacks', $cardtitle, $cardtext, $cardtype, $pushtoboard]);

		// LOG IT
		$log = new richEmbed("FEEDBACK PUSHED TO DEV BOARD", "By <@{$user_discordid}>");
		$log->addField("Title:", $cardtitle, false);
		$log->addField("Text:", $cardtext, false);
		$log->addField("Type:", $cardtype, false);
		$log = $log->build();
		sendLog($log, $dev_log);
	}
}

function editCard()
{
	global $pdo, $dev_log;


	$user_discordid = $_SESSION['user_discordid'];
	$edit_card_id = htmlspecialchars($_POST['edit_card_id']);
	$edit_card_text = htmlspecialchars($_POST['edit_card_text']);
	$edit_card_type = htmlspecialchars($_POST['edit_card_type']);
	$edit_card_title = htmlspecialchars($_POST['edit_card_title']);

	// UPDATE DATABASE
	$stmt = $pdo->prepare("UPDATE cards SET title=?, text=?, type=? WHERE id=?");
	$stmt->execute([$edit_card_title, $edit_card_text, $edit_card_type, $edit_card_id]);

	// LOG IT
	$log = new richEmbed("CARD CHANGES SAVED", "By <@{$user_discordid}>");
	$log->addField("Title:", $edit_card_title, false);
	$log->addField("Text:", $edit_card_text, false);
	$log->addField("Type:", $edit_card_type, false);
	$log = $log->build();
	sendLog($log, $dev_log);
}

function deleteCard()
{
	global $pdo, $dev_log;

	$user_discordid = $_SESSION['user_discordid'];
	$delete_card_id = htmlspecialchars($_POST['delete_card_id']);

	// SELECT OLD PILL INFORMATION
	$stmt = $pdo->prepare("SELECT * FROM cards WHERE ID=?");
	$stmt->execute([$delete_card_id]);
	$result2 = $stmt->fetchAll();
	foreach ($result2 as $row) {
		$title = $row['title'];
	}

	// DELETE FROM DATABASE
	$stmt = $pdo->prepare("DELETE FROM cards WHERE id=? ");
	$stmt->execute([$delete_card_id]);

	// LOG IT
	$log = new richEmbed("CARD DELETED", "By <@{$user_discordid}>");
	$log->addField("Title:", $title, false);
	$log = $log->build();
	sendLog($log, $dev_log);

}

function deleteComment()
{
	global $pdo, $dev_log;


	$id = htmlspecialchars($_POST['id']);
	$type = htmlspecialchars($_POST['type']);
	$user_discordid = $_SESSION['user_discordid'];

	if ($type == "feedback") {
		// check if user can delete comment
		$stmt = $pdo->prepare("SELECT discordid FROM feedback_comments WHERE id=?");
		$stmt->execute([$id]);

		if($stmt == $user_discordid OR !empty($_SESSION['boardperms'])) {
			$stmt = $pdo->prepare("DELETE FROM feedback_comments WHERE id=?");
			$stmt->execute([$id]);

			// LOG IT
			$log = new richEmbed("COMMENT DELETED", "By <@{$user_discordid}>");
			$log = $log->build();
			sendLog($log, $dev_log);
		}
	}

	if ($type == "application") {
		if ($_SESSION['responseperms']) {
			$stmt = $pdo->prepare("SELECT * FROM application_comments WHERE ID=?");
			$stmt->execute([$id]);
			$result2 = $stmt->fetchAll();
			foreach ($result2 as $row)
			{
				$comment = $row['comment'];
				$responseID = $row['responseID'];
			}
			$stmt = $pdo->prepare("SELECT * FROM application_response WHERE ID=?");
			$stmt->execute([$responseID]);
			$result = $stmt->fetchAll();
			foreach ($result as $row)
			{
				$discordID = $row['discordID'];
			}
	
			$stmt = $pdo->prepare("DELETE FROM application_comments WHERE id=?");
			$stmt->execute([$id]);
	
			// LOG IT
			$log = new richEmbed("DELETED COMMENT", "Application By <@{$discordID}> \nDeleted By <@{$user_discordid}>");
			$log->addField("Comment:", $comment, false);
			$log = $log->build();
			sendLog($log, $dev_log);
		}
	}
}

function deleteFeedback()
{
	global $pdo, $dev_log;

	$id = htmlspecialchars($_POST['id']);
	$user_discordid = $_SESSION['user_discordid'];

	// check if user can delete feedback
	$stmt = $pdo->prepare("SELECT user FROM feedback WHERE id=?");
	$stmt->execute([$id]);

	if($stmt == $user_discordid OR !empty($_SESSION['boardperms'])) {
		$stmt = $pdo->prepare("DELETE FROM feedback WHERE id=?");
		$stmt->execute([$id]);

		// LOG IT
		$log = new richEmbed("FEEDBACK DELETED", "By <@{$user_discordid}>");
		$log = $log->build();
		sendLog($log, $dev_log);

		header('Location: ../feedback.php?success');
	}
}

function downloadLog()
{
	global $settings_log;

	$user_discordid = $_SESSION['user_discordid'];
	$downloadlog = htmlspecialchars($_POST['downloadlog']);

	$log = new richEmbed("DOWNLOADED: {$downloadlog}", "By <@{$user_discordid}>");
	$log = $log->build();
	sendLog($log, $settings_log);
}

?>