<?php
/*
 * Template Name: بایو لینک
 * Description: قالب نمایش بایو لینک
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
	<meta charset="UTF-8">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>">
	<style>
    .element_content {
        border: <?php echo ( get_post_meta( get_the_ID(), 'headers', true ) == 'header-6' ) ? 'none' : '10px solid ' . esc_html( get_post_meta( get_the_ID(), 'border-color', true ) ); ?> !important;
		background-color: <?php echo esc_html( get_post_meta( get_the_ID(), 'mobile-background-color', true ) ); ?> !important;
		<?php if(get_post_meta( get_the_ID(), 'headers', true ) == 'header-6' ){ ?>
			box-shadow: <?php echo ( get_post_meta( get_the_ID(), 'headers', true ) == 'header-6' ) ? 'none' : NAN ?> !important;
		<?php }
		if(get_post_meta( get_the_ID(), 'back_img2', true ) !=null){?>
			background: url(<?php echo esc_html( get_post_meta( get_the_ID(), 'back_img2', true ) ); ?>) !important;
		<?php }?> 
	}
	.top-notch, .btn-notch{
		background: <?php echo esc_html( get_post_meta( get_the_ID(), 'border-color', true ) ); ?> !important;
	}
	.main-layout{
		background-color: <?php echo esc_html( get_post_meta( get_the_ID(), 'background-color', true ) ); ?>;
		background-image: url(<?php echo esc_html( get_post_meta( get_the_ID(), 'back_img', true ) ); ?>);
	}
	</style>
	<?php wp_head(); ?>
	
</head>
<body>
	<div class="main-layout">
		<div class="container " style=" max-width: 1320px !important;">
			<div class="row">
				<div
					class="element_content col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 mt-md-5 mb-2 mt-2 mb-md-5 mx-auto">
					<?php $value = get_post_meta( get_the_ID(), 'headers', true );
					switch ( $value ) {
						case 'header-1':
							echo '<div class="top-notch notch"></div>';
							break;
						case 'header-2':
							echo '<div class="top-notch notch-iphone7"></div>';
							break;
						case 'header-3':
							break;
						case 'header-4':
							echo '<div class="top-notch notch-mini"></div>';
							break;
						case 'header-5':
							echo '<div class="top-notch notch-samsung"></div>';
							break;
						default:
							break;
					}
					?>
					<?php the_content(); ?>
					
					<?php
					$value = get_post_meta( get_the_ID(), 'footers', true );
					switch ( $value ) {
						case 'footer-1':
							break;
						case 'footer-2':
							echo '
								<div class="btn-notch bottom-samsung">
									<div><i class="bi bi-arrow-return-left samsung-icon"></i></div>
									<div class="samsung-home"></div>
									<div><i class="bi bi-list samsung-icon"></i></div>
								</div>';
							break;
						case 'footer-3':
							echo '
								<div class="btn-notch bottom-xiaomy">
									<div><i class="bi bi-caret-left-fill xiaomy-icon"></i></div>
									<div><i class="bi bi-circle-fill xiaomy-icon"></i></div>
									<div><i class="bi bi-square-fill xiaomy-icon"></i></div>
								</div>';
							break;
						case 'footer-4':
							echo '
								<div class="btn-notch bottom-iphone">
									<div></div>
								</div>';
							break;
						default:
							break;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>

</html>