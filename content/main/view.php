<?php
namespace content\main;

class view extends \mvc\view
{
	function view_posts($obj)
	{
		$this->data->post = array();
		$tmp_result        = $obj->api_callback;
		if($tmp_result)
		{
			$tmp_fields			 = array('id'               =>'id',
												'post_language'    =>'language',
												'post_title'       =>'title',
												'post_cat'         =>'cat',
												'post_slug'        =>'slug',
												'post_content'     =>'content',
												'post_type'        =>'type',
												'post_status'      =>'status',
												'post_father'      =>'father',
												'user_id'          =>'user',
												'attachment_id'    =>'attachment',
												'post_publishdate' =>'publishdate',
												'date_modified'    =>'modified'
										);
			foreach ($tmp_fields as $key => $value)
			{
				$this->data->post[$value] = $tmp_result[$key];
			}
			// var_dump($this->data->post);
		}
		else
		{
			\lib\error::error(T_("Error!"));
		}
	}

	function view_terms($obj)
	{
		$this->data->post = array();
		$tmp_result        = $obj->api_callback;
		if($tmp_result)
		{
			$tmp_fields			 = array('id'               =>'id',
												'term_language'    =>'language',
												'term_title'       =>'title',
												'term_slug'        =>'slug',
												'term_desc'        =>'desc',
												'term_father'      =>'father',
												'term_type'        =>'type',
												'term_status'      =>'status',
												'date_modified'    =>'modified'
										);
			foreach ($tmp_fields as $key => $value)
			{
				$this->data->post[$value] = $tmp_result[$key];
			}
			// var_dump($this->data->post);
		}
		else
		{
			\lib\error::error(T_("Error!"));
		}
	}

}
?>