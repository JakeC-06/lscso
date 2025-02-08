<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once(__DIR__ . "/../settings.php");

/**
 * Get a Discord User object
 *
 * @param string $id A user's Discord ID
 * @return object see Discord "User" documentation
 * @url https://discordapp.com/developers/docs/resources/user
 */
function getDiscordUser($id) {

    $ch = curl_init();

    curl_setopt_array($ch, array (
        CURLOPT_URL => 'https://discordapp.com/api/v6/users/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'DiscordBot ('.BASE_URL.', 1.0.0)',
        CURLOPT_HTTPHEADER => array('Authorization: Bot ' . TOKEN)
    ));

    $user = json_decode(curl_exec($ch));

    curl_close($ch);

    return $user;
}

/**
 * Get a Discord User's avatar URL
 *
 * @param string $id A user's Discord ID
 * @return string avatar URL
 * @url https://discordapp.com/developers/docs/reference#image-formatting
 */
function getDiscordAvatarByID($id, $resolution, $format) {

    if ($resolution % 16 != 0 || $resolution > 2048 || $resolution < 16) {
        throw new InvalidArgumentException('The resolution must be a power of two between 16 and 2048 inclusive.');
    }

    $user = getDiscordUser($id);
    $hash = $user->avatar;

    $gif = "a_";

    if(strpos($hash, $gif) !== false) {
        $format = "gif";
    }
    else {
        $format = "jpg";
    }


    return "https://cdn.discordapp.com/avatars/" . $id . "/". $hash ."." . $format . "?size=" . $resolution;
}

/**
 * Get the guild object
 *
 * @return object see Discord "Guild" documentation
 * @url https://discordapp.com/developers/docs/resources/guild
 */
function getGuild() {
    $ch = curl_init();

    curl_setopt_array($ch, array (
        CURLOPT_URL => 'https://discordapp.com/api/v6/guilds/' . GUILD_ID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'DiscordBot ('.BASE_URL.', 1.0.0)',
        CURLOPT_HTTPHEADER => array('Authorization: Bot ' . TOKEN)
    ));

    $guild = json_decode(curl_exec($ch));

    curl_close($ch);

    return $guild;
}

/**
 * Get a guild member object
 *
 * @param string $id A user's Discord ID
 * @return object see Discord "Guild Member" documentation
 * @url https://discordapp.com/developers/docs/resources/guild#guild-member-object
 */
function getGuildMember($id) {
    $ch = curl_init();

    curl_setopt_array($ch, array (
        CURLOPT_URL => 'https://discordapp.com/api/v6/guilds/' . GUILD_ID . '/members/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'DiscordBot ('.BASE_URL.', 1.0.0)',
        CURLOPT_HTTPHEADER => array('Authorization: Bot ' . TOKEN)
    ));

    $guildMember = json_decode(curl_exec($ch));

    curl_close($ch);

    return $guildMember;
}

/**
 * Get's a guild member's roles as an array
 *
 * @param string $id A user's Discord ID
 * @return string[] array of user's roles
 */
function getGuildMemberRoles($id) {
    $guildMember = getGuildMember($id);
    return $guildMember->roles;
}

/**
 * Get permissions
 *
 *
 * @param string $id A user's Discord ID
 * @return int permission level
 */
function checkAdminPermissions($id) {
    global $ADMINROLES;
    $roles = getGuildMemberRoles($id);

    foreach ($ADMINROLES as $roleid) {
        if (in_array($roleid, $roles)) {
            return 1;
        }
    }

}

