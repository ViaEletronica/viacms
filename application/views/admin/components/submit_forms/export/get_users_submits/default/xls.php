
<html lang="<?= $this->mcm->filtered_system_params[ $this->mcm->environment . '_language' ]; ?>">

<head>

	<meta http-equiv="content-type" content="application/xls; charset=UTF-8" />
		<meta charset="utf-8" />


</head>

<body>

<table>

	<?php foreach ( $submit_forms as $key => $submit_form ) { ?>

	<?php if ( count( $submit_form[ 'users_submits' ] ) > 0 ){ ?>

	<tr>

		<th>

			<?= $submit_form[ 'title' ]; ?> <?= count( $submit_form[ 'users_submits' ] ); ?>

		</th>

	</tr>

	<tr>

		<th>

			<?= lang( 'user_submit_id' ); ?>

		</th>

		<th>

			<?= lang( 'submit_datetime' ); ?>

		</th>

		<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>

			<?php if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) { ?>

				<th>

					<?= lang( $field[ 'label' ] ); ?>

				</th>

			<?php } ?>

		<?php } ?>

	</tr>

	<?php foreach ( $submit_form[ 'users_submits' ] as $key => $user_submit ) { ?>

		<tr>

		<td>

			<?= $user_submit[ 'id' ]; ?>

		</td>

		<td>

			<?= $user_submit[ 'submit_datetime' ]; ?>

		</td>

		<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>

			<?php

				$value_name = url_title( $field[ 'label' ], '-', TRUE );
				$formatted_field_name = 'form[' . $value_name . ']';
				$value_value = isset( $user_submit[ 'data' ][ $value_name ] ) ? $user_submit[ 'data' ][ $value_name ] : '';

			?>

			<?php if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) { ?>

				<td>

					<?= $value_value; ?>

				</td>

			<?php } ?>

		<?php } ?>

		</tr>

	<?php } ?>

	<tr>

		<?php foreach ( $submit_form[ 'users_submits' ] as $key => $user_submit ) { ?>

			<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>

				<?php

					$value_name = url_title( $field[ 'label' ], '-', TRUE );
					$formatted_field_name = 'form[' . $value_name . ']';
					$value_value = ( isset( $post[ 'form' ][ $value_name ] ) ) ? $post[ 'form' ][ $value_name ] : ( ( isset( $user_submit[ 'data' ][ $value_name ] ) ) ? $user_submit[ 'data' ][ $value_name ] : '' );

				?>

				<?php if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) { ?>

					<td></td>

				<?php } ?>

			<?php } ?>

		<?php } ?>

	</tr>

	<?php } ?>

	<?php } ?>

</table>

</body>

</html>