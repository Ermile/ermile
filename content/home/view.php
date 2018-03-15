<?php
namespace content\home;

class view extends \mvc\view
{
	function config()
	{
		$this->data->bodyclass = 'unselectable vflex';
		// $this->include->js     = false;

		$this->data->page['title']   = $this->data->site['title'] . ' | '. $this->data->site['slogan'];
		$this->data->page['special'] = true;
	}


	/**
	 * [pushState description]
	 * @return [type] [description]
	 */
	function pushState()
	{
		// if(\lib\url::module() !== null)
		// {
		// 	$this->data->display['mvc']     = "content/home/layout-xhr.html";
		// }
	}
}
?>