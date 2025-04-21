<?php
global $license_bio ;
if ( isset( $_GET['imported'] ) && $_GET['imported'] == 'true' && isset( $_GET['post_id'] ) ) {
    $post_id = intval( $_GET['post_id'] );
    $post_url = get_permalink( $post_id );
    echo '<div class="notice notice-success is-dismissible import-done">';
    echo '<p class="font-iranyekan">' . __( 'ایمپورت دمو با موفقیت انجا مشد.', BIO_PLUGIN_NAME ) . '</p>';
    echo '<button class="button bio-link-font-button "><a class="font-iranyekan" href="' . esc_url( $post_url ) . '" target="_blank">' . __( 'مشاهده صفحه درون ریزی شده', BIO_PLUGIN_NAME ) . '</a></button>';
    echo '</div>';
}

if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
	?>
    <div class="notice notice-error is-dismissible import-done">
        <p class="font-iranyekan"><?php _e( 'Elementor is not installed or activated on your site, you need to activate the Elementor plugin to insert the demos completely.', BIO_PLUGIN_NAME ); ?></p>
    </div>
    <?php
}
?>

<div class="bio-link-fonts-page">
    <h1 class="font-Morabba demo-import-page-title"><?php _e( 'درون ریز بایو لینک', BIO_PLUGIN_NAME ); ?></h1>
    <?php
        if ($license_bio != 'active') {
            echo '<p class="license-desc font-iranyekan" style="margin: 0 0 50px 0; font-size:22px;">جهت استفاده از دمو های بایو لینک لایسنس خود را فعال نمایید</p>'; 
        }
        ?>
    <div class="bio-link-importer-grid">
        <?php
        for ( $i = 1; $i <= 10; $i++ ) {
            echo '<div class="bio-link-importer-card cart-hover-29">';
            echo '<div class="image-container scrollable" >';
            echo '<img class="image" src="' .  BIO_PLUGIN_URL . '/demo/' . $i . '.png" alt="Sample Image">';
            echo '</div>';
            echo '<h2 class="font-Modam">' . __( 'بایو لینک ', BIO_PLUGIN_NAME ) . $i . '</h2>';
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="bio_link_import_file" value="' . BIO_PLUGIN_DIR . '/demo/' . $i . '.xml">';
            echo '<button class="button bio-link-font-button font-iranyekan"><a href="https://bio-plugin.armanhub.ir/demo/b' . $i .'/" target="_blank">' . __('دمو', BIO_PLUGIN_NAME) . '</a></button>';
            if ($license_bio == 'active') {
                echo '<button type="submit" class="button bio-link-font-button font-iranyekan">' . __( 'وارد کردن', BIO_PLUGIN_NAME ) . '</button>';
            }
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the success message is present
            var successMessage = document.querySelector('.import-done');
            if (successMessage) {
                // Remove the query parameters from the URL
                var url = new URL(window.location.href);
                url.searchParams.delete('imported');
                url.searchParams.delete('post_id');
                window.history.replaceState({}, document.title, url.toString());
            }
            var fontsPage = document.querySelector('.bio-link-fonts-page');
            if (fontsPage) {
                var wpcontent = fontsPage.closest('#wpcontent');
                if (wpcontent) {
                    wpcontent.classList.add('bio-plugin-background');
                    wpcontent.style.backgroundColor = '#f0f0f0'; // Example style
                }
            }
        });
</script>

</div>

<?php