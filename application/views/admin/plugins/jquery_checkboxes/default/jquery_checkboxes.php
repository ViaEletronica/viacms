<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
	
	$( document ).on( 'click', '#select-all-items', function( e ){
		
		var jthis = $( this );
		var table = $( e.target ).closest( 'table' );
		
		$( 'td input:checkbox', table ).prop( 'checked', this.checked );
		
		
	});
	$( document ).on( 'click', 'input:checkbox', function( e ){
		
		var jthis = $( this );
		var table = $( e.target ).closest( 'table' );
		var row = $( e.target ).closest( 'tr' );
		
		checkMultiSelectionActionInputs();
		
		$( '.last-checked' ).removeClass( 'last-checked' );
		
		if ( this.checked ){
			
			jthis.addClass( 'last-checked' );
			
		}
		else {
			
		}
		
	});
	
	function checkMultiSelectionActionInputs(){
		
		var inputsCheckedCount = $( '.multi-selection-action:checked' ).length;
		
		if ( inputsCheckedCount > 0 ){
			
			$( '.multi-selection-action-input' ).removeClass( 'no-multi-selection-action' );
			$( '.multi-selection-action-input' ).addClass( 'has-multi-selection-action' );
			$( '.multi-selection-action-input' ).attr( 'disabled', false );
			
		}
		else {
			
			$( '.multi-selection-action-input' ).removeClass( 'has-multi-selection-action' );
			$( '.multi-selection-action-input' ).addClass( 'no-multi-selection-action' );
			$( '.multi-selection-action-input' ).attr( 'disabled', true );
			
		}
		
		$( 'table input:checkbox' ).closest( 'tr' ).removeClass( 'selected' );
		$( 'table input:checkbox:checked' ).closest( 'tr' ).addClass( 'selected' );
		
	}
	
	$( document ).on( 'ready', function( e ){
		
		checkMultiSelectionActionInputs();
		
		$( "table.multi-selection-table" ).checkboxes( 'range', true )
		
	});
	
</script>
