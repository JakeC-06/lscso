<?php
session_start();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>
<div class="text-center">
    <?php
    if ($_SESSION['settingsperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="main.php">General Settings</a>
    <?php
    } if ($_SESSION['adminperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="permissions.php">Permissions</a>
    <?php
    } if ($_SESSION['rulesperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="rules.php">Rules</a>
    <?php
    } if ($_SESSION['galleryperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="gallery.php">Gallery</a>
    <?php
    } if ($_SESSION['teamperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="team.php">Team</a>
    <?php
    } if ($_SESSION['navperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="navigation.php">Navigation Menu</a>
    <?php
    } if ($_SESSION['pagesperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="pages.php">Create Pages</a>
    <?php
    } if ($_SESSION['applicationperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="application.php">Create Application</a>
    <?php
    } if ($_SESSION['banperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="ban.php">Ban</a>
    <?php
    } if ($_SESSION['settingsperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="developer.php">Developer Settings</a>
    <?php
    } if ($_SESSION['boardperms'] == 1) {
    ?>
    <a class="btn btn-outline-dark m-2" href="../development/board.php">Developer Board</a>
    <?php
    }
    ?>
</div>
<input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token'] ?? '' ?>">