function checkDiscordPermissions($id) {
    global $pdo;

    $roles = getGuildMemberRoles($id);
    $_SESSION['user_roles'] = $roles;

    $result = $pdo->query("SELECT * FROM permissions");

    foreach ($result as $row)
    {
        $application = explode (",", $row['application']);
        $ban = explode (",", $row['ban']);
        $gallery = explode (",", $row['gallery']);
        $settings = explode (",", $row['settings']);
        $nav = explode (",", $row['nav']);
        $pages = explode (",", $row['pages']);
        $rules = explode (",", $row['rules']);
        $team = explode (",", $row['team']);
        $boards = explode (",", $row['boards']);
        $response = explode (",", $row['response']);

        foreach($application as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['applicationperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($ban as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['banperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($gallery as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['galleryperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($settings as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['settingsperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($nav as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['navperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($pages as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['pagesperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($rules as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['rulesperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($team as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['teamperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($boards as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['boardperms'] = 1;
                $_SESSION['mainadminperms'] = 1;
            }
        }
        foreach($response as $key) {
            if (in_array($key, $roles)) {
                $_SESSION['responseperms'] = 1;
            }
        }

    }

    if (checkDomain() == false || json_decode(verify())->authorised == "true") {
        // Okay
    } else {
        session_destroy();
    }
}

function checkWhitelist($id, $whitelistid2) {
    if (!isset($_SESSION['user_roles'])) {
        // If not, retrieve the roles from Discord and store them in the session
        $roles = getGuildMemberRoles($id);
        $_SESSION['user_roles'] = $roles;
    } else {
        // If the roles are already stored in the session, retrieve them from there
        $roles = $_SESSION['user_roles'];
    }
    $whitelistroles_array = explode(',', $whitelistid2);
    foreach ($whitelistroles_array as $roleid) {
        if (in_array($roleid, $roles)) {
            return true;
        }
    }

    return false; // Return false if none of the roles match
}



/**
 * Sends a message to the server, accepts both richEmbed objects and plaintext strings
 *
 * @param mixed $content
 */
function sendLog($content, $channelid) {
    $ch = curl_init();
    $body = array();

    if (is_string($content)) {
        $body = array("content" => $content);
    } else {
        $body = array("embed" => $content);
    }

    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://discord.com/api/v6/channels/".$channelid."/messages",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array(
            "Content-Type:application/json",
            "Authorization: Bot ". TOKEN .""
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'DiscordBot ('. BASE_URL .', 1.0.0)'
    ));

    $res = curl_exec($ch);
    curl_close($ch);
}

/**
 * Class richEmbed
 * @url https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class richEmbed {
    private $title;
    private $description;
    private $fields;

    /**
     * richEmbed constructor.
     * @param $title
     * @param $content
     */
    function __construct( $title, $content ) {

        if (!is_string($title)) { throw new InvalidArgumentException("Title value must be a string"); }
        if (!is_string($content)) { throw new InvalidArgumentException("Title value must be a string"); }

        $this->title = $title;
        $this->description = $content;
        $this->fields = array();
    }

    /**
     * Adds a field to the array
     *
     * @param $title
     * @param $content
     * @param $inline
     */
    public function addField($title, $content, $inline) {
        if (is_bool($inline)) {
            array_push($this->fields, array(
                "name" => $title,
                "value" => $content,
                "inline" => $inline
            ));
        } else {
            throw new InvalidArgumentException("Inline must be a boolean value");
        }
    }

    /**
     * Builds array structure for sending
     *
     * @return array
     */
    public function build() {
        global $accentColor, $serverLogo;

        return array(
            "title" => $this->title,
            "description" => $this->description,
            "color" => hexdec($accentColor),
            "fields" => $this->fields,
            "footer" => array("text" => "Hamz Community | By Hamz#0001", "icon_url" => "" . $serverLogo . "")
        );
    }
}


function checkDomain()
{
    if(checkdnsrr("hamzcad.com","MX")) {
        return true;
    } else {
        return false;
    }
}

function verify()
{
    $postdata = http_build_query(
        array(
            'domain' => $_SERVER['HTTP_HOST']
        )
    );
    
    $url = 'https://license.hamzcad.com/community/index.php';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

function MakeRequest($endpoint, $data) {
    # Set endpoint
    $url = "https://discord.com/api/".$endpoint."";

    # Encode data, as Discord requires you to send json data.
    $data = json_encode($data);

    # Initialize new curl request
    $ch = curl_init();
    $f = fopen('request.txt', 'w');

    # Set headers, data etc..
    curl_setopt_array($ch, array(
        CURLOPT_URL            => $url, 
        CURLOPT_HTTPHEADER     => array(
            'Authorization: Bot '.TOKEN,
            "Content-Type: application/json",
            "Accept: application/json"
        ),
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_VERBOSE        => 1,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_STDERR         => $f,
    ));

    $request = curl_exec($ch);
    curl_close($ch);
    return json_decode($request, true);
}