<?php

$options = carbon_get_theme_option( 'mc_mm_items' );

do_action( "qm/debug", $options );

$links = [];
$backgrounds = [];

function render_menu_items( $items, $level = 1, $parent_index = '', $target = '' ) {
	$output = '<ul class="sub-menu sub-menu-level-' . $level . ' ' . $target . '" >';
	$index = 1;

	foreach ( $items as $item ) {
		$has_children = ! empty( $item['enable_children'] ) && $item['enable_children'] == "1";
		$target = "menu-" . $parent_index . $index;

		$output .= '<li class="nav-item ' . ( $has_children ? 'has-child' : '' ) . '">';
		$output .= '<span class="link-container" data-target="' . esc_attr( $target ) . '">';
		$output .= '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a>';
		if ( $has_children ) {
			$output .= '<span class="indicator"></span>';
		}
		$output .= '</span>';

		if ( $has_children && ! empty( $item['children'] ) ) {
			$output .= render_menu_items( $item['children'], $level + 1, $parent_index . $index . '-', $target );
		}

		$output .= '</li>';
		$index++;
	}

	$output .= '</ul>';
	return $output;
}

?>
<div class="header-content">
	<div class="logo">
		<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 70 40'%3E%3Ccircle cx='25' cy='20' r='15' fill='%23ff0000'/%3E%3Ccircle cx='45' cy='20' r='15' fill='%23ff9900'/%3E%3Ccircle cx='35' cy='20' r='7' fill='%23ff6600'/%3E%3C/svg%3E"
			alt="Mastercard" />
	</div>
	<div class="mobile-hamburger">
		<button class="open-mobile-menu">
			<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5 6.5H19V8H5V6.5Z" fill="#fff" />
				<path d="M5 16.5H19V18H5V16.5Z" fill="#fff" />
				<path d="M5 11.5H19V13H5V11.5Z" fill="#fff" />
			</svg>
		</button>
		<button class="close-mobile-menu">
			<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M12 10.9394L16.9697 5.96961L18.0304 7.03027L13.0606 12L18.0303 16.9697L16.9697 18.0304L12 13.0607L7.03045 18.0302L5.96979 16.9696L10.9393 12L5.96973 7.03042L7.03039 5.96976L12 10.9394Z"
					fill="#ffffff" />
			</svg>
		</button>
	</div>
	<div class="nav-container">
		<ul class="nav">
			<?php
			$i = 1;
			foreach ( $options as $option ) {
				$target = "header-background-{$i}";
				$has_children = ! empty( $option['enable_children'] ) && intval( $option['enable_children'] ) == 1;
				$background_image = ! empty( $option['background_image'] ) ? wp_get_attachment_image_url( $option['background_image'], 'full' ) : '';
				$backgrounds[ $target ] = wp_get_attachment_image_url( $option['background_image'], 'full' );

				// Render navigation item
				?>
				<li class="parent-item main-item nav-item <?php echo ( $has_children ? 'has-child' : '' ); ?>"
					data-target="<?php echo esc_attr( $target ); ?>">
					<span class="link-container">
						<a href="<?php echo esc_url( $option['url'] ); ?>"
							class="nav-link"><?php echo esc_html( $option['title'] ); ?>
						</a>
						<?php
						if ( $has_children ) {
							?>
							<span class="indicator"></span>
						<?php } ?>
					</span>
					<?php
					if ( $has_children && ! empty( $option['children'] ) ) {
						?>
						<span class="sub-menu-container">
							<?php echo render_menu_items( $option['children'], 1, $i . '-' ); ?>
						</span>
					<?php } ?>
				</li>
				<?php
				$i++;
			}
			?>

			<li class="search-container">
				<button class="display-search">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M15.5 14H14.71L14.43 13.73C15.41 12.59 16 11.11 16 9.5C16 5.91 13.09 3 9.5 3C5.91 3 3 5.91 3 9.5C3 13.09 5.91 16 9.5 16C11.11 16 12.59 15.41 13.73 14.43L14 14.71V15.5L19 20.49L20.49 19L15.5 14ZM9.5 14C7.01 14 5 11.99 5 9.5C5 7.01 7.01 5 9.5 5C11.99 5 14 7.01 14 9.5C14 11.99 11.99 14 9.5 14Z"
							fill="white" />
					</svg>
				</button>
				<div class="search-form-container">
					<div class="search-information">
						<p>Need help? We're always here when you need us</p>
						<ul>
							<li><a href="https://google.com">Get Support</a></li>
							<li>
								<a href="https://google.com">Report a lost or stolen card</a>
							</li>
							<li><a href="https://google.com">Find ATM</a></li>
						</ul>
					</div>
					<form method="get">
						<div class="search-input-placeholder">
							<svg width="800px" height="800px" viewBox="0 0 76 76" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full"
								enable-background="new 0 0 76.00 76.00" xml:space="preserve">
								<path fill="#ffffff" fill-opacity="1" stroke-width="0.2" stroke-linejoin="round"
									d="M 42.5,22C 49.4036,22 55,27.5964 55,34.5C 55,41.4036 49.4036,47 42.5,47C 40.1356,47 37.9245,46.3435 36,45.2426L 26.9749,54.2678C 25.8033,55.4393 23.9038,55.4393 22.7322,54.2678C 21.5607,53.0962 21.5607,51.1967 22.7322,50.0251L 31.7971,40.961C 30.6565,39.0755 30,36.8644 30,34.5C 30,27.5964 35.5964,22 42.5,22 Z M 42.5,26C 37.8056,26 34,29.8056 34,34.5C 34,39.1944 37.8056,43 42.5,43C 47.1944,43 51,39.1944 51,34.5C 51,29.8056 47.1944,26 42.5,26 Z " />
							</svg>
							<input type="text" name="s" class="search-input" placeholder="Search" />
						</div>
					</form>
				</div>
			</li>
		</ul>

		<button class="close-submenu">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50"
				width="36px" height="36px">
				<line fill="none" stroke="#fff" stroke-width="2" stroke-miterlimit="10" x1="7" y1="7" x2="43" y2="43" />
				<line fill="none" stroke="#fff" stroke-width="2" stroke-miterlimit="10" x1="43" y1="7" x2="7" y2="43" />
			</svg>
		</button>
	</div>
</div>
<?php foreach ( $backgrounds as $key => $background ) : ?>
	<div class="header-background <?php echo esc_attr( $key ); ?> hidden-background">
		<div class="the-background" style="background-image: url('<?php echo esc_url( $background ); ?>');">
		</div>
	</div>
<?php endforeach; ?>