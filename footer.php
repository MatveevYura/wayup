<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WayUP
 */
global $wayup_options;

?>

<footer class="footer">
			<div class="wrapper">
				<div class="footer__block">
					<a href="index.html" class="logo noise">
						<p class="logo__icon"><?php bloginfo('name'); ?></p>
						<p class="logo__desc"><?php bloginfo('description'); ?></p>
					</a>
					<ul class="social">
          <?php $social_links = $wayup_options['social_links'];

            foreach ($social_links as $social => $link) {
              $label = '';
              $svg = '';
              $class = '';
              if($social == 'Vkontakte Link'){
                $label = '<span>Vk</span>';
                $svg = '<svg  width="14" height="17"><use xlink:href="#facebook"/></svg>';
                $class = 'social__icon_vk';
              }else if ($social == 'Facebook Link') {
                $label = '<span>Fb</span>';
                $svg = '<svg  width="14" height="17"><use xlink:href="#facebook"/></svg>';
                $class = 'social__icon_fb';
              } else if ($social == 'Twitter Link') {
                $label = '<span>Tw</span>';
                $svg = '<svg  width="18" height="15"><use xlink:href="#twitter"/></svg>';
                $class = 'social__icon_tw';
              } else if ($social == 'Instagram Link') {
                $label = '';
                $svg = '<svg width="18" height="15"><use xlink:href="#instagram"/></svg>';
                $class = 'social__icon_inst';
              }
          ?>
          <?php if($link){?>
            <li class="social__item">
              <?php echo $label; ?>
              <a class="social__icon <?php echo $class; ?>" target="_blank" href="<?php echo $link; ?>">
                <?php echo $svg; ?>
              </a>
            </li>
          <?php } ?>
          <?php } ?>
					</ul>
					
				</div>
        <?php if($wayup_options['footer_section2']){?>
				<nav class="guide">
					<p class="guide__title"><?php echo $wayup_options['footer_section1']; ?></p>
					<?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-footer-1',
              'menu_id'        => 'footer-navigation-one',
              'container'      => '',
              'menu_class'     => ''
            )
          );
          ?>
				</nav>
        <?php }?>
        <?php if($wayup_options['footer_section2']){?>
				<div class="serv">
					<p class="serv__title"><?php echo $wayup_options['footer_section2']; ?></p>
					<?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-footer-2',
              'menu_id'        => 'footer-navigation-two',
              'container'      => '',
              'menu_class'     => ''
            )
          );
          ?>
				</div>
        <?php }?>
        <?php if($wayup_options['footer_section3']){?>
				<div class="contact">
					<p class="contact__title"><?php echo $wayup_options['footer_section3']; ?></p>
					<ul class="contact__list">
            <?php if($wayup_options['footer_address']){?>
						<li class="contact__item">
							<svg width="20" height="25">
								<use xlink:href="#pin"/>
							</svg>
							<p class="contact__text contact__text_address"><?php echo $wayup_options['footer_address']; ?></p>
						</li>
            <?php }?>
						<li class="contact__item">
							<svg width="21" height="21">
								<use xlink:href="#phone"/>
							</svg>
							<div class="contact__phones">
                <?php 
                foreach($wayup_options['footer_phone'] as $phone){
                  
                  if($phone){?>
								<a href="tel:<?php echo $phone; ?>" class="contact__text contact__text_phone"><?php echo esc_attr($phone); ?></a>
              <?php }
              }
                ?>
							</div>
						</li>
            <?php if($wayup_options['footer_email']){?>
						<li class="contact__item">
							<svg width="25" height="19">
								<use xlink:href="#mail"/>
							</svg>
							<p class="contact__text contact__text_mail"><?php echo $wayup_options['footer_email']; ?></p>
						</li>
            <?php }?>
					</ul>
				</div>
        <?php }?>
        <?php if($wayup_options['footer_section4']){?>
				<div class="subscribe">
					<p class="subscribe__title"><?php echo $wayup_options['footer_section4']; ?></p>
					<form action="#" class="subscribe__form" id="popupSubscribe">
						<input type="text" name="email" class="subscribe__input" placeholder="Ваш email">
						<button class="subscribe__btn btn" data-submit>Подписаться</button>
					</form>
					<div class="control">
						<div class="language">
							<ul>
								<li class="lang-item active">
									<a href="#">En</a>
								</li>
								<li class="lang-item">
									<a href="#">Ru</a>
								</li>
							</ul>
						</div>
						<div class="control__wrap">
							<a  href="#enter" class="control__enter popup-link-1">
								<svg class="control__icon" width="19" height="17">
									<use xlink:href="#login"/>
								</svg>
								Log in
							</a>
							<a style="display: none;" href="cabinet.html" class="control__enter control__enter_cab">
								<svg class="control__icon" width="16" height="16">
									<use xlink:href="#user"/>
								</svg>
								Личный кабинет
							</a>
							<a href="#reg" class="control__reg noise popup-link-2">Регистрация</a>
						</div>
					</div>
				</div>
        <?php }?>
        <?php if($wayup_options['footer_copyrights']){?>
				  <div class="footer__copy"><?php echo $wayup_options['footer_copyrights'];?></div>
			  <?php }?>
      </div>
		</footer><!-- End footer -->

<?php wp_footer(); ?>

</body>
</html>
