<?php
namespace content\main;
use \lib\debug;

class model extends \mvc\model
{
	public function get_posts($object)
	{
		$_url       = $this->module('array');
		$tmp_result =  $this->sql()->tablePosts()
								->wherePost_slug($_url[count($_url)-1])->andPost_status('publish')->select();

		if($tmp_result->num()==1)
			return $tmp_result->assoc();
		
		return null;
	}

	public function get_terms($object)
	{
		$_url       = $this->module('array');
		$tmp_result =  $this->sql()->tableTerms()
								->whereTerm_slug($_url[count($_url)-1])->andTerm_status('enable')->select();

		if($tmp_result->num()==1)
			return $tmp_result->assoc();
		
		return null;
	}

	function url_checker($_url = null)
	{
		if(!$_url)
			$_url = $this->module('array');

		if(count($_url)>3)
			return 'invalid';


		// Tags
		if($_url[0]=='tag')
		{
			if(count($_url) == 2)
			{
				$tmp_result =  $this->sql()->tableTerms()->whereTerm_slug($_url[1])
								->andTerm_type('tag')->andTerm_status('enable')->select();
				if($tmp_result->num()==1)
					return 'tag';
			}
			return 'invalid';
		}


		// Pages
		$tmp_result =  $this->sql()->tablePosts()->wherePost_slug($_url[0])
							->andPost_type('page')->andPost_status('publish')->select();
		if($tmp_result->num() == 1)
		{
			if(count($_url) == 1)
				return 'page';
			elseif(count($_url) == 2)
			{
				return 'nested page';
				// fix for nested page
			}
		}


		// Posts and Categories
		$tmp_cat =  $this->sql()->tableTerms()->whereTerm_slug($_url[0])
							->andTerm_type('cat')->andTerm_status('enable')->select();
		if($tmp_cat->num() == 1)
		{
			// check for cat in first slash
			if(count($_url) == 1)
			{
				return 'cat';
			}

			// check for post or cat in second slash
			if(count($_url) == 2)
			{
				$tmp_result =  $this->sql()->tablePosts()->wherePost_slug($_url[1])
									->andPost_type('post')->andPost_status('publish')->select();
				// Cat/Post
				if($tmp_result->num() == 1)
				{
					if($_url[0] == $tmp_result->assoc('post_cat'))
						return 'post';
					else
						return 'invalid';
				}
				// Cat/Cat
				else
				{
					$tmp_result =  $this->sql()->tableTerms()->whereTerm_slug($_url[1])
										->andTerm_type('cat')->andTerm_status('enable')->select();
					if($tmp_result->num() == 1 && $tmp_result->assoc('term_father') == $tmp_cat->assoc('id'))
						return 'cat';
					else
						return 'invalid';
				}
			}

			// check for post in third slash
			if(count($_url) == 3)
			{
				// complete soon ..........


				// $tmp_result =  $this->sql()->tablePosts()->wherePost_slug($_url[2])
				// 					->andPost_type('post')->andPost_status('publish')->select();
				// if($tmp_result->num() == 1)
				// {
				// 	// check for correct cat

				// 	return 'post';
				// }
			}
		}

		return 'invalid';
	}
}
?>