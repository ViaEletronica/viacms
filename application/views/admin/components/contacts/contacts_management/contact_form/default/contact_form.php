
<div id="global-config-form-wrapper" class="form-wrapper tabs-wrapper">
	
	<div class="form-wrapper-sub tabs-children">
		
		<?= form_open_multipart( get_url( 'admin'.$this->uri->ruri_string() ), array( 'id' => 'contact-form', ) ); ?>
			
			<div class="form-actions to-toolbar">
				
				<?= vui_el_button( array( 'text' => lang( 'action_save' ), 'icon' => 'save', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'only_icon' => TRUE, 'form' => 'contact-form', ) ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'action_apply' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_apply', 'id' => 'submit-apply', 'only_icon' => TRUE, 'form' => 'contact-form', ) ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'action_cancel' ), 'icon' => 'cancel', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel', 'id' => 'submit-cancel', 'only_icon' => TRUE, 'form' => 'contact-form', ) ); ?>
				
			</div>
			
			<header class="form-header tabs-header">
				
				<?php if ( $component_function_action == 'add_contact' ) { ?>
					
				<h1><?= lang('add_contact'); ?></h1>
				
				<?php } else if ( $component_function_action == 'edit_contact' ) { ?>
					
				<h1><?= lang('edit_contact'); ?></h1>
				
				<?php } ?>
				
			</header>
			
			<div class="form-items tabs-items">
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'basic_details' ), 'icon' => 'basic-details',  ) ); ?>
							
						</legend>
						
						<?php if ( $component_function_action == 'add_contact' ) { ?>
							
							<?= form_hidden( 'contact_image_path', $contact_image_path ); ?>
							
						<?php } ?>
						
						<div id="contact-thumb-wrapper" class="vui-field-wrapper-inline">
							
							<?= form_hidden( 'thumb_local', ( isset( $contact[ 'thumb_local' ] ) ? $contact[ 'thumb_local' ] : '' ) ); ?>
							
						</div>
						
						<div id="contact-photo-wrapper" class="vui-field-wrapper-inline">
							
							<?php
								
								$field_name = 'photo_local';
								$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
								$field_attr = 'id = "contact-' . $field_name . '" name="' . $field_name . '" class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
								
							?>
							
							<div class="contact-photo-wrapper edit-page">
								
								<?= anchor( $contact['thumb_local'], img( array( 'class' => 'contact-image-thumb', 'src' => $contact[ $field_name ], 'height' => 120 ) ),'target="_blank" class="contact-image-thumb-link" title="'.lang('action_view').'"'); ?>
							
							</div>
							
							<?= form_label( lang( $field_name ) ); ?>
							<?= form_input( $field_name, ( isset( $contact[ $field_name ] ) ? $contact[ $field_name ] : '' ), $field_attr ); ?>
							
							<?php
								
								unset( $field_name );
								unset( $field_error );
								unset( $field_attr );
								
							?>
							
						</div>
						
						<?= form_error('name', '<div class="msg-inline-error">', '</div>'); ?>
						<?= form_label(lang('name')); ?>
						<?= form_input(array('id'=>'name','name'=>'name'),isset($contact['name'])?$contact['name']:'','autofocus'); ?>
						
						<?= form_error('birthday_date', '<div class="msg-inline-error">', '</div>'); ?>
						<?= form_label(lang('birthday_date')); ?>
						<?= form_input(array('id'=>'birthday-date','name'=>'birthday_date', 'title'=>lang('tip_birthday_date')),isset($contact['birthday_date'])?$contact['birthday_date']:''); ?>
						
					</fieldset>
					
				</div>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'emails' ), 'icon' => 'emails',  ) ); ?>
							
						</legend>
						
						<?php if ( isset($contact['emails']) AND is_array($contact['emails']) ) { ?>
						<?php foreach ($contact['emails'] as $key => $email) { ?>
						
						<div class="emails-fields-wrapper">
							
							<?= form_hidden('emails['.$key.'][key]',$email['key']); ?>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'0' => lang( 'no' ),
										'1' => lang( 'yes' ),
										
									);
									
								?>
								<?= form_dropdown( 'emails['.$key.'][publicly_visible]', $options, isset( $email[ 'publicly_visible' ] ) ? $email[ 'publicly_visible' ] : 1, 'id="email-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<?= form_error('email_'.$key, '<div class="msg-inline-error">', '</div>'); ?>
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('email_type')); ?>
								<?= form_input(array('id'=>'email-title-'.$key, 'name'=>'emails['.$key.'][title]', 'class'=>'email-title', 'title'=>lang('tip_email_title')), isset($email['title']) ? $email['title'] : lang('email').' '.$key ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'title_publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'emails['.$key.'][email_title_publicly_visible]', $options, isset( $field[ 'email_title_publicly_visible' ] ) ? $field[ 'email_title_publicly_visible' ] : 1, 'id="email-title-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'message_receptor' ) ); ?>
								<?php
									
									$options = array(
										
										'0' => lang( 'no' ),
										'1' => lang( 'yes' ),
										
									);
									
								?>
								<?= form_dropdown( 'emails['.$key.'][site_msg]', $options, isset( $email[ 'site_msg' ] ) ? $email[ 'site_msg' ] : 0, 'id="email-site-msg-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('email')); ?>
								<?= form_input(array('id'=>'email-'.$key, 'name'=>'emails['.$key.'][email]', 'class'=>'email'), isset($email['email']) ? $email['email'] : '' ); ?>
								
								<?php if ( $key > 1 OR $component_function_action == 'edit_contact' ) { ?>
								
								<?= form_submit(array('id'=>'submit-add-email-'.$key,'name'=>'submit_remove_email['.$key.']', 'class'=>'btn btn-delete', 'title'=>lang('tip_remove_email')),lang('remove_email')); ?>
								
								<?php } ?>
								
							</div>
							
						</div>
						
						<?php } ?>
						<?php } ?>
						
						<?= form_label(lang('add_email')); ?>
						<?= form_label(lang('enter_amount_emails')); ?>
						<?= form_input(array('id'=>'email-fields-to-add','name'=>'email_fields_to_add','class'=>'add-num-email', 'title'=>lang('tip_enter_amount_emails')),1); ?>
						<?= form_submit(array('id'=>'submit-add-email', 'class'=>'btn btn-add','name'=>'submit_add_email'),lang('add')); ?>
						
					</fieldset>
					
				</div>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'phones' ), 'icon' => 'phones',  ) ); ?>
							
						</legend>
						
						<?php if ( isset($contact['phones']) AND is_array($contact['phones']) ) { ?>
						<?php foreach ($contact['phones'] as $key => $phone) { ?>
						
						<div class="phones-fields-wrapper">
							
							<?= form_hidden('phones['.$key.'][key]',$phone['key']); ?>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'phones['.$key.'][publicly_visible]', $options, isset( $phone[ 'publicly_visible' ] ) ? $phone[ 'publicly_visible' ] : 1, 'id="phone-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('phones['.$key.'][title]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('title')); ?>
								<?= form_input(array('id'=>'phone-title-'.$key,'name'=>'phones['.$key.'][title]','class'=>'phone-title', 'title'=>lang('tip_phone_type')), isset($phone['title']) ? $phone['title'] : lang('phone').' '.$key ); ?>
								
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'title_publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'phones['.$key.'][phone_title_publicly_visible]', $options, isset( $phone[ 'phone_title_publicly_visible' ] ) ? $phone[ 'phone_title_publicly_visible' ] : 1, 'id="phone-title-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('phones['.$key.'][area_code]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('phone_area_code')); ?>
								<?= form_input(array('id'=>'phone-area-code-'.$key,'name'=>'phones['.$key.'][area_code]','class'=>'phone-area-code', 'maxlength'=>'3', 'size'=>'3'), isset($phone['area_code']) ? $phone['area_code'] : '' ); ?>
								
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('phones['.$key.'][number]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('phone_number')); ?>
								<?= form_input(array('id'=>'phone-number-'.$key,'name'=>'phones['.$key.'][number]','class'=>'phone-number'), isset($phone['number']) ? $phone['number'] : '' ); ?>
								
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('phones['.$key.'][extension_number]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('extension_number')); ?>
								<?= form_input(array('id'=>'phone-extension-number-'.$key,'name'=>'phones['.$key.'][extension_number]','class'=>'phone-extension-number'), isset($phone['extension_number']) ? $phone['extension_number'] : '' ); ?>
								
								<?php if ( $key > 1 OR $component_function_action == 'edit_contact' ) { ?>
								
								<?= form_submit(array('id'=>'submit-remove-phone-'.$key,'name'=>'submit_remove_phone['.$key.']', 'class'=>'btn btn-delete', 'title'=>lang('tip_remove_phone')),lang('remove_phone')); ?>
								
								<?php } ?>
								
							</div>
							
						</div>
						
						<?php } ?>
						<?php } ?>
						
						<?= form_label(lang('add_phone')); ?>
						<?= form_label(lang('enter_amount_phones')); ?>
						<?= form_input(array('id'=>'phone-fields-to-add','name'=>'phone_fields_to_add','class'=>'add-num-phone', 'title'=>lang('tip_enter_amount_phones')),1); ?>
						<?= form_submit(array('id'=>'submit-add-phone', 'class'=>'btn btn-add','name'=>'submit_add_phone'),lang('add')); ?>
						
					</fieldset>
					
				</div>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'addresses' ), 'icon' => 'addresses',  ) ); ?>
							
						</legend>
						
						<?php if ( isset($contact['addresses']) AND is_array($contact['addresses']) ) { ?>
						<?php foreach ($contact['addresses'] as $key => $address) { ?>
						
						<?= form_hidden('addresses['.$key.'][key]',$address['key']); ?>
						
						<div class="addresses-fields-wrapper dinamic-fields-wrapper">
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'addresses['.$key.'][publicly_visible]', $options, isset( $address[ 'publicly_visible' ] ) ? $address[ 'publicly_visible' ] : 1, 'id="adress-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('title')); ?>
								<?= form_input(array('id'=>'address-title-'.$key,'name'=>'addresses['.$key.'][title]','class'=>'address-title', 'title'=>lang('tip_address_type')), isset($address['title']) ? $address['title'] : lang('address').' '.$key ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'address_title_publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'addresses['.$key.'][address_title_publicly_visible]', $options, isset( $address[ 'address_title_publicly_visible' ] ) ? $address[ 'address_title_publicly_visible' ] : 1, 'id="adress-title-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<br/>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('country')); ?>
								<?= form_input(array('id'=>'address-country-title-'.$key,'name'=>'addresses['.$key.'][country_title]','class'=>'address-country-title', 'title'=>lang('tip_address_country_title')), isset($address['country_title']) ? lang($address['country_title']) : '' ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('state')); ?>
								<?= form_input(array('id'=>'address-state-acronym-'.$key,'name'=>'addresses['.$key.'][state_acronym]','class'=>'address-state-acronym', 'title'=>lang('tip_address_state_acronym')), isset($address['state_acronym']) ? lang($address['state_acronym']) : '' ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('city')); ?>
								<?= form_input(array('id'=>'address-city-title-'.$key,'name'=>'addresses['.$key.'][city_title]','class'=>'address-city-title', 'title'=>lang('tip_address_city_title')), isset($address['city_title']) ? lang($address['city_title']) : '' ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('neighborhood')); ?>
								<?= form_input(array('id'=>'address-neighborhood-title-'.$key,'name'=>'addresses['.$key.'][neighborhood_title]','class'=>'address-neighborhood-title', 'title'=>lang('tip_address_neighborhood_title')), isset($address['neighborhood_title']) ? lang($address['neighborhood_title']) : '' ); ?>
							</div>
							
							<br/>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('public_area')); ?>
								<?= form_input(array('id'=>'address-public-area-title-'.$key,'name'=>'addresses['.$key.'][public_area_title]','class'=>'address-public-area-title', 'title'=>lang('tip_address_public_area_title')), isset($address['public_area_title']) ? lang($address['public_area_title']) : '' ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('postal_code')); ?>
								<?= form_input(array('id'=>'address-postal-code-'.$key,'name'=>'addresses['.$key.'][postal_code]','class'=>'address-postal-code', 'title'=>lang('tip_address_postal_code')), isset($address['postal_code']) ? lang($address['postal_code']) : '' ); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('number')); ?>
								<?= form_input(array('id'=>'address-number-'.$key,'name'=>'addresses['.$key.'][number]','class'=>'address-number', 'title'=>lang('tip_address_number')), isset($address['number']) ? lang($address['number']) : '' ); ?>
							</div>
							
							<br/>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label(lang('complement')); ?>
								<?= form_input(array('id'=>'address-complement-'.$key,'name'=>'addresses['.$key.'][complement]','class'=>'address-complement', 'title'=>lang('tip_address_complement')), isset($address['complement']) ? lang($address['complement']) : '' ); ?>
							</div>
							
							<br/>
							
							<div class="field-wrapper">
								<?= form_submit(array('id'=>'submit-remove-address-'.$key,'name'=>'submit_remove_address['.$key.']', 'class'=>'button', 'title'=>lang('tip_remove_address')),lang('remove_address')); ?>
							</div>
							
						</div>
						
						<?php } ?>
						<?php } ?>
						
						<div class="field-wrapper ta-right">
							<?= form_submit(array('id'=>'submit-add-address', 'class'=>'button','name'=>'submit_add_address'),lang('add_address')); ?>
						</div>
						
					</fieldset>
					
				</div>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'websites' ), 'icon' => 'websites',  ) ); ?>
							
						</legend>
						
						<?php if ( isset($contact['websites']) AND is_array($contact['websites']) ) { ?>
						<?php foreach ($contact['websites'] as $key => $website) { ?>
						
						<div class="websites-fields-wrapper">
							
							<?= form_hidden('websites['.$key.'][key]',$website['key']); ?>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'0' => lang( 'no' ),
										'1' => lang( 'yes' ),
										
									);
									
								?>
								<?= form_dropdown( 'websites['.$key.'][publicly_visible]', $options, isset( $website[ 'publicly_visible' ] ) ? $website[ 'publicly_visible' ] : 1, 'id="website-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('websites['.$key.'][title]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('title')); ?>
								<?= form_input(array('id'=>'website-title-'.$key,'name'=>'websites['.$key.'][title]','class'=>'website-title', 'title'=>lang('tip_website_title')), isset($website['title']) ? $website['title'] : lang('website').' '.$key ); ?>
								
							</div>
							
							<div class="vui-field-wrapper-inline">
								<?= form_label( lang( 'address_title_publicly_visible' ) ); ?>
								<?php
									
									$options = array(
										
										'1' => lang( 'yes' ),
										'0' => lang( 'no' ),
										
									);
									
								?>
								<?= form_dropdown( 'websites['.$key.'][website_title_publicly_visible]', $options, isset( $website[ 'website_title_publicly_visible' ] ) ? $website[ 'website_title_publicly_visible' ] : 1, 'id="website-title-publicly-visible-' . $key . '"'); ?>
							</div>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_error('websites['.$key.'][url]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('url')); ?>
								<?= form_input(array('id'=>'website-url-'.$key,'name'=>'websites['.$key.'][url]','class'=>'website-url'), isset($website['url']) ? $website['url'] : '' ); ?>
								
								<?php if ( $key > 1 OR $component_function_action == 'edit_contact' ) { ?>
								
								<?= form_submit(array('id'=>'submit-remove-website-'.$key,'name'=>'submit_remove_website['.$key.']', 'class'=>'btn btn-delete', 'title'=>lang('tip_remove_website')),lang('remove_website')); ?>
								
								<?php } ?>
								
							</div>
							
						</div>
						
						<?php } ?>
						<?php } ?>
						
						<?= form_label(lang('add_website')); ?>
						<?= form_label(lang('enter_amount_websites')); ?>
						<?= form_input(array('id'=>'website-fields-to-add','name'=>'website_fields_to_add','class'=>'add-num-website', 'title'=>lang('tip_enter_amount_websites')),1); ?>
						<?= form_submit(array('id'=>'submit-add-website', 'class'=>'btn btn-add','name'=>'submit_add_website'),lang('add')); ?>
						
					</fieldset>
					
				</div>
				
				<?php if ( $component_function_action == 'edit_contact' ) { ?>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'companies' ), 'icon' => 'companies',  ) ); ?>
							
						</legend>
						
						<?php if ( isset($contact['companies']) AND is_array($contact['companies']) ) { ?>
						<?php foreach ($contact['companies'] as $key => $company) { ?>
						
						<div class="companies-fields-wrapper">
							
							<?= form_hidden('companies['.$key.'][id]', $company['id']); ?>
							<?= form_hidden('companies['.$key.'][trading_name]', $company['trading_name']); ?>
							<?= form_hidden('companies['.$key.'][logo_thumb]', $company['logo_thumb']); ?>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_label(lang('company')); ?>
								
								<a href="<?= get_url('admin/companies/companies_management/edit_company/'.$company['id']); ?>" class="list-info-wrapper" data-companyid="<?= $company['id']; ?>" target="_blank" >
									
									<span class="list-info-thumb-wrapper">
										<?php if ( $company['logo_thumb'] ){ ?>
										
										<?= img( array( 'src' => base_url().'assets/images/components/companies/'.$company['id'] . '/' . $company['logo_thumb'], 'width' => 24 ) ); ?>
										
										<?php } ?>
									</span>
									
									<?= $company['trading_name']; ?>
									
								</a>
								
								<?= form_submit(array('id'=>'submit-remove-company-'.$key,'name'=>'submit_remove_company['.$key.']', 'class'=>'btn btn-delete', 'title'=>lang('tip_remove_company')),lang('remove_company')); ?>
								
							</div>
							
							<?php foreach ($company['relationships'] as $relationship_key => $relationship) { ?>
							
							<div class="vui-field-wrapper-inline">
								
								<?= form_hidden('companies['.$key.'][relationships]['.$relationship['key'].'][id]', $contact['id']); ?>
								<?= form_hidden('companies['.$key.'][relationships]['.$relationship['key'].'][key]', $relationship['key']); ?>
								
								<?= form_error('companies['.$key.'][relationships]['.$relationship['key'].'][title]', '<div class="msg-inline-error">', '</div>'); ?>
								<?= form_label(lang('title')); ?>
								<?= form_input(array('id'=>'company-relationship-'.$key,'name'=>'companies['.$key.'][relationships]['.$relationship['key'].'][title]','class'=>'contact-title', 'title'=>lang('tip_company_contact_title')), $relationship['title'] ); ?>
								
								<?php if ( count( $company['relationships'] ) > 1 ) { ?>
								
								<?= form_submit(array('id'=>'submit-remove-company-relationship-'.$key,'name'=>'submit_remove_company_relationship['.$key.']['.$relationship['key'].']', 'class'=>'btn btn-delete', 'title'=>lang('tip_remove_company_relationship')),lang('remove_relationship')); ?>
								
								<?php } ?>
								
							</div>
							
							<?php } ?>
							
						</div>
						
						<?php } ?>
						
						<?php } ?>
						
						<div class="field-wrapper ta-right">
							<?= form_submit(array('id'=>'submit-add-company', 'class'=>'button','name'=>'submit_add_company'),lang('add_company')); ?>
						</div>
						
					</fieldset>
					
				</div>
				
				<?php } ?>
				
			</div>
			
			<?php if ( check_var( $contact[ 'id' ] ) ) { ?>
			<?= form_hidden( 'contact_id', $contact[ 'id' ] ); ?>
			<?php } ?>
			
		<?= form_close(); ?>
		
	</div>
	
