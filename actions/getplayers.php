<?php
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

// Get FiveM Count
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://'.$serverIP.'/dynamic.json');
$playerData = curl_exec($ch);
curl_close($ch);
$playerArray = json_decode($playerData, true);

if(isset($playerArray['sv_maxclients'])) {
    echo '<span class="count2" data-from="0" data-to="'.$playerArray['clients'].'" data-time="500">0</span>/'.$playerArray['sv_maxclients'];
} else {
    echo '';
}
?>
<script>
    $(document).ready(function(){
        $('.count2').counter();
        
        new WOW().init();
    });
</script>