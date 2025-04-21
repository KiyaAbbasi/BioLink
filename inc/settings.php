<?php
global $license_bio;
$font_dir = BIO_PLUGIN_DIR . '/elementor/assets/fonts/webfonts';
$font_dirs = array_filter(glob($font_dir . '/*'), 'is_dir');

// Get the list of widgets
$widgets = glob( BIO_PLUGIN_DIR . '/elementor/widgets/*.php' );
$counter = 1;


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_fonts'])) {
    $selected_fonts = isset($_POST['fonts']) ? array_map('sanitize_text_field', $_POST['fonts']) : [];
	$selected_widgets = isset( $_POST['widgets'] ) ? array_map( 'sanitize_text_field', $_POST['widgets'] ) : [];
	$load_css_bio_link = isset( $_POST['load_css_bio_link'] ) ? true : false;

	update_option( 'bio_link_selected_widgets', $selected_widgets );
	update_option( 'load_css_bio_link', $load_css_bio_link );
	update_option( 'bio_link_selected_fonts', $selected_fonts );
	update_bio_fonts( $selected_fonts );
    echo '<div class="updated"><p>' . __('تنظیمات با موفقیت ذخیره شد', BIO_PLUGIN_NAME) . '</p></div>';
}
?>
<div class="wrap bio-link-fonts-page">
    <h1 class="font-Morabba"><?php _e( 'مدیریت فونت ها و ویجت ها', BIO_PLUGIN_NAME ); ?></h1>
    <form method="post" class="">
        <div class="title-container">
            <h2 class="font-Modam"><?php _e( 'فونت ها', BIO_PLUGIN_NAME ); ?></h2>
            <a id="toggle-select-all-font" class="bio-link-font-button font-iranyekan"><?php _e( 'Select All', BIO_PLUGIN_NAME ); ?></a>
        </div>
        <div class="bio-link-fonts-form">
            <?php foreach ($font_dirs as $dir) {
                $font_name = basename($dir);
                ?>
                <div class="bio-link-font-option">
                    <label>
                        <input type="checkbox" class="fonts" name="fonts[]" value="<?php echo esc_attr($font_name); ?>" <?php checked(in_array($font_name, get_option('bio_link_selected_fonts', []))); ?>>
                        <span class="font-<?php echo $font_name; ?>"><?php echo  __('فونت زیبا و دلنواز ', BIO_PLUGIN_NAME) . esc_html($font_name) ; ?></span>
                    </label>
                </div>
            <?php } ?>
        </div>
        <?php
			if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
				?>
                <div class="notice notice-error is-dismissible import-done">
                    <p><?php _e( 'Elementor is not installed or activated on your site, you need to activate the Elementor plugin to insert the demos completely.', BIO_PLUGIN_NAME ); ?></p>
                </div>
                <?php
            }
            else{
                ?>
                <div class="title-container">
                    <h2 class="font-Modam"><?php _e('ویجت ها', BIO_PLUGIN_NAME); ?></h2>
                    <a id="toggle-select-all-widget" class="bio-link-font-button font-iranyekan"><?php _e( 'Select All', BIO_PLUGIN_NAME ); ?></a>
                </div>

                <div class="bio-link-fonts-form">
            
                <?php
                foreach ($widgets as $widget) {
                    require_once $widget;
                    $class_name = basename($widget, '.php');
                    $widget_instance = new $class_name();
                    $widget_title = $widget_instance->get_title();
                    ?>
                    <div class="bio-link-font-option">
                        <label class="font-iranyekan">
                            <input type="checkbox" class="widgets" name="widgets[]" value="<?php echo esc_attr($class_name); ?>" <?php checked(in_array($class_name, get_option('bio_link_selected_widgets', []))); ?>>
                            <?php echo esc_html( $counter ); ?>
                            <img src="<?php echo BIO_PLUGIN_URL . '/elementor/assets/img/' . $class_name . '.png'; ?>">
                            <?php echo esc_html( $widget_title ); ?>
                        </label>
                    </div>
                    <?php
                    $counter++;
                }
            }
            ?>
        </div>
        <div class="title-container">
            <h2 class="font-Modam"><?php _e( 'سایر تنظیمات', BIO_PLUGIN_NAME ); ?></h2>
        </div>
            <label class="font-iranyekan">
                <input type="checkbox" name="load_css_bio_link" value="load_css_bio_link" <?php if( get_option( 'load_css_bio_link' ) == true ){ echo 'checked'; } ?>>
				<?php echo __( 'لود بهینه css', BIO_PLUGIN_NAME ); ?>
            </label>
        <div class="bio-link-font-save">
            <?php
            if ( $license_bio == 'active' ) { ?>
            <button type="submit" name="save_fonts" class="button bio-link-font-button font-iranyekan"><?php _e('ذخیره', BIO_PLUGIN_NAME); ?></button>
            <?php } ?>
        </div>
    </form>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var fontsPage = document.querySelector('.bio-link-fonts-page');
        if (fontsPage) {
            var wpcontent = fontsPage.closest('#wpcontent');
            if (wpcontent) {
                wpcontent.classList.add('bio-plugin-background');
                wpcontent.style.backgroundColor = '#f0f0f0'; // Example style
            }
        }
    });
    var toggleSelectAllButton = document.getElementById('toggle-select-all-widget');
    var checkboxes = document.querySelectorAll('.bio-link-fonts-form .widgets');

    function updateButtonTextWidgets() {
        var allChecked = Array.from(checkboxes).every(function(checkbox) {
            return checkbox.checked;
        });

        toggleSelectAllButton.textContent = allChecked ? '<?php _e( 'لغو انتخاب', BIO_PLUGIN_NAME ); ?>' : '<?php _e( 'Select All', BIO_PLUGIN_NAME ); ?>';
        }

        toggleSelectAllButton.addEventListener( 'click', function ()
        {
            var allChecked = Array.from( checkboxes ).every( function ( checkbox )
            {
                return checkbox.checked;
            } );

            checkboxes.forEach( function ( checkbox )
            {
                checkbox.checked = !allChecked;
            } );

            updateButtonTextWidgets();
        } );

        checkboxes.forEach( function ( checkbox )
        {
            checkbox.addEventListener( 'change', function ()
            {
                updateButtonTextWidgets();
            } );
        } );

        // Initial check and update button text
        updateButtonTextWidgets();


    var toggleSelectAllButton_font = document.getElementById('toggle-select-all-font');
    var checkboxes_font = document.querySelectorAll('.bio-link-fonts-form .fonts');

    function updateButtonTextFonts() {
        var allChecked = Array.from(checkboxes_font).every(function(checkbox) {
            return checkbox.checked;
        });

        toggleSelectAllButton_font.textContent = allChecked ? '<?php _e( 'لغو انتخاب', BIO_PLUGIN_NAME ); ?>' : '<?php _e( 'Select All', BIO_PLUGIN_NAME ); ?>';
        }

        toggleSelectAllButton_font.addEventListener( 'click', function ()
        {
            var allChecked = Array.from( checkboxes_font ).every( function ( checkbox )
            {
                return checkbox.checked;
            } );

            checkboxes_font.forEach( function ( checkbox )
            {
                checkbox.checked = !allChecked;
            } );

            updateButtonTextFonts();
        } );

        checkboxes_font.forEach( function ( checkbox )
        {
            checkbox.addEventListener( 'change', function ()
            {
                updateButtonTextFonts();
            } );
        } );

        // Initial check and update button text
        updateButtonTextFonts();
</script>
<?php

$widgets = glob(__DIR__ . '/widgets/*.php');
$counter = 1;
