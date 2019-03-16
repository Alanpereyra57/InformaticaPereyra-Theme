    <!-- Footer -->

        <div class="container-fluid text-white py-3 pb-5" style="background-color: <?php echo get_theme_mod('ip_footer_color'); ?>;">
            <div class="text-center">
                <!-- Sidebar -->
                    <?php get_sidebar( 'footer' ); ?>
            	<!-- Social buttons -->
	            	<div class="container-fluid p-3">
		            	<!-- Facebook -->
			            	<?php $facebook_link = get_theme_mod('ip_social_face_text');
			                    if ($facebook_link){
			                    	?><a href="<?php echo get_theme_mod('ip_social_face_text'); ?>" class="fa fa-facebook"></a><?php 
			                    }
			                ?>
			            <!-- Instagram -->
			            	<?php $instagram_link = get_theme_mod('ip_social_insta_text');
			                    if ($instagram_link){
			                    	?><a href="<?php echo get_theme_mod('ip_social_insta_text'); ?>" class="fa fa-instagram"></a><?php 
			                    }
			                ?>
			            <!-- Twiter -->
			            	<?php $twitter_link = get_theme_mod('ip_social_tw_text');
			                    if ($twitter_link){
			                    	?><a href="<?php echo get_theme_mod('ip_social_tw_text'); ?>" class="fa fa-twitter"></a><?php 
			                    }
			                ?>
			            <!-- Youtube -->
			            	<?php $youtube_link = get_theme_mod('ip_social_yt_text');
			                    if ($youtube_link){
			                    	?><a href="<?php echo get_theme_mod('ip_social_yt_text'); ?>" class="fa fa-youtube"></a><?php 
			                    }
			                ?>           
		            </div>
            	<!-- end social buttons -->
                <!-- Owner -->
    	            <p><?php echo get_theme_mod('ip_footer_text'); ?><br><small>Desarrollado por <a href="https://informatica.pereyra.online">Informatica Pereyra</a></small></p>
                <!-- end owner -->
                <small><p><a href="<?php echo get_permalink(get_theme_mod('ip_headline_link_term')); ?>" class="text-secondary">Terminos y Condiciones</a> -  
                <a href="<?php echo get_permalink(get_theme_mod('ip_headline_link_poli')); ?>" class="text-secondary">Politicas de Privacidad</a></p></small>
                <br>
                <?php echo get_theme_mod('ip_qr_text') ?>
                <br>
            </div>
        </div>
    <!-- end footer -->
    <!-- Button permanent desktop -->
        <div class="show-lg">
            <?php  $perma_button = get_theme_mod('ip_what_text'); ?> 
            <?php if ($perma_button) { ?>
            	<div class="img-fixed"><a href="https://api.whatsapp.com/send?phone=<?php echo get_theme_mod('ip_what_text'); ?>&text=Hola%20tengo%20una%20consulta%20desde%20<?php wp_title();?>"><img class="img-btn-fixed-wsp" height="512" width="512" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/whatsapp-logo.png"></a></div>
            <?php } else { ?>
            	<div class="img-fixed"><a href="#"><img class="img-btn-fixed" height="512" width="512" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/up-button.png"></a></div>
            <?php } ?>
        </div>
    <!-- end button permanent desktop -->
    <!-- Buttons mobile -->
        <div class="show-sm mx-auto container-fluid fixed-bottom">
            <div class="buttons-mobile text-center d-flex justify-content-between align-items-center fixed-bottom">
                <!-- Home-->
                    <a href="<?php echo home_url(); ?>" class="fa-dark fa fa-home mx-auto"><span class="fa-text">Inicio</span></a>
                <!-- User -->
                    <?php $user_link = get_theme_mod('ip_mobile_user_text');
                        if ($user_link){ ?>
                            <a href="<?php echo get_theme_mod('ip_mobile_user_text'); ?>" class="fa-dark fa fa-user mx-auto">
                                <span class="fa-text">Ingresar</span>
                            </a> 
                        <?php }
                    ?>
                <!-- Comment -->
                    <?php $comment_link = get_theme_mod('ip_mobile_comment_text');
                        if ($comment_link){ ?>
                            <a href="<?php echo get_theme_mod('ip_mobile_comment_text'); ?>" class="fa-dark fa fa-comment mx-auto">
                                <span class="fa-text">Contacto</span>
                            </a> 
                        <?php }
                    ?>  
                <!-- Instagram -->
                    <?php $search_link = get_theme_mod('ip_mobile_search_text');
                        if ($search_link){ ?>
                            <a href="<?php echo get_theme_mod('ip_mobile_search_text'); ?>" class="fa-dark fa fa-search mx-auto">
                                <span class="fa-text">Buscar</span>
                            </a> 
                        <?php }
                    ?>     
            </div>
        </div>
    <!-- end buttons mobile -->
    <!-- end all content -->
    </div>
    <!-- WP JavaScript -->
    <?php wp_footer(); ?>
    <?php wp_head(); ?>
    <!-- jQuery first, then Bootstrap Bundle JS, then Complements -->
    <script defer="true" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-3.3.1.slim.min.js"></script>
    <script defer="true" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.bundle.min.js"></script>
    <script defer="true" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/complements.js"></script>
    <!-- end js -->
  </body>
</html>
