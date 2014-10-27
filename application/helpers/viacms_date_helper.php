<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function created_date( $date_time, $format ){
	
	$time = human_to_unix( $date_time );
	$day = mdate("%d", $time);
	$month = lang(mdate("%F", $time));
	$year = mdate("%Y", $time);
	$hour = mdate("%H", $time);
	$minute = lang(mdate("%i", $time));
	$second = mdate("%s", $time);
	
	return sprintf( $format, $day, $month, $year, $hour, $minute, $second);
	
}

/* End of file VECMS_date_helper.php */
/* Location: ./application/helpers/VECMS_date_helper.php */