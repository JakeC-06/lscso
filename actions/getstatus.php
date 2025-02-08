<?php
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../settings.php");

$status = $pdo->query("SELECT * FROM status");
$status2 = $pdo->query("SELECT * FROM status");

$upordown = true;

function ping($host, $port) {
    $fp = fsockopen($host, $port, $errno, $errstr, 30);
    if (!$fp) {
        return false;
    } else {
        return true;
    }
}

foreach($status as $row)
{
    if (ping($row['serviceIP'], $row['servicePort']) == true) {
        // Keep True
    } else {
        $upordown = false;
    }
}
?>
<div class="col-md-12">
    <div class="login-form">
        <?php
        if ($upordown == true) {
            echo '<h3 style="text-align: center; color: white;"><i class="bi bi-check" style="color: #00b67f; padding-right: 10px;"></i> All Systems Operational</h3>
            ';
        } else {
            echo '<h3 style="text-align: center; color: white;"><i class="bi bi-x" style="color: #d60d0d; padding-right: 10px;"></i> Some Systems are Experiencing Issues</h3>
            ';
        }
        ?>
    </div>
    <br><br>
    <?php 
    foreach ($status2 as $row)
    {
    ?>
    <div class="login-form" style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-md-11">
                <h4 style="padding-left: 30px; padding-top: 5px;"><?php echo $row['serviceName'] ?></h4>
            </div>
            <div class="col-md-1">
                <?php
                if (ping($row['serviceIP'], $row['servicePort']) == true) {
                    echo '<div class="pulsating-circle-green"></div>';
                } else {
                    echo '<div class="pulsating-circle-red"></div>';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="progress">
                    <?php 
                    for ($i = 0; $i < 100; $i++)
                    {
                        echo '<div class="progress-bar bg-green" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>';
                    }

                    if (ping($row['serviceIP'], $row['servicePort']) == true) {
                        echo '<div class="progress-bar bg-green-last" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>';
                    } else {
                        echo '<div class="progress-bar bg-red-last" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>