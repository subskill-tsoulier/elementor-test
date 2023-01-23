<?php
/**
 * Par : Théo SOULIER
 * Le : 23 Janvier 2023 à 17:20
 * Objectif : Bloc contenant un contenue eombed
 * Type : création
 */
?>

<div class="container">
    <<?= $hn_spotify ?>><?= $title_spotify ?></<?= $hn_spotify ?>>
	<iframe style="border-radius:12px" src="<?= $spotify ?>" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
</div>

<?php // https://open.spotify.com/embed/track/4aZimfmIkor09z5eJc6plZ?utm_source=generator
