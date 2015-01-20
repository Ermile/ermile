<?php
namespace database\ermile;
class termusages 
{
	public $id            = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5', );
	public $term_id       = array('null' =>'NO',  'show' =>'YES', 'label'=>'Term',          'type' => 'smallint@5', 'foreign'=>'terms@id!term_title');
	public $post_id       = array('null' =>'NO',  'show' =>'YES', 'label'=>'Post',          'type' => 'smallint@5', 'foreign'=>'posts@id!post_title');
	public $date_modified = array('null' =>'YES', 'show' =>'NO',  'label'=>'Date Modified', 'type' => 'timestamp@', );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function term_id() 
	{
		$this->form("select")->name("term_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post_")->min(0)->max(9999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>