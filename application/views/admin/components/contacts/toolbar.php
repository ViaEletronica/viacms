		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/contacts_management/contacts_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/contacts_management/add_contact', 'text' => lang( 'new_contact' ), 'icon' => 'add', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/contacts_management/google_contacts', 'icon' => 'google', 'text' => lang( 'google_contacts' ), 'only_icon' => TRUE, ) );
				
		?>
		
		<div class="search-toolbar-wrapper fr">
			
			<?= form_open( get_url('admin/' . $component_name . '/'. $component_function .'/search') ); ?>
			
			<div class="vui-field-wrapper-inline">
				
				<?= form_input(array( 'id'=>'terms','placeholder'=>lang('search'), 'name'=>'terms', 'class'=>'live-search search-terms', 'title'=>lang('tip_terms') ), isset($search['terms']) ? $search['terms'] : ''); ?>
				
			</div>
			<div class="vui-field-wrapper-inline">
				
				<?= vui_el_button( array( 'text' => lang( 'search' ), 'icon' => 'search', 'only_icon' => TRUE, 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_search', 'id' => 'submit-search', ) ); ?>
				
				<?php if ( $component_function_action == 'search' ){ ?>
				
				<?= vui_el_button( array( 'text' => lang( 'cancel_search' ), 'icon' => 'cancel', 'only_icon' => TRUE, 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel_search', 'id' => 'submit-cancel-search', ) ); ?>
				
				<?php } ?>
				
			</div>
			
			<?= form_close(); ?>
			
			<div class="clear"></div>
			
		</div>
		
		<?php if ( $this->plugins->load( 'viacms_live_search' ) ){ ?>
		
		<script type="text/javascript">
			
			$( document ).bind( 'ready', function(){
				
				liveSearch( '<?= $this->contacts_model->get_component_url_admin() . '/ajax/live_search?q='; ?>' );
				
			});
			
		</script>
		
		<?php } ?>
		