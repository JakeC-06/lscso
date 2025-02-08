<?php
session_start();
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");
require_once(__DIR__ . "/../actions/discord_functions.php");
checkBan();

if (($_SESSION['mainadminperms'] != 1) && $maintenance == 1) {
	header("Location: ".BASE_URL."/maintenance.php");
}

$navigation = $pdo->query("SELECT * FROM navigation ORDER BY position ASC");

if (stripos($serverName, "rp") !== false) {
    $serverNameColor = str_replace("RP", "", $serverName)."<span class='accent-color'>RP</span>";
}
?>
<style>
html {
  --scrollbarBG: <?php echo "transparent"; ?>;
  --thumbBG: <?php echo $accentColor; ?>;
}

body::-webkit-scrollbar {
  width: 10px;
}
body {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
body::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
body::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border: 3px solid var(--scrollbarBG);
}

body.dark-mode {
  --scrollbarBG: <?php echo "transparent"; ?>;
  --thumbBG: #474747 !important;
}

body.dark-mode .white-container {
    background-color: #181818 !important;
}

body.dark-mode .section-title .sub-title {
    color: white !important;
}

body.dark-mode .sub-text {
    color: white !important;
}

body.dark-mode h2 {
    color: white !important;
}

body.dark-mode h3 {
    color: white !important;
}

body.dark-mode h4 {
    color: white !important;
}

body.dark-mode h5 {
    color: white !important;
}

body.dark-mode hr {
    color: white !important;
}

body.dark-mode .btn-outline-dark {
    color: white;
    border-color: white;
}

body.dark-mode .faq-accordion-tab .tabs li a {
    color: white !important;
    border: white 1px solid !important;
}

body.dark-mode .faq-accordion .accordion .accordion-title i {
    color: white !important;
}

body.dark-mode .faq-accordion .accordion .accordion-title {
    color: white !important;
}

body.dark-mode .faq-accordion .accordion .accordion-item {
    color: white !important;
}

body.dark-mode .par-white {
    color: white !important;
}

body.dark-mode .accordion-item {
    border: 1px solid rgba(255,255,255,.125)
}

body.dark-mode .mean-container .mean-nav ul li a {
    background-color: var(--blackColor) !important;
    color: white !important;
    border-top: 1px solid #181818 !important;
}

body.dark-mode .mean-container .mean-nav ul li a.mean-expand {
    color: white !important;
}
</style>
<div class="navbar-area">
    <div class="zelda-responsive-nav">
        <div class="container">
            <div class="zelda-responsive-menu">
                <div class="logo">
                    <a href="<?php echo BASE_URL; ?>/index.php">
                        <h3 style="font-weight: 800 !important; margin-top: 15px; padding-top: 12px;"><?php echo $serverNameColor; ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="zelda-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>/index.php">
                    <h3 style="font-weight: 800 !important; margin-top: 15px;"><?php echo $serverNameColor; ?></h3>
                </a>

                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        <?php
                        foreach($navigation as $row)
                        {
                            if ($row['type'] == "button")
                            {
                                $buttonLink = $row['link'];
                                if (stripos($buttonLink, "http") !== false || stripos($buttonLink, "www") !== false) {
                                    $buttonLink = $row['link'];
                                } else {
                                    $buttonLink = BASE_URL.$row['link'];
                                }
                                if (empty($row['whitelistid'])) {
                                    echo '<li class="nav-item"><a href="'.$buttonLink.'" class="nav-link">'.$row['text'].'</a></li>';
                                } else {
                                    if (checkWhitelist($_SESSION['user_discordid'], $row['whitelistid']) == true) {
                                        echo '<li class="nav-item"><a href="'.$buttonLink.'" class="nav-link">'.$row['text'].'</a></li>';
                                    } else {
                                        // Don't Show
                                    }
                                }
                            }
                            if ($row['type'] == "dropdown")
                            {
                                echo '<li class="nav-item"><a href="#" class="nav-link">'.$row['text'].' <i class="bi bi-arrow-down-circle"></i></a>
                                        <ul class="dropdown-menu">';
                                        $navID = $row['ID'];
                                        $dropdown = $pdo->prepare("SELECT * FROM navigation WHERE dropdownID=? AND type='dropdownoption' ORDER BY position ASC");
                                        $dropdown->execute([$navID]);

                                        foreach($dropdown as $row2)
                                        {
                                            $link = $row2['link'];
                                            if (stripos($link, "http") !== false || stripos($link, "www") !== false) {
                                                $link = $row2['link'];
                                            } else {
                                                $link = BASE_URL.$row2['link'];
                                            }
                        ?>
                                            <li class="nav-item"><a href="<?php echo $link; ?>" class="nav-link"><?php echo $row2['text']; ?></a></li>
                        <?php
                                        }
                        ?>
                                        </ul>
                                    </li>
                        <?php
                            }
                        }
                        ?>

                        <?php
                        if (!empty($_SESSION['logged_in']))
                        {
                        ?>
                        <li class="nav-item">
                            <a data-bs-toggle="modal" data-bs-target="#userprofile" class="nav-link"><?php echo $_SESSION['user_name']."#".$_SESSION['user_discriminator']; ?></a>
                        </li>
                        <?php
                        }

                        if (empty($_SESSION['logged_in']))
                        {
                        ?>
                        <li class="nav-item"><a href="<?php echo BASE_URL; ?>/actions/register.php" class="nav-link"><i class="bi bi-door-open"></i> Login</a></li>
                        <?php
                        }
                        if ($_SESSION['adminperms'] == 1 || $_SESSION['mainadminperms'] == 1)
                        {
                        ?>
                        <li class="nav-item"><a href="<?php echo BASE_URL; ?>/admin/main.php" class="nav-link"><i class="bi bi-person-fill"></i> Admin</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="dark-version-btn">
                        <label id="switch" class="switch">
                            <input type="checkbox" onchange="setDarkMode()" id="slider">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="userprofile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="row">
                    <img class="rounded-circle" style="width: 35%; margin-left: auto; display: block; margin-right: auto;" src="<?php echo $_SESSION['user_avatar']; ?>" alt="Avatar">
                </div>
                <br>
                <h5><?php echo $_SESSION['user_name']."#".$_SESSION['user_discriminator']; ?></h5>
                <h5><?php echo $_SESSION['user_discordid']; ?></h5>
                <br>
                <a href="<?php echo BASE_URL; ?>/actions/logout.php" class="btn btn-outline-warning">Log Out</a>
            </div>
        </div>
    </div>
</div>
<script>
let element = document.body;
  let theme = localStorage.getItem("theme");

  if(theme === "dark") {
    element.classList.add("dark-mode");
  } else if(theme === "light") {
    element.classList.remove("dark-mode");
  }

  function setDarkMode() {
      let element = document.body;
      element.classList.toggle("dark-mode");

      if(localStorage.getItem("theme") === "light") {
        localStorage.setItem("theme", "dark");
      } else if(localStorage.getItem("theme") === "dark") {
        localStorage.setItem("theme", "light");
      } else {
        localStorage.setItem("theme", "dark");
      }
  }
  </script>