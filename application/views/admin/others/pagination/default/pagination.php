	
	<?php
	
	$adjacents = 2;
	$page = $cp;
	$prev = $page - 1;
	$next = $page + 1;
	$lpm1 = $tp - 1;
	$targetpage = 'uri';
	$pagination = '';
	
	?>
	
	<?php if ( $cp > 1 ) { ?>
	<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($cp-1, $ipp), $uri)); ?>"><?php echo lang('previous'); ?></a>
	<?php } else { ?>
	<span class="button inactive current"><?php echo lang('previous'); ?></span>
	<?php } ?>
	
	<?php if ($tp < 7 + ($adjacents * 2)){ ?>
	
		<?php for ( $i=1; $i <= $tp; $i++ ) { ?>
	
			<?php if ( $i != $cp ) { ?>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($i, $ipp), $uri)); ?>"><?php echo $i; ?></a>
			<?php } else { ?>
			<span class="button inactive current"><?php echo $i; ?></span>
			<?php } ?>
			
		<?php } ?>
		
	<?php } else if($tp > 5 + ($adjacents * 2)) { ?>
			
		<?php if($page <= 1 + ($adjacents * 2)) { ?>
			
			<?php for ($i = 1; $i < 4 + ($adjacents * 2); $i++){ ?>
				
				<?php if ( $i != $cp ) { ?>
					<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($i, $ipp), $uri)); ?>"><?php echo $i; ?></a>
				<?php } else { ?>
					<span class="button inactive current"><?php echo $i; ?></span>
				<?php } ?>
				
			<?php } ?>
			<span class="button inactive">...</span>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($tp-1, $ipp), $uri)); ?>"><?php echo $tp-1; ?></a>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($tp, $ipp), $uri)); ?>"><?php echo $tp; ?></a>
			
		<?php } else if($tp - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { ?>
			
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array(1, $ipp), $uri)); ?>"><?php echo 1; ?></a>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array(2, $ipp), $uri)); ?>"><?php echo 2; ?></a>
			<span class="button inactive">...</span>
			<?php for ($i = $cp - $adjacents; $i <= $cp + $adjacents; $i++) { ?>
				
				<?php if ( $i != $cp ) { ?>
					<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($i, $ipp), $uri)); ?>"><?php echo $i; ?></a>
				<?php } else { ?>
					<span class="button inactive current"><?php echo $i; ?></span>
				<?php } ?>
				
			<?php } ?>
			<span class="button inactive">...</span>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($tp-1, $ipp), $uri)); ?>"><?php echo $tp-1; ?></a>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($tp, $ipp), $uri)); ?>"><?php echo $tp; ?></a>
			
		<?php } else { ?>
			
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array(1, $ipp), $uri)); ?>"><?php echo 1; ?></a>
			<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array(2, $ipp), $uri)); ?>"><?php echo 2; ?></a>
			<span class="button inactive">...</span>
			<?php for ($i = $tp - (2 + ($adjacents * 2)); $i <= $tp; $i++) { ?>
				
				<?php if ( $i != $cp ) { ?>
					<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($i, $ipp), $uri)); ?>"><?php echo $i; ?></a>
				<?php } else { ?>
					<span class="button inactive current"><?php echo $i; ?></span>
				<?php } ?>
				
			<?php } ?>
			
		<?php } ?>
	<?php } ?>
	<?=$pagination?>
	
	
	<?php if ( $cp < $tp ) { ?>
	<a class="button" href="<?php echo get_url(str_replace(array('%p%', '%ipp%'), array($cp+1, $ipp), $uri)); ?>"><?php echo lang('next'); ?></a>
	<?php } else { ?>
	<span class="button inactive current"><?php echo lang('next'); ?></span>
	<?php } ?>