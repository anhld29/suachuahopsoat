<?php 
global $woocommerce;
$login_url = wp_login_url();
$logout_url = wp_logout_url();
$register_url = wp_registration_url();
if(defined('WOOCOMMERCE_VERSION')){
	$login_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
	$logout_url = wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) );
}
?>
<header id="header" class="header-container page-heading-0 header-type-classic header-navbar-classic header-scroll-resize" itemscope="itemscope" itemtype="<?php echo dh_get_protocol()?>://schema.org/Organization" role="banner">
	
	<?php if(dh_get_theme_option('show-topbar',1)):?>
		<div class="topbar">
			<div class="<?php dh_container_class() ?> topbar-wap">
				<div class="row">
					<div class="col-sm-6 col-left-topbar">
						<div class="left-topbar">
	            			<?php
	            			
	            				$left_topbar_content = dh_get_theme_option('left-topbar-content','info');
		            			if($left_topbar_content === 'info'): 
		            				echo '<div class="topbar-info">';
		            				if(dh_get_theme_option('left-topbar-phone','(123) 456 789'))
		            					echo '<a href="#"><i class="fa fa-phone"></i> '.esc_html(dh_get_theme_option('left-topbar-phone','(123) 456 789')).'</a>';
		            				if(dh_get_theme_option('left-topbar-email','info@domain.com'))
		            					echo '<a href="mailto:'.esc_attr(dh_get_theme_option('left-topbar-email','info@domain.com')).'"><i class="fa fa-envelope-o"></i> '.esc_html(dh_get_theme_option('left-topbar-email','info@domain.com')).'</a>';
		            				if(dh_get_theme_option('left-topbar-skype','skype.name'))
		            					echo '<a href="skype:'.esc_attr(dh_get_theme_option('left-topbar-skype','skype.name')).'?call"><i class="fa fa-skype"></i> '.esc_html(dh_get_theme_option('left-topbar-skype','skype.name')).'</a>';
		            				echo '</div>';
		            			elseif ($left_topbar_content === 'custom'):
		            				echo (dh_get_theme_option('left-topbar-custom-content',''));
		            			endif;
		            			?>
		            			<?php 
		            			if(($left_topbar_content == 'menu_social')):
		            			echo '<div class="topbar-social">';
		            			dh_social(dh_get_theme_option('left-topbar-social',array('facebook','twitter','google-plus','pinterest','rss','instagram')),true);
		            			echo '</div>';
		            			endif;
	            			
	            			?>
	            			
						</div>
					</div>
					<div class="col-sm-6 col-right-topbar">
						<div class="right-topbar">
							<div class="user-login">
	            				<ul class="nav top-nav">
	            					<?php 
	            					if ( has_nav_menu( 'top' ) ) :
	            					wp_nav_menu( array(
	            						'theme_location'    => 'top',
	            						'depth'             => 2,
	            						'container'         => false,
	            						'items_wrap' 		=> '%3$s',
	            						'walker'            => new DH_Walker
	            					));
	            					endif;
	            					?>
	            					<li class="menu-item<?php if(is_user_logged_in()):?> menu-item-has-children dropdown<?php endif;?>">
	            						<a <?php if(!is_user_logged_in()): ?>  <?php if (apply_filters('dh_user_login_modal', true)){?>data-rel="loginModal"<?php }?> <?php endif;?> href="<?php echo esc_url($login_url) ?>"> 
	            							<?php if(!is_user_logged_in()): ?><?php esc_html_e('Login','woow')?><?php else:?><?php esc_html_e('Account','woow')?><?php endif;?>
			            					<?php if(is_user_logged_in()):?>
			            						<span class="caret"></span>
			            					<?php endif;?>
			            				</a>
			            				<?php if(is_user_logged_in()):?>
										<ul class="dropdown-menu" role="menu">
											<li class="menu-item">
												<a href="<?php echo esc_url($logout_url) ?>"><i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'woow'); ?></a>
											</li>
										</ul>
										<?php endif;?>
	            					</li>
	            				</ul>
	            			</div>

							<?php if(function_exists('icl_get_languages') && apply_filters('dhicl_languages_switcher', true)){?>
								<div class="language-switcher">
									<?php 
									//do_action('icl_language_selector'); 
									$languages = icl_get_languages();
									if( is_array( $languages ) ){
									
										foreach( $languages as $lang_k=>$lang ){
											if( $lang['active'] ){
												$active_lang = $lang;
												unset( $languages[$lang_k] );
											}
										}
											
										// disabled
										if( count( $languages ) ){
											$lang_status = 'enabled';
										} else {
											$lang_status = 'disabled';
										}
									
										echo '<div class="wpml-languages '. $lang_status .'">';
										echo '<a class="active" href="'. $active_lang['url'] .'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
										echo '<img src="'. $active_lang['country_flag_url'] .'" alt="'. $active_lang['translated_name'] .'"/> '.strtoupper($active_lang['language_code']);
										echo '</a>';
											
										if( count( $languages ) ){
											echo '<ul class="wpml-lang-dropdown dropdown-menu">';
											foreach( $languages as $lang ){
												echo '<li><a href="'. $lang['url'] .'"><img src="'. $lang['country_flag_url'] .'" alt="'. $lang['translated_name'] .'"/> '.strtoupper($lang['language_code']).'</a></li>';
											}
											echo '</ul>';
										}
											
										echo '</div>';
									
									}
									?>
								</div>
							<?php } ?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
	<div class="navbar-container">
		<div class="navbar navbar-default <?php if(dh_get_theme_option('sticky-menu',1)):?> navbar-scroll-fixed<?php endif;?>">
			<div class="navbar-default-wrap">
				<div class="<?php dh_container_class() ?>">
					<div class="row">
						<div class="navbar-default-col">
							<div class="navbar-wrap">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle">
										<span class="sr-only"><?php echo esc_html__('Toggle navigation','woow')?></span>
										<span class="icon-bar bar-top"></span> 
										<span class="icon-bar bar-middle"></span> 
										<span class="icon-bar bar-bottom"></span>
									</button>
									<?php if(dh_get_theme_option('ajaxsearch',1)){ ?>
									<a class="navbar-search-button search-icon-mobile" href="#">
										<svg xml:space="preserve" style="enable-background:new 0 0 612 792;" viewBox="0 0 612 792" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" version="1.1">
											<g>
												<g>
													<g>
														<path d="M231,104c125.912,0,228,102.759,228,229.5c0,53.034-18.029,101.707-48.051,140.568l191.689,192.953
															c5.566,5.604,8.361,12.928,8.361,20.291c0,7.344-2.795,14.688-8.361,20.291C597.091,713.208,589.798,716,582.5,716
															s-14.593-2.792-20.139-8.396L370.649,514.632C332.043,544.851,283.687,563,231,563C105.088,563,3,460.241,3,333.5
															S105.088,104,231,104z M231,505.625c94.295,0,171-77.208,171-172.125s-76.705-172.125-171-172.125
															c-94.295,0-171,77.208-171,172.125S136.705,505.625,231,505.625z"/>
													</g>
												</g>
											</g>
										</svg>
									</a>
									<?php } ?>
							    	<?php if(defined('WOOCOMMERCE_VERSION') && dh_get_theme_option('woo-cart-mobile',1)):?>
							     	<?php 
							     	$cart_url = wc_get_cart_url();
							     	?>
									<a class="cart-icon-mobile" href="<?php echo esc_url($cart_url) ?>"><i class="elegant_icon_bag"></i><span><?php echo absint($woocommerce->cart->cart_contents_count)?></span></a>
									<?php endif;?>
									<<?php echo apply_filters('dh_logo_tag', 'div')?> class="navbar-brand-title">
										<a class="navbar-brand" itemprop="url" title="<?php esc_attr(bloginfo( 'name' )); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
											<?php if(!empty($logo_url)):?>
												<img class="logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_url)?>">
											<?php else:?>
												<?php echo bloginfo( 'name' ) ?>
											<?php endif;?>
											<img class="logo-fixed" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_fixed_url)?>">
											<img class="logo-mobile" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_mobile_url)?>">
											<span itemprop="name" class="sr-only sr-only-focusable"><?php bloginfo('name')?></span>
										</a>
									</<?php echo apply_filters('dh_logo_tag', 'div')?>>
								</div>
								<div class="navbar-search-box"><?php echo dh_get_search_form()?></div>
								<div class="header-right">
									<div class="hotline">
										<i class="fa fa-phone"></i>
										<div class="txt-hotline">Hotline <span>0969.89.43.34</span></div>
									</div>
									<?php 
											if(dh_get_theme_option('ajaxsearch',1)){
										?>
											<div class="navbar-search">
												<a class="navbar-search-button visible-xs" href="#">
													<svg xml:space="preserve" style="enable-background:new 0 0 612 792;" viewBox="0 0 612 792" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" version="1.1">
														<g>
															<g>
																<g>
																	<path d="M231,104c125.912,0,228,102.759,228,229.5c0,53.034-18.029,101.707-48.051,140.568l191.689,192.953
																		c5.566,5.604,8.361,12.928,8.361,20.291c0,7.344-2.795,14.688-8.361,20.291C597.091,713.208,589.798,716,582.5,716
																		s-14.593-2.792-20.139-8.396L370.649,514.632C332.043,544.851,283.687,563,231,563C105.088,563,3,460.241,3,333.5
																		S105.088,104,231,104z M231,505.625c94.295,0,171-77.208,171-172.125s-76.705-172.125-171-172.125
																		c-94.295,0-171,77.208-171,172.125S136.705,505.625,231,505.625z"/>
																</g>
															</g>
														</g>
													</svg>
												</a>
												<div class="search-form-wrap show-popup hide">
												<?php dh_get_search_form(); ?>
												</div>
											</div>
										<?php
										}
										?>
				            			<?php 
											if(class_exists('DH_Woocommerce') && defined( 'WOOCOMMERCE_VERSION' ) && dh_get_theme_option( 'woo-cart-nav', 1 )){
												echo '<div class="navbar-minicart navbar-minicart-topbar">'.DH_Woocommerce::instance()->get_minicart().'</div>';
											}
										?>
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</div>
			<nav class="collapse navbar-collapse primary-navbar-collapse" itemtype="<?php echo dh_get_protocol() ?>://schema.org/SiteNavigationElement" itemscope="itemscope" role="navigation">
				<div class="container">
					<div class="row">
						<?php
						$page_menu = '' ;
						if(is_page() && ($selected_page_menu = dh_get_post_meta('main_menu'))){
							$page_menu = $selected_page_menu;
						}
						if(has_nav_menu('primary') || !empty($page_menu)):
							wp_nav_menu( array(
								'theme_location'    => 'primary',
								'container'         => false,
								'depth'				=> 3,
								'menu'				=> $page_menu,
								'menu_class'        => 'nav navbar-nav primary-nav',
								'walker' 			=> new DH_Mega_Walker
							) );
						else:
							echo '<ul class="nav navbar-nav primary-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">' . esc_html__( 'No menu assigned!', 'woow' ) . '</a></li></ul>';
						endif;
						?>
					</div>
				</div>
			</nav>				
			<div class="header-search-overlay hide">
				<div class="<?php echo dh_container_class()?>">
					<div class="header-search-overlay-wrap">
						<?php echo dh_get_search_form()?>
						<button type="button" class="close">
							<span aria-hidden="true" class="fa fa-times"></span><span class="sr-only"><?php echo esc_html__('Close','woow') ?></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>