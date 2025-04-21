<!DOCTYPE html>
<!-- هر گونه استفاده از کد های این افزونه بدون خریداری لایسنس پیگرد قانونی دارد -->
<html lang="fa" dir="rtl" data-theme="light">
<head>
    <?php wp_head(); ?>
</head>

<body>
    <div class="main-layout bio-link-fonts-page">
        <div class="container">
            <div class="row">
                <div class="element_content col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 mt-md-5 mb-2 mt-2 mb-md-5 mx-auto" style="padding: 15px !important; border: 10px solid rgb(235 234 234); background:White;">
                    <div class="social-media">          
                        <div data-name="form">
                            <div class="contacts">
                                <div class="title-section font-Morabba">
                                    ایجاد فایل مخاطب
                                </div>
                                <p class="text-center font-iranyekan">
                                    جهت ایجاد فایل قابل ذخیره اطلاعات شما در گوشی مخاطبین خود فرم زیر را تکمیل کرده و فایل ایجاد شده را در قسمت لینک مربوط ویجت ذخیره مخاطب قرار دهید
                                </p>
                                <form id="contactForm" class="vcf-form">
                                    <div class="form-group">
                                        <label for="firstName" class="font-Modam"><i class="bi bi-person fas"></i><?php echo __('نام', BIO_PLUGIN_NAME ); ?></label>
                                        <input type="text" class="form-control font-iranyekan" id="firstName" placeholder="<?php echo __( 'نام', BIO_PLUGIN_NAME ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName" class="font-Modam"><i class="bi bi-person fas"></i><?php echo __( 'نام خانوادگی', BIO_PLUGIN_NAME ); ?></label>
                                        <input type="text" class="form-control font-iranyekan" id="lastName" placeholder="<?php echo __( 'نام خانوادگی', BIO_PLUGIN_NAME ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber" class="font-Modam"><i class="bi bi-phone fas"></i><?php echo __( 'شماره تماس', BIO_PLUGIN_NAME ); ?></label>
                                        <input type="tel" class="form-control font-iranyekan" id="phoneNumber" placeholder="<?php echo __( 'شماره تماس', BIO_PLUGIN_NAME ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="font-Modam"><i class="bi bi-envelope fas"></i><?php echo __('ایمیل', BIO_PLUGIN_NAME ); ?></label>
                                        <input type="email" class="form-control font-iranyekan" id="email" placeholder="<?php echo __('ایمیل', BIO_PLUGIN_NAME ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="website" class="font-Modam"><i class="bi bi-filetype-html fas"></i><?php echo __('وب سایت', BIO_PLUGIN_NAME ); ?></label>
                                        <input type="url" class="form-control font-iranyekan" id="website" placeholder="<?php echo __('وب سایت', BIO_PLUGIN_NAME ); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="font-Modam"><i class="bi bi-chat-left-text fas"></i><?php echo __('توصیف', BIO_PLUGIN_NAME ); ?></label>
                                        <textarea class="form-control" id="description" rows="3" placeholder="<?php echo __('توصیف', BIO_PLUGIN_NAME ); ?>"></textarea>
                                    </div>
                                    <div class="row social-row">
                                        <div class="col itunes">
                                            <a href="" id="generateVCF" class="font-Modam"><?php echo __( 'ایجاد فایل مخاطب', BIO_PLUGIN_NAME ); ?></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </script>
</body>

</html>