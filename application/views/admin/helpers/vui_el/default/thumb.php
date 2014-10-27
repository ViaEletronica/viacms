

<<?= $figure ? 'figure' : 'div'; ?> id="<?= $id; ?>" class="thumb <?= $wrapper_class; ?>">
	
	<div class="s1 inner">
		
		<div class="s2">
			
			<?php if ( check_var( $href ) ){ ?>
			<a class="s3 <?= $modal ? 'thumb-modal' : ''; ?>" href="<?= $href; ?>" title="<?= $title; ?>" <?= $target ? 'target="' . $target . '"' : ''; ?> <?= $rel ? 'rel="' . $rel . '"' : ''; ?>>
			<?php } ?>
				
				<img <?= $rel ? 'rel="' . $rel . '"' : ''; ?> src="<?= $src; ?>" alt="<?= $title; ?>" <?= $attr; ?> />
				
			<?php if ( check_var( $href ) ){ ?>
			</a>
			<?php } ?>
			
		</div>
		
	</div>
	
	<?php if ( $text ){ ?>
		
		<<?= $figure ? 'figcaption' : 'div class="caption"'; ?>><?= $text; ?></<?= $figure ? 'figcaption' : 'div'; ?>>
		
	<?php } ?>
	
</<?= $figure ? 'figure' : 'div'; ?>>

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
