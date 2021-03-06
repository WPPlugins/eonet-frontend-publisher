<?php
// We get the extensions :
$extensions = Eonet\Core\EonetComponents::getComponents();
$active_extensions = Eonet\Core\EonetComponents::getActiveComponents();
?>
<div id="eo_admin_tab_<?php echo $slug; ?>" class="eo_admin_tab">

    <div id="eo_admin_tab_title_<?php echo $slug; ?>" class="eo_admin_tab_title">

        <h1><?php echo $name; ?></h1>

    </div>

    <div id="eo_admin_content_<?php echo $slug; ?>" class="eo_admin_tab_content">

        <ul id="eo_components_list" class="eo_boxes_list wp-clearfix">
            <?php foreach ($extensions as $slug=>$extension) : ?>
                <?php
                // if active :
                $state_class = (array_key_exists($slug, $active_extensions)) ? 'is-active' : 'not-active';
                // if coming soon :
                $coming_class = (version_compare($extension['version'], '0.9.9') != 1) ? 'is-soon' : 'is-released';
                ?>
                <li class="eo_single_box wp-clearfix <?php echo $state_class . ' ' . $coming_class; ?>">
                    <?php // if coming soon :
                    if(version_compare($extension['version'], '0.9.9') != 1) : ?>
                        <div class="eo_extension_soon">
                            <span><?php _e('Coming Soon', 'eonet-frontend-publisher'); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="eo_single_left">
                        <div class="eo_single_icon_wrapper">
                            <i class="<?php echo $extension['icon']; ?>"></i>
                        </div>
                    </div>
                    <div class="eo_single_right">
                        <div class="eo_single_inner">
                            <h4>
                                <?php echo $extension['name']; ?>
                                <!--
                                <span><?php _e('Version', 'eonet-frontend-publisher'); ?> : <?php echo $extension['version']; ?></span>
                                -->
                            </h4>
                            <p><?php echo $extension['description']; ?></p>
                            <div class="activation_button_wrap">
                                <?php if($state_class == 'not-active') :  ?>
                                    <a href="javascript:void(0);" data-eo-action="activate" data-eo-component="<?php echo $slug; ?>" class="eo_component_state_trigger eo_btn eo_btn_default">
                                        <i class="fa fa-toggle-off"></i>
                                        <?php _e('Activate', 'eonet-frontend-publisher'); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="javascript:void(0);" data-eo-action="deactivate" data-eo-component="<?php echo $slug; ?>" class="eo_component_state_trigger eo_btn eo_btn_default">
                                        <i class="fa fa-toggle-on"></i>
                                        <?php _e('Deactivate', 'eonet-frontend-publisher'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

    <script type="text/javascript">

        <?php //Security :
        $component_action = 'eonet_admin_state_component';
        $component_nonce = wp_create_nonce( $component_action . '_nonce' );
        ?>

        (function ($) {

	        $(document).ready(function(){

		        //Set the same height for all componenets cards
		        //(in order to avoid mess up with float left)
		        set_height_of_the_componenet_cards();
	        });

            $('.eo_component_state_trigger').on('click', function (e) {
                e.preventDefault();
                // Loader :
                $('#eo_admin_content_extensions').addClass('has_loader_colored');
                $('.has_loader_colored').eonetLoader({'colored': true});
                // Get the data :
                var data = {
                    'action' : '<?php echo $component_action; ?>',
                    'method' : $(this).data('eo-action'),
                    'component' : $(this).data('eo-component'),
                    'security' : '<?php echo $component_nonce; ?>'
                };
                // We make the request :
                $.post(ajaxurl, data, function(response) {
                    if(response.substring(0,10) == '{"status":') {
                        var object = JSON.parse(response);
                        if(object.length != 0) {
                            // Alert :
                            var alertClass = (object.status == 'success') ? 'fa-check-circle' : 'fa-times';
                            $.eonetNotification(alertClass, object.title, object.content);
                        }
                    } else {
                        if(response.length > 0) {
                            var title = "<?php _e('We\'re installing the extension !', 'eonet-frontend-publisher'); ?>";
                            var content = "<?php _e('The page will be refreshed in a few seconds...', 'eonet-frontend-publisher'); ?>";
                            $.eonetNotification('fa-check-circle', title, content);
                        }
                    }
                    $('#eo_admin_content_extensions').removeClass('has_loader_colored');
                    // Page refresh
                    setTimeout(function () {
                        location.reload(true);
                    }, 1500);
                    return false;
                });

            });

	        function set_height_of_the_componenet_cards() {
		        var eoCards = $('.eo_single_box');

		        if(eoCards.length > 0) {
			        var maxHeight = Math.max.apply(null, eoCards.map(function ()
			        {
				        return $(this).height();
			        }).get());

                    eoCards.height(maxHeight);
		        }
	        }

        })(jQuery);

    </script>

</div>