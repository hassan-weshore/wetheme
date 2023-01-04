<?php
$btn_devis_attrs = '';

if(!empty($settings['btn_devis_enable'])) {
    if(!empty($settings['btn_devis_url'])) {
        foreach ($settings['btn_devis_url'] as $key => $setting) {
            if($key == 'url') {
                $btn_devis_attrs .= ' href="'.$setting.'" ';
            }
            if($key == 'is_external' &&  $setting) {
                $btn_devis_attrs .= ' target="_blank" ';
            }
            if($key == 'nofollow' && $setting) {
                $btn_devis_attrs .= ' rel="nofollow" ';
            }
        }
    }
}

?>

<header class="container header-core" id="header-four">
    <div class="row d-flex align-items-center">
        <div class="col-sm-2 col-5">
            <?php if(!empty($logo) || !empty($logo_tablet) || !empty($logo_mobile)):?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <span class="d-none d-lg-block logo-desktop">
                        <?php echo $logo ;?>
                    </span>
                    <span class="d-none d-sm-block d-lg-none logo-tablet">
                        <?php echo $logo_tablet ;?>
                    </span>
                    <span class="d-block d-sm-none logo-mobile">
                        <?php echo $logo_mobile ;?>
                    </span>
                </a>
            <?php endif;?>
        </div>
        <div class="col-sm-9 col-5 text-end">
            <?php if(!empty($settings['btn_phone_enable']) && $settings['btn_phone_enable'] == 'yes'):?>
                <a class="btn-header btn-phone" href="tel:<?php echo $settings['btn_phone_number']?>" role="button"><i class="fas fa-phone-alt"></i> <span class="text d-none d-md-inline"><?php echo $settings['btn_phone_text'] ?></span></a>
            <?php endif;?>
            <?php if(!empty($settings['btn_devis_enable']) && $settings['btn_devis_enable'] == 'yes'):?>
                <?php if(!empty($settings['btn_devis_url'])):?>
                    <?php foreach ($settings['btn_devis_url'] as $key => $setting):?>
                        <?php endforeach;?>
                        <a class="btn-header btn-devis" role="button" <?php echo $btn_devis_attrs;?> ><i class="fas fa-envelope d-inline d-md-none"></i><span class="d-none d-md-inline"><?php echo $settings['btn_devis_text']; ?></span></a>
                <?php endif;?>
            <?php endif;?>
        </div>
        <div class="col-sm-1 col-2">
            <div class="menu menu-burger">
                <span class="toggle-icon-line"></span>
                <span class="toggle-icon-line"></span>
                <span class="toggle-icon-line"></span>
            </div>
        </div>
    </div>
    <nav class="nav-bar-container header-core-navbar">
        <?php
            if(!empty($menu)) {
                wp_nav_menu([
                    'menu' => $settings['nav_menu'],
                    'menu_class' => 'menu_navbar',
                ]);
            }
        ?>
    </nav>
</header>