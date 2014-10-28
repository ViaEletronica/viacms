<!DOCTYPE html>
<html lang="en" class="vui <?= ( $current_component ) ? $current_component[ 'unique_name' ] :''; ?>" >
	<head>
		
		<?php
			
			$this->plugins->load( array( 'names' => array( 'jquery', 'modal_rf_file_picker' ), 'types' => array( 'js_tooltip' ) ) );
			
			$this->voutput->append_head_stylesheet( 'theme', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/css/theme.css.php' );
			$this->voutput->append_head_script( 'php.js', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/php.js' );
			$this->voutput->append_head_script( 'jquery.ba-outside-events', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.ba-outside-events.min.js' );
			$this->voutput->append_head_script( 'jquery.number', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.number.min.js' );
			$this->voutput->append_head_script( 'js_numeral', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/numeral-js/numeral.js' );
			$this->voutput->append_head_script( 'jquery.maskedinput', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.maskedinput.min.js' );
			$this->voutput->append_head_script( 'jquery.maskMoney', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.maskMoney.js' );
			$this->voutput->append_head_script( 'jquery.caret', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.caret.js' );
			$this->voutput->append_head_script( 'jquery.timer', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.timer.js' );
			$this->voutput->append_head_script( 'jquery.switch', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/jquery.switch.min.js' );
			$this->voutput->append_head_script( 'theme', ADMIN_THEMES_URL . '/' . admin_theme() . '/assets/js/functions.js' );
			
			$google_font_script = "
				
			";
			
			$this->voutput->append_head_script_declaration( 'theme', $google_font_script );
			
			echo $this->voutput->get_head();
			
		?>
		
		<script type="text/javascript">
			
			function mainfunc (func){
				
				this[func].apply(this, Array.prototype.slice.call(arguments, 1));
				
			}
			
			function findCompaniesElements(){
				
				$('a[data-companyid]').on("click", function (e) {
					
					$.fancybox.showLoading();
					
					var jthis = $( this );
					
					e.preventDefault();
					
					$.ajax({
						
						type: "POST",
						cache: false,
						url: '<?= base_url(); ?>admin/companies/ajax/get_company_data/' + jthis.data( 'companyid' ),
						data: {
							
							company_id: jthis.data('companyid'),
							ajax: true
							
						},
						success: function ( data ) {
							
							$.fancybox.open();
							
							// on success, post (preview) returned data in fancybox
							$.fancybox( data, {
								
								fitToView: true,
								autoSize: true,
								closeClick: false,
								openEffect: 'none',
								closeEffect: 'none',
								helpers: {
									
								},
								wrapCSS: 'vui-modal',
								closeBtn: null
								
							}); // fancybox
							
						} // success
						
					}); // ajax
					
				}); // on
				
			}
			
			function createSwitchs(){
				
				var checkClass = function( ele ){
					
					if ( ele.val() == 0 ){
						
						ele.addClass( 'switch-off' );
						ele.removeClass( 'switch-middle switch-on' );
						
					}
					else if ( ele.val() == 1 ){
						
						ele.addClass( 'switch-on' );
						ele.removeClass( 'switch-middle switch-off' );
						
					}
					else{
						
						ele.addClass( 'switch-middle' );
						ele.removeClass( 'switch-off switch-on' );
						
					}
					
				}
				
				$( 'select:not([multiple])' ).each( function() {
					
					if ( ( $( this ).find( 'option' ).length == 2 || $( this ).find( 'option' ).length == 3 ) && $( this ).find( 'option[value=0]' ).length == 1 ){
						
						var ele = $( this );
						
						ele.addClass( 'switch' ); 
				
						$( this ).bind( 'mousedown', function( e ){
							
							var ele = $( this );
							
							e.preventDefault();
							
							if ( ! ele.find( 'option[selected]' ).length ){
								
								ele.find( 'option:first' ).attr( 'selected', 'selected' );
								
							}
							
							acOp = ele.find( 'option[selected]' );
							
							if ( ele.find( 'option:last' ).is( ':selected' )) {
								
								nextOp = $( this ).find( 'option' ).first();
								
							}
							else{
								
								nextOp = acOp.next();
								
							}
							
							
							acOp.removeAttr( 'selected' );
							
							nextOp.attr( 'selected', 'selected' );
							
							checkClass( $( this ) );
							
						});
						
						checkClass( ele );
						
					}
					
				});
			}
			
			$( document ).bind( 'ready', function( event ){
				
				createSwitchs();
				
			});
			
		</script>
		
	</head>

	<body id="" class="vui <?= ( $current_component ) ? $current_component[ 'unique_name' ] :''; ?> <?= ( ! $this->session->userdata( 'admin_login' ) ) ? 'login' :''; ?> <?= $this->session->userdata('select_on') ? 'select-on' : ''; ?> <?= ( ( $this->session->userdata('profiler') === TRUE ) ? 'profiler-on' : 'profiler-off' ); ?>">
		
		<?= $this->voutput->get_body_start(); ?>
		
		<script>
			window.fbAsyncInit = function() {
			FB.init({
				appId		: '289346507923979',
				xfbml		: true,
				version	: 'v2.1'
			});
			};
		
			(function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "//connect.facebook.net/en_US/sdk.js";
			 fjs.parentNode.insertBefore(js, fjs);
			 }(document, 'script', 'facebook-jssdk'));
		</script>
		
		<div id="site-background" class=""></div>
		
		<div id="fake-top-block"></div>
		
		<div id="site-block" class="">
			
			<?php if ( $this->session->userdata( 'admin_login' ) ){ ?>
			<div id="top-block">
				
				<?php if ( $this->session->userdata( 'admin_login' ) ){ ?>
				
				<?php if ( ! $this->session->userdata( 'select_on' ) ){ ?>
				<div id="top-bar" class="">
					
					<nav>
						<ul class="fl main-menu">
							
							<li class="logo">
								
								<?= vui_el_button( array( 'url' => 'admin/main/index/dashboard', 'text' => lang( 'Via CMS' ), 'icon' => 'viacms', 'class' => 'logo', 'only_icon' => TRUE ) ); ?>
								
							</li>
							<!--
							<li>
								<?= anchor(get_url('admin/main/index/dashboard'),lang('dashboard'),'class="" title="'.lang('tip_dashboard').'"'); ?>
							</li>
							-->
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/users', 'text' => lang( 'users' ), 'icon' => 'users', ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/menus', 'text' => lang( 'menus' ), 'icon' => 'menus', ) ); ?>
								
								<ul>
									
									<?php
										
										$_menu_types = array();
										
										$this->load->model( array( 'admin/menus_model' ) );
										$menu_types = menus_model::get_menu_types()->result_array();
										
										foreach ( $menu_types as $key => $menu_type ) {
											
											$_menu_types[ lang( $menu_type[ 'title' ] ) ] = $menu_type;
											
										}
										
										ksort( $_menu_types );
										
									?>
									
									<?php foreach ( $_menu_types as $key => $menu_type ) { ?>
										
										<li>
											
											<?= vui_el_button( array( 'url' => 'admin/menus/mim/mtid/' . $menu_type[ 'id' ] . '/a/mil', 'text' => lang( $menu_type[ 'title' ] ), 'icon' => $menu_type[ 'alias' ], ) ); ?>
											
										</li>
										
									<?php } ?>
									
								</ul>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/modules/mm/a/ml', 'text' => lang( 'modules' ), 'icon' => 'modules', ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/main/components_management/components_list', 'text' => lang( 'components' ), 'icon' => 'vecms', ) ); ?>
								
								<ul>
									
									<?php
										
										$_components = array();
										
										foreach ( $this->mcm->components as $key => $component ) {
											
											if ( $component[ 'status' ] == 1 AND $component[ 'unique_name' ] != 'main' ) {
												
												$_components[ lang( $component[ 'title' ] ) ] = $component;
												
											}
											
										}
										
										ksort( $_components );
										
									?>
									
									<?php foreach ( $_components as $key => $component ) { ?>
										
										<?php if ( $component[ 'status' ] == 1 ) { ?>
												
											<li>
												
												<?= vui_el_button( array( 'url' => $component[ 'admin_url' ], 'text' => lang( $component[ 'title' ] ), 'icon' => $component[ 'unique_name' ], ) ); ?>
												
											</li>
												
										<?php } ?>
										
									<?php } ?>
									
								</ul>
								
							</li>
							
						</ul>
						
						<ul class="fr secondary-menu">
							
							<li>
								
								<?php
								// echo vui_el_button( array( 'url' => 'admin/responsive_file_manager/index/a/rfm', 'text' => lang( 'file_manager' ), 'icon' => 'browse', 'only_icon' => TRUE, ) );
								?>
								<?= vui_el_button( array( 'attr' => 'data-rftype="image"', 'url' => '#', 'text' => lang( 'select_image' ), 'get_url' => FALSE, 'icon' => 'browse', 'only_icon' => TRUE, 'class' => 'modal-file-picker', ) ); ?>
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => BASE_URL, 'get_url' => FALSE, 'check_current_url' => FALSE, 'target' => '_blank', 'text' => lang( 'go_to_site' ), 'icon' => 'web', 'only_icon' => TRUE, ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/main/config_management/global_config', 'text' => lang( 'global_config' ), 'icon' => 'config', 'only_icon' => TRUE, ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/main/switch_profiler', 'text' => lang( 'switch_profiler' ), 'icon' => 'profiler', 'only_icon' => TRUE, 'class' => ( ( $this->session->userdata('profiler') === TRUE ) ? 'active profiler-on' : 'profiler-off' ), ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/users/users_management/edit_user/'.base64_encode(base64_encode(base64_encode(base64_encode($this->users_common_model->user_data['id'])))), 'text' => lang('logged_as').' '.$this->users_common_model->user_data['name'], 'icon' => 'user', 'only_icon' => TRUE, ) ); ?>
								
							</li>
							
							<li>
								
								<?= vui_el_button( array( 'url' => 'admin/main/index/logout', 'text' => lang( 'action_logout' ), 'icon' => 'logout', 'only_icon' => TRUE, ) ); ?>
								
							</li>
							
						</ul>
						
						<div class="clear"></div>
					</nav>
				</div>
				<?php } ?>
				
				
				<?php if ( trim( $toolbar ) !== '' ) { ?>
				
				<div id="toolbar" class="">
					
					<?= $toolbar; ?>
					
					<div class="clear"></div>
					
				</div>
				
				<?php } ?>
				
				<?php } ?>
				
			</div>
			
			<?php } ?>
			
			<?= $msg; ?>
			
			<?php if ( trim( $this->voutput->get_content() ) !== '' ){ ?>
			
			<div id="content-block">
				
				<div class="s1">
					
					<div class="s2">
						
						<?= $this->voutput->get_content(); ?>
						
					</div>
					
				</div>
				
			</div>
			
			<?php } ?>
			
			<footer id="footer">
				<p>
					&copy; Copyright by <a href="http://viaeletronica.com.br" target="_blank">Via Eletrônica</a>
				</p>
				
				<?php if ( $this->session->userdata('profiler') === TRUE ) { ?>
				
				<?= 'environment = <b>' . environment(); ?></b><br/>
				<?= 'current_component = <b>'; var_dump( $current_component ); ?></b><br/>
				<?= 'component_function = <b>' . $component_function; ?></b><br/>
				<?= 'component_function_action = <b>' . $component_function_action; ?></b><br/>
				<?= 'last_url = <b>'.get_last_url(); ?></b>
				
				<p>
					<!--
					<?= phpinfo(); ?>
					-->
				</p>
				
				<?php } ?>
				
			</footer>
		</div>
		
		<?= $this->voutput->get_body_end(); ?>
		
	</body>
</html>
