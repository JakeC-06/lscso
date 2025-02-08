<?php
// Documentation: https://docs.hamz.dev/
// Please look at documentation before you create a ticket.
// Recommended Web Hosting: https://hamzhosting.com/
// Add your domain to whitelist: https://license.hamzcad.com/

ini_set('display_errors', '0');

define('BASE_URL', 'https:// domain.tld'); // Make sure no / at the end. Same Format as Example!

// SQL DATABASE CONNECTION \\
define('DB_HOST', 'mysql-mariadb17-dal-104.zap-hosting.com');
define('DB_USER', 'zap1164149-2');
define('DB_PASSWORD', '58WqUsv8bSC8Rsqj');
define('DB_NAME', 'zap1164149-2');

// DISCORD OAUTH2 - Get information from Discord Dev Portal \\
define('TOKEN', 'INSERT_TOKEN');
define('GUILD_ID', 'INSERT_GUILD_ID');
define('OAUTH2_CLIENT_ID', '1337625138782404689');
define('OAUTH2_CLIENT_SECRET', 'JcYpGUZWmaVwuVf2ZIXK0Yl8Ddj03bXM');

// DISCORD ADMIN PERMISSIONS \\
// This will allow an admin to login and setup the permissions in the Admin Settings. This gives access to all sections on the admin page!
$ADMINROLES = [
	"1292264855461695569",
	"1292265008037888030",
	"1292265106750832761"
];

// GENERAL SETTINGS \\
date_default_timezone_set('EST');
define('REQUIRE_IN_GUILD_LOGIN', true); // User needs to be in discord to login to the website. (Recommended: True)

// Rest of the settings are in the Admin page of the website.