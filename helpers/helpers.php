<?php 
function getExcerpt($str, $startPos = 0, $maxLength= 134) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}
	
	return $excerpt;
}
