<?php
namespace content\main;
use \lib\debug;

class model extends \mvc\model
{
	/**
	 * this fuction check the url entered from user in database
	 * first search in posts and if not exist search in terms table
	 * @return [array] datarow of result if exist else return false
	 */
	function url_checker()
	{
		$url = $this->url('path');
		// first of all search in url field if exist return row data
		$qry = $this->sql()->tablePosts()->wherePost_url($url)->andPost_status('publish')->select();
		if($qry->num() === 1)
		{
			$datarow = $qry->assoc();
			return array('type' => $datarow['post_type'], 'slug' => $datarow['post_slug'] );
		}

		// if url not exist in posts then search in terms table and if exist return row data
		elseif($qry->num() === 0)
		{
			$qry =  $this->sql()->tableTerms()->whereTerm_url($url)->andTerm_status('enable')->select();
			if($qry->num() === 1)
			{
				$datarow = $qry->assoc();
				return array('type' => $datarow['term_type'], 'slug' => $datarow['term_slug'] );
			}
		}

		// else retun false
		return false;
	}



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

	function url_checker_old($_url = null)
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