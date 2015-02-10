
	<?php

		$this->plugins->load( 'jquery_checkboxes' );
		$this->plugins->load( 'fancybox' );
		$this->plugins->load( 'modal_users_submits' );

	?>

	<div class="items-list">

		<header class="component-head">

			<h1>

				<?= lang( 'users_submits' ); ?>

			</h1>

		</header>

		<?php if ( check_var( $submit_form ) AND $users_submits ){ ?>

			<?php if ( $pagination ){ ?>
			<div class="pagination">
				<?= $pagination; ?>
			</div>
			<?php } ?>

			<div class="form-actions to-toolbar">

				<ul class="controls-menu multi-selection-action-input">

					<li>

						<?= vui_el_button( array( 'text' => lang( 'download' ), 'icon' => 'download', 'only_icon' => FALSE, ) ); ?>

						<ul>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_json' ), 'icon' => 'json', 'button_type' => 'button', 'type' => 'submit', 'value' => 'json', 'name' => 'submit_export', 'id' => 'submit-export-json', 'form' => 'users-submits-form', ) ); ?>

							</li>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_csv' ), 'icon' => 'csv', 'button_type' => 'button', 'type' => 'submit', 'value' => 'csv', 'name' => 'submit_export', 'id' => 'submit-export-csv', 'form' => 'users-submits-form', ) ); ?>

							</li>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_xls' ), 'icon' => 'xls', 'button_type' => 'button', 'type' => 'submit', 'value' => 'xls', 'name' => 'submit_export', 'id' => 'submit-export-xls', 'form' => 'users-submits-form', ) ); ?>

							</li>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_txt' ), 'icon' => 'txt', 'button_type' => 'button', 'type' => 'submit', 'value' => 'txt', 'name' => 'submit_export', 'id' => 'submit-export-txt', 'form' => 'users-submits-form', ) ); ?>

							</li>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_html' ), 'icon' => 'html', 'button_type' => 'button', 'type' => 'submit', 'value' => 'html', 'name' => 'submit_export', 'id' => 'submit-export-html', 'form' => 'users-submits-form', ) ); ?>

							</li>

							<li>

								<?= vui_el_button( array( 'text' => lang( 'download_pdf' ), 'icon' => 'pdf', 'button_type' => 'button', 'type' => 'submit', 'value' => 'pdf', 'name' => 'submit_export', 'id' => 'submit-export-pdf', 'form' => 'users-submits-form', ) ); ?>

							</li>

						</ul>

					</li>

				</ul>

				<?= vui_el_button( array( 'text' => lang( 'remove' ), 'icon' => 'remove', 'class' => 'multi-selection-action-input', 'button_type' => 'button', 'type' => 'submit', 'value' => 'remove', 'name' => 'submit_remove', 'id' => 'submit-remove', 'form' => 'users-submits-form', ) ); ?>

			</div>


			<?= form_open( get_url( $c_urls[ 'us_batch_link' ] ), array( 'id' => 'users-submits-form', ) ); ?>

			<table class="data-list responsive multi-selection-table">

				<tr>

					<th class="col-checkbox">

						<?= vui_el_checkbox( array( 'title' => lang( 'select_all' ), 'value' => 'select_all', 'name' => 'select_all_items', 'id' => 'select-all-items', ) ); ?>

					</th>

					<?php if ( ! check_var( $submit_form_id ) AND ! check_var( $columns ) ) { ?>

					<?php $current_column = 'submit_form_title'; ?>

					<th class="col-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">

						<?= anchor( get_url( 'admin' . '/' . $component_name.'/' . $component_function . '/a/cob/ob/' . $current_column) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"' ); ?>

					</th>

					<?php } ?>

					<?php $current_column = 'id'; ?>

					<th class="col-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">

						<?= anchor( get_url( 'admin' . '/' . $component_name.'/' . $component_function . '/a/cob/ob/' . $current_column) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"' ); ?>

					</th>

					<?php $current_column = 'submit_datetime'; ?>

					<th class="col-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">

						<?= anchor( get_url( 'admin' . '/' . $component_name.'/' . $component_function . '/a/cob/ob/' . $current_column) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"' ); ?>

					</th>

					<?php if ( ! check_var( $submit_form_id ) AND ! check_var( $columns ) ) { ?>

					<?php $current_column = 'output'; ?>

					<th class="col-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">

						<?= anchor( get_url( 'admin' . '/' . $component_name.'/' . $component_function . '/a/cob/ob/' . $current_column) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"' ); ?>

					</th>

					<?php } else { ?>

					<?php foreach ( $columns as $key => $column ) { ?>

					<th class="col-<?= $column[ 'visible' ] ? 'visible' : 'hidden'; ?>">

						<?= $column[ 'title' ]; ?>

					</th>

					<?php } ?>

					<?php } ?>

					<?php $current_column = 'operations'; ?>

					<th class="col-<?= $current_column; ?> op-column">

						<?= lang( $current_column ); ?>

					</th>

				</tr>

				<?php foreach( $users_submits as $user_submit ): ?>
				<tr>

					<td class="col-checkbox">

						<?= vui_el_checkbox( array( 'value' => $user_submit[ 'id' ], 'name' => 'selected_users_submits_ids[]', 'form' => 'users-submits-form', 'class' => 'multi-selection-action', ) ); ?>

					</td>

					<?php if ( ! check_var( $submit_form_id ) AND ! check_var( $columns ) ) { ?>

					<?php $current_column = 'submit_form_title'; ?>

					<td class="col-<?= $current_column; ?>">

						<?= anchor( $user_submit[ 'users_submits_link' ] , $user_submit[ $current_column ], 'class="" title="' . lang( 'click_to_edit_this_user_submit' ) . '"' ); ?>

					</td>

					<?php } ?>

					<?php $current_column = 'id'; ?>

					<td class="col-<?= $current_column; ?>">

						<?= $user_submit[ $current_column ]; ?>

					</td>

					<?php $current_column = 'submit_datetime'; ?>

					<td class="col-<?= $current_column; ?>">

						<?= $user_submit[ $current_column ]; ?>

					</td>

					<?php if ( ! check_var( $submit_form_id ) AND ! check_var( $columns ) ) { ?>

					<?php $current_column = 'output'; ?>

					<td class="col-<?= $current_column; ?>">

						<?= word_limiter( strip_tags( $user_submit[ $current_column ] ), 10 ); ?>

					</td>

					<?php } else { ?>

					<?php foreach ( $columns as $c_key => $column ) { ?>

					<td class="col-<?= $column[ 'visible' ] ? 'visible' : 'hidden'; ?>">

						<?php if ( check_var( $user_submit[ 'data' ][ $column[ 'alias' ] ] ) ) { ?>
						<?= word_limiter( strip_tags( $user_submit[ 'data' ][ $column[ 'alias' ] ] ), 10 ); ?>
						<?php } ?>

					</td>

					<?php } ?>

					<?php } ?>

					<?php $current_column = 'operations'; ?>

					<td class="col-<?= $current_column; ?>">

						<?= vui_el_button( array( 'url' => $user_submit[ 'view_link' ], 'text' => lang( 'action_view' ), 'icon' => 'view', 'only_icon' => TRUE, 'class' => 'modal-users-submits', 'attr' => 'rel="company-contacts-' . $user_submit[ 'submit_form_id' ] . '" data-mus-last-modal-group="' . ( $this->input->get( 'last-modal-group' ) ? $this->input->get( 'last-modal-group' ) : 'users-submits-' . $user_submit[ 'submit_form_id' ] ) . '" data-mus-action="gus" data-user-submit-id="' . $user_submit[ 'id' ] .'" data-submit-form-id="' . $user_submit[ 'submit_form_id' ] .'"' ) ); ?>

						<!--<?= vui_el_button( array( 'url' => $user_submit[ 'edit_link' ], 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>-->

						<!--<?= vui_el_button( array( 'url' => $user_submit[ 'remove_link' ], 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>-->

					</td>

				</tr>
				<?php endforeach; ?>
			</table>

			<?= form_close(); ?>

			<?php if ( $pagination ){ ?>
			<div class="pagination">
				<?= $pagination; ?>
			</div>
			<?php } ?>

		<?php } else { ?>

			<?= vui_el_button( array( 'text' => lang( 'no_users_submits' ), 'icon' => 'error', ) ); ?>

		<?php } ?>

	</div>
