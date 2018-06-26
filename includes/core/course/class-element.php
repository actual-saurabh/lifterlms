<?php

namespace LLMS\Core\Course_Elements;

use LLMS\Core as Core;

abstract class Element {
	use Core\Post, Core\Meta,Core\Settings;

	public $object_id;

	public $ID;


}

