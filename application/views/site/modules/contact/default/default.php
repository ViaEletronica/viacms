
<div class="contact-module contact-module-layout-<?= $params[ 'contact_module_layout' ]; ?> contact-module-theme-<?= $params[ 'contact_module_theme' ]; ?>" itemscope itemtype="http://schema.org/Organization">
	
	<?php if ( check_var( $params[ 'contact_module_show_name' ] ) ) { ?>
		
	<h4 itemprop="name" class="contact-name"><?= $contact[ 'name' ]; ?></h4>
	
	<?php } ?>
	
	<?php
	
	$phones = array();
	
	foreach ( $contact[ 'phones' ] as $key => $phone ) {
		
		if ( @$phone[ 'publicly_visible' ] ){
			
			$phones[] = $phone;
			
		}
		
	} ?>
	
	<?php if ( isset( $params[ 'contact_module_show_phones' ] ) AND $params[ 'contact_module_show_phones' ] AND $contact[ 'phones' ] AND ! empty( $phones ) ) { ?>
	
	<p id="contact-phones" class="contact-info-item">
		
		<?php if ( @$params[ 'contact_module_show_phones_title' ] ) {?>
			
			<?php if ( count( $phones ) > 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'phones' ); ?></span>
				
			<?php } else if ( count( $phones ) == 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'phone' ); ?></span>
				
			<?php } ?>
			
		<?php } ?>
		
		<?php foreach ( $phones as $key => $phone ) { ?>
		
			<span class="contact-module-phone">
				
				<a href="tel://<?= str_replace( array( ' ', '-', '(', ')' ), '', $phone[ 'area_code' ] . $phone[ 'number' ] . $phone[ 'extension_number' ] ); ?>">
					
					<span class="contact-module-phone-number" itemprop="telephone">
						
						<?= ( check_var( $phone[ 'area_code' ] ) ? '(' . $phone[ 'area_code' ] . ')' : '' ); ?> <?= $phone[ 'number' ]; ?> <?= $phone[ 'extension_number' ]; ?>
						
					</span>
					
				</a>
				
				<?php if ( check_var( $params[ 'contact_module_show_phones_titles' ] ) AND @$phone[ 'phone_title_publicly_visible' ] and @$phone[ 'title' ] ){ ?>
					
					<span class="contact-module-phone-title">
						
						<?= ( @$phone[ 'title' ] ? '(' . $phone[ 'title' ] . ')' : '' ); ?>
						
					</span>
					
				<?php } ?>
				
			</span>
			
		<?php } ?>
		
	</p>
	
	<?php } ?>
	
	
	
	<?php
	
	$emails = array();
	
	foreach ( $contact[ 'emails' ] as $key => $email ) {
		
		if ( @$email[ 'publicly_visible' ] ){
			
			$emails[] = $email;
			
		}
		
	} ?>
	
	<?php if ( isset( $params[ 'contact_module_show_emails' ] ) AND $params[ 'contact_module_show_emails' ] AND $contact[ 'emails' ] AND ! empty( $emails ) ) { ?>
	
	<p id="contact-emails" class="contact-info-item">
		
		<?php if ( @$params[ 'contact_module_show_emails_title' ] ) {?>
			
			<?php if ( count( $emails ) > 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'emails' ); ?></span>
				
			<?php } else if ( count( $emails ) == 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'email' ); ?></span>
				
			<?php } ?>
			
		<?php } ?>
		
		<?php foreach ( $emails as $key => $email ) { ?>
			
			<?php $email_title = ( ( @$params[ 'contact_module_show_emails_titles' ] AND @$email[ 'email_title_publicly_visible' ] AND @$email[ 'title' ] ) ? TRUE : FALSE ); ?>
			
			<span class="contact-module-email">
				
				<a href="mailto:<?= $contact[ 'name' ]; ?><<?= $email[ 'email' ]; ?>>" class="contact-module-email-value" itemprop="email">
					
					<?= $email[ 'email' ]; ?>
					
				</a>
				
				<?php if ( $email_title ){ ?>
					
					<span class="contact-module-phone-title">
						
						<?= ( @$email[ 'title' ] ? '(' . $email[ 'title' ] . ')' : '' ); ?>
						
					</span>
					
				<?php } ?>
				
			</span>
			
		<?php } ?>
		
	</p>
	
	<?php } ?>
	
	
	
	
	
	<?php
	
	$websites = array();
	
	foreach ( $contact[ 'websites' ] as $key => $website ) {
		
		if ( @$website[ 'publicly_visible' ] ){
			
			$websites[] = $website;
			
		}
		
	} ?>
	
	<?php if ( isset( $params[ 'contact_module_show_websites' ] ) AND $params[ 'contact_module_show_websites' ] AND $contact[ 'websites' ] AND ! empty( $websites ) ) { ?>
	
	<p id="contact-websites" class="contact-info-item">
		
		<?php if ( @$params[ 'contact_module_show_websites_title' ] ) {?>
			
			<?php if ( count( $websites ) > 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'websites' ); ?></span>
				
			<?php } else if ( count( $websites ) == 1 ) { ?>
				
				<span class="contact-info-title"><?= lang( 'website' ); ?></span>
				
			<?php } ?>
			
		<?php } ?>
		
		<?php foreach ( $websites as $key => $website ) { ?>
			
			<?php $website_title = ( ( @$params[ 'contact_module_show_websites_titles' ] AND @$website[ 'website_title_publicly_visible' ] AND @$website[ 'title' ] ) ? TRUE : FALSE ); ?>
			
			<span class="contact-module-website">
				
				<?php if ( $website_title ){ ?>
					
					<span class="contact-module-website-title">
						
						<?= ( @$website[ 'title' ] ? $website[ 'title' ] . ':' : '' ); ?>
						
					</span>
					
				<?php } ?>
				
				<?php
					
					$website[ 'title' ] = parse_url( $website[ 'url' ] );
					$website[ 'title' ] = url_title( $website[ 'title' ][ 'host' ] ) ;
					
				?>
				
				<a href="<?= prep_url( $website[ 'url' ] ); ?>" class="contact-module-website-value <?= ( 'list-info-wrapper-website-' . $website[ 'title' ] ); ?>" target="_blank" itemprop="website">
					
					<?= $website[ 'url' ]; ?>
					
				</a>
				
			</span>
			
		<?php } ?>
		
	</p>
	
	<?php } ?>
	
	
	
	<?php
	
	$addresses = array();
	
	foreach ( $contact[ 'addresses' ] as $key => $address ) {
		
		if ( @$phone[ 'publicly_visible' ] ){
			
			$addresses[] = $address;
			
		}
		
	} ?>
	
	<?php if ( isset( $params[ 'contact_module_show_addresses' ] ) AND $params[ 'contact_module_show_addresses' ] AND $contact[ 'addresses' ] AND ! empty( $addresses ) ) { ?>
		
		<p id="contact-addresses" class="contact-info-item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			
			<?php if ( @$params[ 'contact_module_show_addresses_title' ] ) {?>
				
				<?php if ( count( $addresses ) > 1 ) { ?>
					
					<span class="contact-info-title"><?= lang( 'addresses' ); ?></span>
					
					<?php } else if ( count( $addresses ) == 1 ) { ?>
					
					<span class="contact-info-title"><?= lang( 'address' ); ?></span>
					
				<?php } ?>
				
			<?php } ?>
			
			<?php foreach ( $contact[ 'addresses' ] as $key => $address ) { ?>
				
				<?php if ( @$params[ 'contact_module_show_addresses_titles' ] AND @$address[ 'address_title_publicly_visible' ] AND @$address[ 'title' ] ){ ?>
					
					<span class="contact-module-address-title">
						
						<?= ( @$address[ 'title' ] ? $address[ 'title' ] : '' ); ?>
						
					</span>
					
				<?php } ?>
				
				
				
				<?php $pre_text = FALSE; ?>
				<?php $pre_text_line_1 = FALSE; ?>
				
				<?php if ( @$address[ 'public_area_title' ] OR @$address[ 'number' ] OR @$address[ 'complement' ] OR @$address[ 'neighborhood_title' ] ) { ?>
					
					<span class="contact-module-address-street" itemprop="streetAddress">
					
						<?php if ( @$params[ 'contact_module_show_public_area' ] AND @$address[ 'public_area_title' ] ) { ?>
							
							<span class="contact-module-address-public-area">
								
								<?= @$address[ 'public_area_title' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_1 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
						<?php if ( @$params[ 'contact_module_show_number' ] AND @$address[ 'number' ] ) { ?>
							
							<span class="contact-module-address-number">
								
								<?= ( $pre_text_line_1 ? ', ' : '' ); ?>
								
								<?= lang( 'abbr_number' ); ?>
								
								<?= @$address[ 'number' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_1 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
						<?php if ( @$params[ 'contact_module_show_complement' ] AND @$address[ 'complement' ] ) { ?>
							
							<span class="contact-module-address-complement">
								
								<?= @$address[ 'complement' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_1 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
						<?php if ( @$params[ 'contact_module_show_neighborhood' ] AND @$address[ 'neighborhood_title' ] ) { ?>
							
							<span class="contact-module-address-neighborhood">
								
								<?= @$address[ 'neighborhood_title' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_2 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
					</span>
					
				<?php } ?>
				
				
				
				<?php $pre_text_line_2 = FALSE; ?>
				
				<?php if ( @$address[ 'city_title' ] OR @$address[ 'state_acronym' ] ) { ?>
					
					<span class="contact-module-address-city-state">
						
						<?php if ( @$params[ 'contact_module_show_city' ] AND @$address[ 'city_title' ] ) { ?>
							
							<span class="contact-module-address-city" itemprop="addressLocality">
								
								<?= @$address[ 'city_title' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_2 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
						<?php if ( @$params[ 'contact_module_show_state' ] AND @$address[ 'state_acronym' ] ) { ?>
							
							<?= ( $pre_text_line_2 ? '-' : '' ); ?>
							
							<span class="contact-module-address-state" itemprop="addressRegion">
							
								<?= @$address[ 'state_acronym' ]; ?>
								
								<?php $pre_text = TRUE; ?>
								<?php $pre_text_line_2 = TRUE; ?>
								
							</span>
							
						<?php } ?>
						
					</span>
					
				<?php } ?>
				
				
				<?php $pre_text_line_3 = FALSE; ?>
			
				<?php if ( @$params[ 'contact_module_show_postal_code' ] AND @$address[ 'postal_code' ] ) { ?>
					
					<span class="contact-module-address-postal-code" itemprop="postalCode">
						
						<span class="contact-module-address-postal-code-title">
							
							<?= lang( 'postal_code' ); ?>
							
						</span>
						
						<span itemprop="postalCode">
							
							<?= @$address[ 'postal_code' ]; ?>
							
						</span>
						
						<?php $pre_text = TRUE; ?>
						<?php $pre_text_line_3 = TRUE; ?>
						
					</span>
					
				<?php } ?>
				
				
				
				<?php $pre_text_line_4 = FALSE; ?>
				
				<?php if ( @$params[ 'contact_module_show_country' ] AND @$address[ 'country_title' ] ) { ?>
					
					<span class="contact-module-address-country" itemprop="addressCountry">
						
						<?= @$address[ 'country_title' ]; ?>
						
						<?php $pre_text = TRUE; ?>
						<?php $pre_text_line_4 = TRUE; ?>
						
					</span>
					
				<?php } ?>
				
			<?php } ?>
			
		</p>
		
	<?php } ?>
	
</div>

<div class="clear"></div>