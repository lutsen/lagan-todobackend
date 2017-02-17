<?php

namespace Lagan\Model;

/**
 * To-do itemn content model for http://www.todobackend.com/
 */

class Todo extends \Lagan\Lagan {

	function __construct() {
		$this->type = 'todo';
		
		// Description in admin interface
		$this->description = 'A to-do item.';

		$this->properties = [
			// Allways have a title
			[
				'name' => 'title',
				'description' => 'Title',
				'required' => true,
				'searchable' => true,
				'type' => '\Lagan\Property\Str',
				'input' => 'text'
			],
			[
				'name' => 'completed',
				'description' => 'Completed',
				'type' => '\Lagan\Property\Boolean',
				'input' => 'checkbox'
			],
			// I would rather use \Lagan\Property\Position here,
			// but due to the todobackend.com it has to be a "stupid" order,
			// meaning it won't correct itself for wromng input.
			[
				'name' => 'position', // If this is named order mysql errors can happen
				'description' => 'Order',
				'type' => '\Lagan\Property\Str',
				'input' => 'text',
				'validate' => 'integer'
			],
			[
				'name' => 'slug',
				'description' => 'Slug',
				'autovalue' => true,
				'type' => '\Lagan\Property\Slug',
				'input' => 'text'
			],
			[
				'name' => 'uid',
				'description' => 'UID',
				'autovalue' => true,
				'padding' => 10,
				'salt' => 'todobackend',
				'type' => '\Lagan\Property\Hashid',
				'input' => 'readonly'
			]
		];
	}

}

?>