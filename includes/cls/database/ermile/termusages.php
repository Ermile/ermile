<?php
namespace database\ermile;
class termusages 
{
	public $term_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'term'            ,'type'=>'int@10'                          ,'foreign'=>'terms@id!term_title'];
	public $object_id       = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'object'          ,'type'=>'bigint@20'                       ,'foreign'=>'objects@id!object_title'];
	public $termusage_type  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@posts,products,attachments,comments'];
	public $termusage_order = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'order'           ,'type'=>'smallint@5'];

	//--------------------------------------------------------------------------------foreign
	public function term_id()
	{
		$this->form()->type('select')->name('term_')->required();
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function object_id()
	{
		$this->form()->type('select')->name('object_')->required();
		$this->setChild();
	}

	public function termusage_type()
	{
		$this->form()->type('radio')->name('type');
		$this->setChild();
	}

	public function termusage_order()
	{
		$this->form()->type('number')->name('order')->min()->max('99999');
	}
}
?>