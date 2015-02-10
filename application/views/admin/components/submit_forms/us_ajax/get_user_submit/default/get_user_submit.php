
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

			<?php

				$_tmp_array = array();

				foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {

					if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

						$_tmp_array[ url_title( $field[ 'label' ], '-', TRUE ) ] = $field;

					}

				}

			?>

			<?php foreach ( $user_submit[ 'data' ] as $us_key => $field ) { ?>

				<tr class="item-inner user-submit-info-item-inner">

					<td class="title user-submit-info-item-title info-item-title">

						<span class="filter-me">

							<?= lang( isset( $_tmp_array[ $us_key ][ 'label' ] ) ? $_tmp_array[ $us_key ][ 'label' ] : '<span class="error" title="' . lang( 'submit_forms_error_no_field_on_submit_form' ) . '">[' . $us_key . ']</span>' ); ?>

						</span>

					</td>

					<td class="value user-submit-info-item-value info-item-content">

						<span class="filter-me">

							<?= $field; ?>

						</span>

					</td>

				</tr>

			<?php } ?>

		</table>

	</div>

</div>
