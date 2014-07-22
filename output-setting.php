<?php 
	function zd_page_loading_wemake(){
		echo '<!-- Prealoader -->
		    <div id="preloader">
		        <div id="status">
		            <div class="spinner">
		                <div class="bounce1"></div>
		                <div class="bounce2"></div>
		                <div class="bounce3"></div>
		            </div>
		        </div>
		    </div>';
	};
	add_action( 'wp_footer', 'zd_page_loading_wemake');

	function zd_page_loading_wemake_css() {

	?>
		<style>
		#preloader {
		    position: fixed;
		    top:0;
		    left:0;
		    right:0;
		    bottom:0;
		    width:100%;
		    height:100%;
		    background-color:#fff; 
		    z-index:9999; /* makes sure it stays on top */
		}

		#status {
		    width:200px;
		    height:200px;
		    position:absolute;
		    left:50%; /* centers the loading animation horizontally one the screen */
		    top:50%; /* centers the loading animation vertically one the screen */
		    background-repeat:no-repeat;
		    background-position:center;
		    margin:-100px 0 0 -100px; /* is width and height divided by two */
		}

		.spinner {
		    margin: 100px auto 0;
		    width: 70px;
		    text-align: center;
		}

		.spinner > div {
		    width: 18px;
		    height: 18px;
		    border-radius: 100%;
		    display: inline-block;
		    -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
		    animation: bouncedelay 1.4s infinite ease-in-out;
		    -webkit-animation-fill-mode: both;
		    animation-fill-mode: both;
		    
		}

		.spinner .bounce1 {
		    -webkit-animation-delay: -0.32s;
		    animation-delay: -0.32s;
		}

		.spinner .bounce2 {
		    -webkit-animation-delay: -0.16s;
		    animation-delay: -0.16s;
		}

		@-webkit-keyframes bouncedelay {
		    0%, 80%, 100% { -webkit-transform: scale(0.0) }
		    40% { -webkit-transform: scale(1.0) }
		}

		@keyframes bouncedelay {
		    0%, 80%, 100% { 
		        transform: scale(0.0);
		        -webkit-transform: scale(0.0);
		    } 40% { 
		        transform: scale(1.0);
		        -webkit-transform: scale(1.0);
		    }
		}

		</style>
	<?php
	}
	add_action('wp_head', 'zd_page_loading_wemake_css');

	/* Adding Latest jQuery from Wordpress */
	function zd_page_loading_wemake_jquery() {
		wp_enqueue_script('jquery');
	}
	add_action('init', 'zd_page_loading_wemake_jquery');

	function zd_page_loading_active_jquery() {
	?>
	<script type="text/javascript">
			//PRELOADER
		    jQuery(window).load(function() {
			    jQuery('#status').delay(500).fadeOut('slow');
			    jQuery('#preloader').delay(1000).fadeOut('slow');
			    jQuery('body').delay(500).css({'overflow':'visible'});
			    jQuery(".spinner > div").css({"background-color": "<?php echo my_get_option( 'preloadcolor', 'wedevs_basics', '#00A800' );?>"});
			})
		</script>
	<?php
	}
	add_action('wp_footer', 'zd_page_loading_active_jquery');