<?php

namespace FluentCrud\App\Hooks\Handlers;

use FluentCrud\App\App;

class CPTHandler
{
	/*
	* Add all Custom Post Type classes here to
	* register all of your Custom Post Types.
	*/

	protected $customPostTypes = [
		// ExampleCPT::class
	];

	public function registerPostTypes()
	{
		foreach ($this->customPostTypes as $cpt) {
			App::make($cpt)->registerPostType();
		}
	}
}
