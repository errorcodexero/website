<?php

	$list_contact_options = array(
		array('telnumber', __( 'Telephone Number', '1425'), 'phone'),
		array('mobile', __( 'Mobile Number', '1425'), 'mobile'),
		array('email', __( 'Email Address', '1425'), 'envelope'),
		array('address', __( 'Address', '1425'), 'map-marker'),
	);

	$arraycount = count($list_contact_options);
	for ($row = 0; $row <  $arraycount; $row++) {
		if( get_theme_mod( $list_contact_options[$row][0] . '_textbox_header_one' ) ){
			echo '<span><span class="fa fa-' . $list_contact_options[$row][2] . '"></span> ' . get_theme_mod( $list_contact_options[$row][0] . '_textbox_header_one' ) . '</span>';
		}
	}
