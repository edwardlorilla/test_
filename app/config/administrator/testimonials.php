<?php

return array(
	/**
	 * Model title
	 *
	 * @type string
	 */
	'title' => 'Testimonials',

	/**
	 * The singular name of your model
	 *
	 * @type string
	 */
	'single' => 'testimonial',

	/**
	 * The class name of the Eloquent model that this config represents
	 *
	 * @type string
	 */
	'model' => 'Testimonial',

	/**
	 * The columns array
	 *
	 * @type array
	 */
	'columns' => array(
	    'name' => array(
	        'title' => 'Name'
	    ),
	    'testimonial' => array(
	        'title' => 'Testimonial',
	    ),
	    'active' => array(
	        'title' => 'Active',
	    )
	),

	/**
	 * The edit fields array
	 *
	 * @type array
	 */
	'edit_fields' => array(
	    'name' => array(
	        'title' => 'Name',
	        'type' => 'text'
	    ),
	    'testimonial' => array(
	        'title' => 'Testimonial',
	        'type' => 'textarea'
	    ),
	    'active' => array(
	        'title' => 'Active',
	        'type' => 'bool'
	    )
	),
);
