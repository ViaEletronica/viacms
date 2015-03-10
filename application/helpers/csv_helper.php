<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CSV Helpers
 * Inspiration from PHP Cookbook by David Sklar and Adam Trachtenberg
 *
 * @author		Jérôme Jaglale
 * @modifier	Frank Souza
 * @link		http://maestric.com/en/doc/php/codeigniter_csv
 */

// ------------------------------------------------------------------------

/**
 * Array to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('array_to_csv'))
{
	// let's add the $delimiter and $enclosure args ;)
	function array_to_csv( $array, $download = "", $separator = ',', $enclosure = '"' )
	{
		if ($download != "")
		{
			header('Content-Type: application/csv');
			header('Content-Disposition: attachement; filename="' . $download . '"');
		}

		ob_start();
		$f = fopen('php://output', 'w') or show_error("Can't open php://output");

		fwrite( $f, "\xEF\xBB\xBF" ); // UTF-8 BOM

		$n = 0;
		foreach ($array as $line)
		{
			$n++;

			$separator = ( $separator !== '' ? $separator : ',' );

			#if ( ! fputcsv( $f, $line, ( $delimiter !== '' ? $delimiter : ',' ), ( $enclosure !== '' ? $enclosure : chr( 0 ) ) ) )
			if ( ! fwrite( $f, $enclosure . implode( $enclosure . $separator . $enclosure , $line ) . $enclosure . "\n" ) )
			{
				show_error("Can't write line $n: $line");
			}
		}
		fclose($f) or show_error("Can't close php://output");
		$str = ob_get_contents();
		ob_end_clean();

		if ( $download == "" )
		{
			return $str;
		}
		else
		{
			echo $str;
		}
	}
}

// ------------------------------------------------------------------------

/**
 * Query to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('query_to_csv'))
{
	function query_to_csv($query, $headers = TRUE, $download = "" )
	{
		if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
		{
			show_error('invalid query');
		}

		$array = array();

		if ($headers)
		{
			$line = array();
			foreach ($query->list_fields() as $name)
			{
				$line[] = $name;
			}
			$array[] = $line;
		}

		foreach ($query->result_array() as $row)
		{
			$line = array();
			foreach ($row as $item)
			{
				$line[] = $item;
			}
			$array[] = $line;
		}

		echo array_to_csv($array, $download);
	}
}

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */