<?php
// Take a MySQL formatted date (similar to, but not the same as ECMAScript 5 ISO-8601 format) such as:
// 2009-08-07 06:05:04
// And convert it to a RFC2822/IETF date format (because Safari is a bitch and doesn't accept the former):
// 07 Aug 2009 06:05:04
function manipulateDateTime($inputDateTime, $utc_visible = true) {
	$temp = DateTime::createFromFormat('Y-m-d H:i:s', $inputDateTime);
	$outputDateTime = $temp->format('d M Y H:i:s');

	if ($utc_visible === true) {
		return $outputDateTime.' UTC';
	} else {
		return $outputDateTime;
	}	
}

function ordinal($number) {
	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if (($number %100) >= 11 && ($number%100) <= 13) {
	   return $abbreviation = $number. 'th';
	} else {
	   return $abbreviation = $number. $ends[$number % 10];
	}
}
?>