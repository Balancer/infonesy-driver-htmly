<?php

namespace Infonesy\Driver\Htmly\Blog;

class Post extends \B2\Obj
{
	function dirt_make($x)
	{
		$post_dir = $this->htmly()->content_dir().'/'.$x->user().'/blog/'.$x->category().'/post';

		$post_file = $post_dir.'/'
			.date('Y-m-d-H-i-s', $x->create_time())
			.'_tag_'.$x->post_id().'-'
			.\URLify::filter($x->title(), 128, "", true) . '.md';

		$content="<!--t {$x->title()} t-->
<!--d {$x->description()} d-->
<!--tag {$x->get('keywords_string')} tag-->

{$x->source()}";

		mkpath(dirname($post_file), 0777);
		file_put_contents($post_file, $content);
		touch($post_file, $x->create_time());

		$cat_file = $this->htmly()->content_dir().'/data/category/'.$x->category().'.md';

		$title = trim($x->blog_title());
		if(!$title)
			$title = 'ZeroBlog-'.substr($x->category(), 1, 4);

		$cat = "<!--t {$title} t-->
<!--d DESC d-->

{$x->blog_description()}

- ZeroBlog: <http://127.0.0.1:43110/{$x->zero_blog_id()}/>
- ZeroBlog via proxy: <https://www.zerogate.tk/{$x->zero_blog_id()}/>
";

		file_put_contents($cat_file, $cat);
	}
}
