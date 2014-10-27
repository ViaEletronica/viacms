
<?php

$unique_hash_id = md5( rand( 100, 1000 ) ) . uniqid();

?>

<div id="modal-controls-<?= $unique_hash_id; ?>" class="modal-controls controls">
		
	<div class="modal-controls-inner controls-inner">
		
		<input type="text" id="filter" placeholder="<?= lang( 'live_filter' ); ?>" class="live-filter" data-live-filter-for="#modal-content-<?= $unique_hash_id; ?> .view-user-submit-inner tr" ></input>
		
		<ul class="controls-menu">
			
			<li>
				
				<?= vui_el_button( array( 'text' => lang( 'download' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
				
				<ul>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_json_link' ], 'text' => lang( 'download_json' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_csv_link' ], 'text' => lang( 'download_csv' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_xls_link' ], 'text' => lang( 'download_xls' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_txt_link' ], 'text' => lang( 'download_txt' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_html_link' ], 'text' => lang( 'download_html' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
					<li>
						
						<?= vui_el_button( array( 'url' => $c_urls[ 'us_export_download_pdf_link' ], 'text' => lang( 'download_pdf' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>
						
					</li>
					
				</ul>
				
			</li>
			
		</ul>
		
	</div>
	
</div>

<div id="modal-content-<?= $unique_hash_id; ?>" class="modal-content">
	
	<div class="modal-content-inner view-user-submit-inner info-items">
		
		<table>
			
			<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>
				
				<?php
					
					$value_name = url_title( $field[ 'label' ], TRUE );
					$formatted_field_name = 'form[' . $value_name . ']';
					$value_value = ( isset( $post[ 'form' ][ $value_name ] ) ) ? $post[ 'form' ][ $value_name ] : ( ( isset( $user_submit[ 'data' ][ $value_name ] ) ) ? $user_submit[ 'data' ][ $value_name ] : '' );
					$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );
					
				?>
				
				<?php if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) { ?>
					
					<tr class="item-inner user-submit-info-item-inner">
						
						<td class="title user-submit-info-item-title info-item-title">
							
							<span class="filter-me">
								
								<?= lang( $field[ 'label' ] ); ?>
								
							</span>
							
						</td>
						
						<td class="value user-submit-info-item-value info-item-content">
							
							<span class="filter-me">
								
								<?= $value_value; ?>
								
							</span>
							
						</td>
						
					</tr>
					
				<?php } ?>
				
				
			<?php } ?>
			
		</table>
		
	</div>
	
</div>
