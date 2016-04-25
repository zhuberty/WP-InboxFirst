<?php
/*
Methods:
	prettyDump
*/

if ( ! function_exists('prettyDump') )
{
	function prettyDump($obj)
	{
		# A prettier version of var_dump
		echo "<pre>" . var_export($obj, true) . "</pre>";
	}
}
?>