</div>

<?php if ( $this->plugins->load( 'yetii' ) ){ ?>

<script type="text/javascript" >
	
$( document ).ready(function(){
	
	/*************************************************/
	/**************** Criando as tabs ****************/
	
	makeTabs( $( '.tabs-wrapper' ), '.form-item', 'legend' );
	
	/**************** Criando as tabs ****************/
	/*************************************************/
	
});

</script>

<?php } ?>

<?php
	
	$this->plugins->load( array( 'image_cropper', 'fancybox', 'modal_rf_file_picker' ) );
	
?>

<script type="text/javascript">
	
	<?php if ( $this->plugins->performed( 'modal_rf_file_picker' ) ) { ?>
	
	window.updateImage = function(){
		
		var url = $( '#contact-photo_local' ).val(),
			thumb_image = $( '.contact-thumb-wrapper .contact-image-thumb' );
			
		var image_src = url + '?' + Math.floor( ( Math.random() * 100 ) + 1 );
		var thumb_image_src = 'thumbs/' + image_src;
		
		$( '[name=thumb_local]' ).val( thumb_image_src );
		thumb_image.src = $( '#contact-thumb_local' ).val();
		
		$( '.contact-photo-wrapper' ).empty();
		
		if ( url != '' ){
			
			$( '.contact-photo-wrapper' ).append( '<a class="contact-image-photo-link" href="' + url + '" target="_blank"><img class="contact-image-photo" src="' + image_src + '" /></a>' );
			
			var image = $( '.contact-image-photo' );
			
			image.attr( 'src', thumb_image_src );
			
		}
		
		$.fancybox.close();
		
	}
	window.onFileChooseFunction = function(){
		
		var url = $( '#contact-photo_local' ).val();
		
		if ( url != '' ){
			
			$.imageCrop.open({
				
				imgSrc: url,
				callback: updateImage
				
			});
			
		}
		
	}
	
	$( document ).bind( 'ready', function(){
		
		window.updateImage();
		
		$( '#contact-photo_local' ).after( '<?= vui_el_button( array( 'attr' => 'data-rfdir="' . trim( $contact_image_path, DS ) . '" data-rffieldid="contact-photo_local" data-rftype="image"', 'url' => '#', 'text' => lang( 'select_image' ), 'get_url' => FALSE, 'id' => 'image-picker', 'icon' => 'more', 'only_icon' => TRUE, 'class' => 'modal-file-picker', ) ); ?>' );
		
		$( '.contact-image-photo-link' ).fancybox();
		
	});
	
	<?php } ?>
	
</script>
