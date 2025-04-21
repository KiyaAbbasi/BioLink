
<div class="bio-link-fonts-page">
    <h1 class="font-Morabba demo-import-page-title"><?php _e( 'our products', BIO_PLUGIN_NAME ); ?></h1>
    <div class="bio-link-importer-grid">
        <?php
        $json_url = 'https://www.armanhub.ir/product.json';
        try {
            $json_data = @file_get_contents($json_url);
        } catch (\Throwable $th) {
            $json_data = false;
        }
        if ($json_data !== false) {
            $products = json_decode($json_data, true);

            if ($products) {
                foreach ($products as $product) {
                    echo '<a href="' . htmlspecialchars($product['link']) . '" class="cart-hover-29">';
                    echo '<div class="our-product-card">';
                    echo '<div class="image-container">';
                    echo '<img class="image" src="' . htmlspecialchars($product['image']) . '" alt="'. htmlspecialchars($product['title']) .'">';
                    echo '</div>';
                    echo '<h2 class="font-Modam">' . htmlspecialchars($product['title']) . '</h2>';
                    echo '<p class="font-iranyekan">' . htmlspecialchars($product['description']) . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo __('It is not possible to connect to the server and receiving the information of our other products has encountered an error. Please try again later', BIO_PLUGIN_NAME);
            }
        } else {
            echo __('It is not possible to connect to the server and receiving the information of our other products has encountered an error. Please try again later', BIO_PLUGIN_NAME);
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