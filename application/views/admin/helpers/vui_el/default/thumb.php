

<<?= $figure ? 'figure' : $wrappers_el_type; ?> id="<?= $id; ?>" class="thumb <?= $wrapper_class; ?>">
	
	<<?= $wrappers_el_type; ?> class="s1 inner">
		
		<<?= $wrappers_el_type; ?> class="s2">
			
			<?php if ( check_var( $href ) ){ ?>
			<a class="s3 <?= $modal ? 'thumb-modal' : ''; ?>" href="<?= $href; ?>" <?= element_title( $title ); ?> <?= $target ? 'target="' . $target . '"' : ''; ?> <?= $rel ? 'rel="' . $rel . '"' : ''; ?>>
			<?php } ?>
				
				<img <?= $rel ? 'rel="' . $rel . '"' : ''; ?> src="<?= $src; ?>" alt="<?= strip_tags( $title ); ?>" <?= element_title( $title ); ?> <?= $attr; ?> />
				
			<?php if ( check_var( $href ) ){ ?>
			</a>
			<?php } ?>
			
		</<?= $wrappers_el_type; ?>>
		
	</<?= $wrappers_el_type; ?>>
	
	<?php if ( $text ){ ?>
		
		<<?= $figure ? 'figcaption' : 'div class="caption"'; ?>><?= $text; ?></<?= $figure ? 'figcaption' : 'div'; ?>>
		
	<?php } ?>
	
</<?= $figure ? 'figure' : $wrappers_el_type; ?>>

<?php if ( $modal ) { ?>
	
	<?php if ( $this->plugins->load( 'fancybox' ) AND ! defined( 'MODAL_THUMBS_ON' ) ){ ?>
	
	<?php define( 'MODAL_THUMBS_ON', TRUE ); ?>
	
	<script type="text/javascript" >
		
		$( document ).on( 'ready', function( e ){
			
			$(".thumb-modal").fancybox();
			
		});
		
	</script>
	
	<?php } ?>
	
<?php } ?>
