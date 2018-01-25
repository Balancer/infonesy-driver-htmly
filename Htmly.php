<?php

namespace Infonesy\Driver;

class Htmly extends \B2\Obj
{
	var $id = NULL;

	function __construct($htmly_root)
	{
		$this->id = $htmly_root;
	}

	function content_dir() { return $this->id . '/content'; }

	function import_blog_post($object)
	{
		$post = new Htmly\Blog\Post(NULL);
		$post->set('htmly', $this);
//		dump($object);
		$post->dirt_make($object);
	}
}
