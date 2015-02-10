<?php

	$current_order_by_options = isset( $layout_params[ 'params_spec' ][ 'layout_specific_params' ][ 'articles_per_category_order_by' ][ 'options' ] ) ? $layout_params[ 'params_spec' ][ 'layout_specific_params' ][ 'articles_per_category_order_by' ][ 'options' ] : array();
	$layout_params[ 'params_spec' ][ 'layout_specific_params' ][ 'articles_per_category_order_by' ][ 'options' ] = $current_order_by_options + $order_by_options;

?>