<footer>
<div class="container">
    <div class="footer-bottom-area">
        <div class="row">
            <div class="col-md-4">
                <p style="text-align: center;"><?php echo $footerText; ?></p>
            </div>
            <div class="col-md-4 text-center">
                <?php 
                if (!empty($emailSocial))
                {
                    echo '<a target="_blank" href="mailto:'.$emailSocial.'"><i class="bi bi-envelope p-2"></i></a>';
                }

                if (!empty($twitterSocial))
                {
                    echo '<a target="_blank" href="'.$twitterSocial.'"><i class="bi bi-twitter p-2"></i></a>';
                }

                if (!empty($youtubeSocial))
                {
                    echo '<a target="_blank" href="'.$youtubeSocial.'"><i class="bi bi-youtube p-2"></i></a>';
                }

                if (!empty($tiktokSocial))
                {
                    echo '<a target="_blank" href="'.$tiktokSocial.'"><i class="bi bi-tiktok p-2"></i></a>';
                }

                if (!empty($instaSocial))
                {
                    echo '<a target="_blank" href="'.$instaSocial.'"><i class="bi bi-instagram p-2"></i></a>';
                }

                if (!empty($githubSocial))
                {
                    echo '<a target="_blank" href="'.$githubSocial.'"><i class="bi bi-github p-2"></i></a>';
                }
                ?>
            </div>
            <div class="col-md-4">
                <p style="text-align: center;">Made with <3 by <a href="https://discord.gg/3DDWp6w" target="_blank">Hamz#0001</a></p>
            </div>
        </div>
    </div>
</div>
</footer>