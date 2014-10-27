	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
	
	<?php if ( defined( 'NIVO_SLIDER' ) ){ ?>
		
		<script type="text/javascript">
		
			$(window).load(function() {
				
				$('#slider').nivoSlider({
					
					effect: '<?= $params[ 'effect' ]; ?>',			   // Specify sets like: 'fold,fade,sliceDown'
					slices: <?= $params[ 'slices' ]; ?>,					 // For slice animations
					boxCols: <?= $params[ 'box_cols' ]; ?>,					 // For box animations
					boxRows: <?= $params[ 'box_rows' ]; ?>,					 // For box animations
					animSpeed: <?= $params[ 'anim_speed' ]; ?>,				 // Slide transition speed
					pauseTime: <?= $params[ 'pause_time' ]; ?>,				// How long each slide will show
					startSlide: <?= $params[ 'start_slide' ]; ?>,				  // Set starting Slide (0 index)
					directionNav: <?= $params[ 'direction_nav' ]; ?>,			 // Next & Prev navigation
					controlNav: <?= $params[ 'control_nav' ]; ?>,			   // 1,2,3... navigation
					controlNavThumbs: <?= $params[ 'control_nav_thumbs' ]; ?>,		// Use thumbnails for Control Nav
					pauseOnHover: <?= $params[ 'pause_on_hover' ]; ?>,			 // Stop animation while hovering
					manualAdvance: <?= $params[ 'manual_advance' ]; ?>,		   // Force manual transitions
					prevText: '<?= $params[ 'prev_text' ]; ?>',			   // Prev directionNav text
					nextText: '<?= $params[ 'next_text' ]; ?>',			   // Next directionNav text
					randomStart: <?= $params[ 'random_start' ]; ?>,			 // Start on a random slide
					beforeChange: function(){},	 // Triggers before a slide transition
					afterChange: function(){},	  // Triggers after a slide transition
					slideshowEnd: function(){},	 // Triggers after all slides have been shown
					lastSlide: function(){},		// Triggers when last slide is shown
					afterLoad: function(){}		 // Triggers when slider has loaded
					
				});
				
			});
			
		</script>
		
	<?php } ?>