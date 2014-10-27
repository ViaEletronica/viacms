
<label class="vui-checkbox<?= $wrapper_class ? " $wrapper_class" : ''; ?>" <?= $title ? 'title="' . lang( $title ) . '"' : ''; ?>>
	
	<?php
		
		$input_params = array(
			
			'class' => 'vui-input-checkbox',
			
		);
		
		if ( check_var( $name ) ) $input_params[ 'name' ] = $name;
		if ( $id ) $input_params[ 'id' ] = $id;
		if ( $form ) $input_params[ 'form' ] = $form;
		if ( $checked ) $input_params[ 'checked' ] = 'checked';
		if ( $value ) $input_params[ 'value' ] = $value;
		if ( $title ) $input_params[ 'title' ] = $title;
		if ( check_var( $class ) ) $input_params[ 'class' ] = $input_params[ 'class' ] . ' ' . $class;
		
		echo form_checkbox( $input_params );
		
	?>
	
	<span class="check"></span>
	
	<span class="content">
		
		<?= lang( $text ); ?>
		
	</span>
	
</label>