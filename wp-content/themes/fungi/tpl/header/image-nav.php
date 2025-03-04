<?php
$logo_site = themesflat_get_url_option('site_image_menu');

if ($logo_site) : ?>
    <div class="image-nav-header">
        <?php if (!empty($logo_site)) { ?>
            <img class="image-nav" src="<?php echo esc_url($logo_site); ?>" alt="image"/>
        <?php } ?>
    </div>
<?php endif; ?>