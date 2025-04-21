<?php
global $license_bio ;
?>
<div class="wrap about-wrap body-admin">
    <div class="theme-header">
        <div class="intro">
            <h2 class="font-Modam">به بایو لینک خوش آمدید ❤️</h2>
            <h4 class="font-Modam">بایو لینک - سازنده لینک بایوی شما</h4>
            <p class="desc font-iranyekan">استفاده از بایو لینک از اون چیزی که فکر میکنی راحت تره، همراه من باش تا خیلی راحت بهت بگم چی کار نیازه انجام بدی، راستی نسخه html قالب هم داخل راستچین موجود هست و در صورت نیاز می تونید خرید کنید، اگر هم نیاز به پشتیبانی داشتید از طریق سایت راستچین می تونید تیکت ثبت کنید در اولین فرصت بهتون جواب میدیم</p>
            <div class="theme-infos">
                <span><a class="font-iranyekan" href="https://www.rtl-theme.com/biolink-html-template/">مشاهده نسخه html</a></span>
                <span><a class="font-iranyekan"
                <?php
				if ( $license_bio == 'active' ) {
					echo 'href="https://www.bio-plugin.armanhub.ir/background.zip"';
				} ?>
                    >دانلود تصاویر</a></span>
                <span class="font-iranyekan">نسخه فعلی: 1.0.0</span>
                <?php
                if ($license_bio == 'active') {
                    echo '<span class="license font-iranyekan">لایسنس شما فعال می باشد</span>';
                }
                else{
                    echo '<span class="no-license font-iranyekan">لایسنس شما فعال نمی باشد</span>';
                    echo '<p class="license-desc font-iranyekan">جهت استفاده از بایو لینک لایسنس خود را فعال نمایید</p>'; 
                }
                ?>
            </span>
        </div>
        </div>
        <div class="theme-image">
            <?php 
            $plugin_url = plugin_dir_url( __FILE__ );
            $image_path = $plugin_url . '../assets/images/admin-help/0.png';  
            echo '<img src="'. $image_path .'" alt="قالب بایو لینک" width="50" height="100">';
            ?>
        </div>
    </div>
    <div class="main-body">
        <ul>
            <li>
                <p class="font-iranyekan">1) در اولین مرحله یک صفحه دلخواه برای خودتون ایجاد کنید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/1.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">2) قالب صفحه را بر روی قالب بایو لینک تنظیم کنید و صفحه را ذخیره کنید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/2.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">3) بعد از ذخیره قسمت تنظیمات  بایو لینک به انتهای صفحه اضافه می شود در اولین مرحله حاشیه بالا رو انتخاب کنید، همچنین در صورتی که نیاز به حاشیه ندارید آخرین گزینه را انتخاب نمایید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/3.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">4) در بعدی مرحله نیاز است تا حاشیه پایین را انتخاب نمایید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/4.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">5) در قسمت بعدی شما می توانید رنگ مورد نظر کادر گوشی را انتخاب نمایید، پیشنهاد میکنیم از رنگ سفید یا مشکی استفاده کنید </p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/5.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">6) در این قسمت شما می توانید در صورت نیاز برای پس زمینه رنگ و یا تصویر را انتخاب کنید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/6.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">7) در نهایت می توانید برای فریم موبایل رنگ پس زمینه و یا تصویر انتخاب نمایید، پیشنهاد میشود در صورت استفاده از تصویر، از تصاویر مات استفاده شود</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/7.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">8) در اخرین مرحله صفحه را ذخیره نمایید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/8.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">9) اکنون شما می توانید صفحه ذخیره شده را با المنتور ویرایش کنید و با ویجت های بایو لینک، صفحه مورد نظرت خود را طراحی کنید</p>
                <?php 
                $plugin_url = plugin_dir_url( __FILE__ );
                $image_path = $plugin_url . '../assets/images/admin-help/9.png';  
                echo '<img src="'. $image_path .'">';
                ?>
            </li>
            <li>
                <p class="font-iranyekan">10) داخل بایو پیجتون قرار بدین و لذت ببرید:)</p>

            </li>
        </ul>
    </div>
</div>
