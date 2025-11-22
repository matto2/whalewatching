<?php

	function pageTitle( $title ) {
		if ( config('app.title' ) ) {
			return $title . ' | ' . config('app.title');
		}
		return $title;
	}

?>