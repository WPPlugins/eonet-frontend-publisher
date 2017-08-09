<?php
$themes = \Eonet\Core\Admin\EonetAdmin::getThemes();
?>
<div id="eo_admin_tab_<?php echo $slug; ?>" class="eo_admin_tab">

    <div id="eo_admin_tab_title_<?php echo $slug; ?>" class="eo_admin_tab_title">

        <h1><?php echo $name; ?></h1>

    </div>

    <div id="eo_admin_content_<?php echo $slug; ?>" class="eo_admin_tab_content">

        <p>
            <strong><?php _e('Do you want your site to looks nice ?', 'eonet-frontend-publisher'); ?></strong>
            <?php _e('Our team is here to help you out at anytime.', 'eonet-frontend-publisher'); ?>
            <?php _e('If you have any idea about how we could improve.', 'eonet-frontend-publisher'); ?>
        </p>

        <ul id="eo_themes_list" class="eo_boxes_list wp-clearfix">

            <?php foreach ($themes as $theme) : ?>

                <li id="eo_theme_<?php echo eonet_camel($theme['name']); ?>" class="eo_single_box wp-clearfix">
                    <div class="eo_single_left">
                        <img src="<?php echo $theme['thumb']; ?>">
                    </div>
                    <div class="eo_single_right">
                        <div class="eo_single_inner">
                            <h4><?php echo $theme['name']; ?></h4>
                            <ul class="eo_styled_list eo_colored_list eo_features_list">
                                <?php foreach($theme['features'] as $feature) : ?>
                                    <li><?php echo $feature; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="text-right">
                                <a href="<?php echo $theme['link_features']; ?>" class="eo_btn eo_btn_default">
                                    <?php _e('All features', 'eonet-frontend-publisher'); ?>
                                </a>
                                <a href="<?php echo $theme['link_demo']; ?>" class="eo_btn eo_btn_default">
                                    <?php _e('Demo', 'eonet-frontend-publisher'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

            <?php endforeach; ?>

        </ul>

    </div>

</div>