<?php
// Bloc banner video
// Dynamise le : 16/08/2022
?>
<!-- Block Banner Video -->
<section class="banner-switch banner-switch_pink banner-video intro-video">
    <div class="banner-video__bg">
        <div id="player" class="<?= ($video_type == "hosted")?'hosted':'' ?>">
            <?php
            if( $video_type == "hosted" ) {
                echo $video_html;
            }
            ?>
        </div>
    </div>
    <?php if($video_type != "hosted"): ?>
    <div class="banner-video__bg-gradient" style="background-image: url(<?= get_template_directory_uri() . '/assets/images/banner-video-filter.svg' ?>)"></div>
    <?php endif; ?>
    <?php if (is_admin()) { ?>
        <div class="banner-video__bg-img" <?= (!empty($image_overlay) && !empty($image_overlay['url']))?'style="background-image: url("' . $image_overlay['url']. ')"':''; ?>></div>
    <?php } else { ?>
        <div class="banner-video__bg-img b-lazy" <?= (!empty($image_overlay) && !empty($image_overlay['url']))?'data-src="'.$image_overlay['url'].'"':'' ?>></div>
    <?php } ?>
            <div class="banner-switch_content white">
                <div class="col-12 col-lg-6 offset-0 offset-lg-6">
                    <?php
                    if( !empty($title) ):
                    ?>
                    <<?= $hn ?> class="title offset"><?= $title ?></<?= $hn ?>>
                    <?php
                    endif;
                    ?>
                    <div class="description">
                        <?= $text ?>
                    </div>
                    <!-- html structure btn btn-primary -->
                    <div class="cta">
                        <?php
                        if( !empty($cta_link) ):
                        ?>
                        <a <?= (!empty($cta_link) && !empty($cta_link['nofollow']))?'rel="nofollow"':''; ?> <?= (!empty($cta_link) && !empty($cta_link['is_external']))?'target="_blank"':''; ?> href="<?= (!empty($cta_link) && !empty($cta_link['url']))?$cta_link['url']:'#' ?>" class="btn btn-primary bg-white small">
                            <div class="text"><?= $cta_label; ?></div>
                            <div class="circle"></div>
                        </a>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
    <?php
    if( !empty($video_id) ):
        ?>
        <script>
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            const playPauseBtn = document.querySelector('.pause-video');
            const wrapper = document.querySelector('.banner-video.with-video');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;

            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: '<?= $video_id['video_id'] ?>',
                    playerVars: {
                        'autoplay': 1,
                        'controls': 0,
                        'disablekb': 1,
                        'fs': 1,
                        'loop': 1,
                        'modestbranding': 1,
                        'rel': 0,
                        'showinfo': 0,
                        'mute': 1,
                        'autohide': 1,
                        'playlist': '<?= $video_id['video_id'] ?>',
                        'iv_load_policy': 3
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
                event.target.playVideo();
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            let done = false;

            function onPlayerStateChange(event) {
                var YTP=event.target;
                if(event.data===1){
                    var remains=YTP.getDuration() - YTP.getCurrentTime();
                    if(this.rewindTO)
                        clearTimeout(this.rewindTO);
                    this.rewindTO=setTimeout(function(){
                        YTP.seekTo(0);
                    },(remains-0.1)*1000);
                }
                if (event.data == YT.PlayerState.PLAYING && !done) {
                    wrapper.classList.add('video_loaded');
                    done = true;
                }
                if (event.data === YT.PlayerState.ENDED) {
                    player.playVideo();
                }
            }

            function stopVideo() {
                player.stopVideo();
            }

            playPauseBtn.addEventListener("click", function () {
                if (player.getPlayerState() === YT.PlayerState.PLAYING) {
                    player.pauseVideo();
                    playPauseBtn.classList.add('video_paused');
                    wrapper.classList.add('video_paused');
                    playPauseBtn.querySelector("i").classList.remove('icon-btn-pause-video');
                    playPauseBtn.querySelector("i").classList.add('icon-btn-play');
                } else if (player.getPlayerState() === YT.PlayerState.PAUSED) {
                    player.playVideo()
                    playPauseBtn.classList.remove('video_paused');
                    wrapper.classList.remove('video_paused');
                    playPauseBtn.querySelector("i").classList.remove('icon-btn-play');
                    playPauseBtn.querySelector("i").classList.add('icon-btn-pause-video');
                }
            });
        </script>
        <?php
    endif;
    ?>
</section>