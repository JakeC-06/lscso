<?php
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

// Get Discord Members
$going = true;
$after = 0;
$count = 0;

while ($going)
{
    $ch = curl_init('https://discordapp.com/api/guilds/'.GUILD_ID.'/members?limit=1000&after=' . $after);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Authorization: Bot '.TOKEN));
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    $users = json_decode($result);

    if ($users && is_array($users))
    {
        $count += count($users);
        
        if (count($users) < 1000)
        {
            $going = false;
        }
        
        if(isset($users[999]->user->id)) {
            $after = $users[999]->user->id;
        }
    }
    else
    {
        break;
    }
}

echo '<span class="count1" data-from="0" data-to="'.$count.'" data-time="1000">0</span>';
?>
<script>
    $(document).ready(function(){
        $('.count1').counter();
        
        new WOW().init();
    });
</script>