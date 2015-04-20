<?php
namespace database\ermile;
class posts 
{
	public $id               = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'bigint@20',                                        );
	public $post_language    = array('null' =>'YES', 'show' =>'YES', 'label'=>'language',      'type' => 'char@2',                                           );
	public $post_cat         = array('null' =>'YES', 'show' =>'YES', 'label'=>'cat',           'type' => 'varchar@50',                                       );
	public $post_title       = array('null' =>'NO',  'show' =>'YES', 'label'=>'title',         'type' => 'varchar@100',                                      );
	public $post_slug        = array('null' =>'NO',  'show' =>'YES', 'label'=>'slug',          'type' => 'varchar@100',                                      );
	public $post_content     = array('null' =>'YES', 'show' =>'YES', 'label'=>'content',       'type' => 'text@',                                            );
	public $post_type        = array('null' =>'NO',  'show' =>'YES', 'label'=>'type',          'type' => 'varchar@50!post',                                  );
	public $post_url         = array('null' =>'YES', 'show' =>'YES', 'label'=>'url',           'type' => 'text@',                                            );
	public $post_comment     = array('null' =>'YES', 'show' =>'YES', 'label'=>'comment',       'type' => 'enum@open,closed',                                 );
	public $post_count       = array('null' =>'YES', 'show' =>'YES', 'label'=>'count',         'type' => 'smallint@5',                                       );
	public $post_status      = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@publish,draft,schedule,deleted,expire!draft', );
	public $post_parent      = array('null' =>'YES', 'show' =>'YES', 'label'=>'parent',        'type' => 'smallint@5',                                       );
	public $user_id          = array('null' =>'NO',  'show' =>'NO',  'label'=>'user',          'type' => 'int@10',                                           'foreign'=>'users@id!user_nickname');
	public $post_publishdate = array('null' =>'YES', 'show' =>'YES', 'label'=>'publishdate',   'type' => 'datetime@',                                        );
	public $date_modified    = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                       );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}
	public function post_language() 
	{
		$this->form("text")->name("language")->maxlength(2)->type('text');
	}
	public function post_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}

	//------------------------------------------------------------------ slug
	public function post_slug() 
	{
		$this->form("#slug")->maxlength(100)->required()->type('text');
	}
	public function post_content() 
	{
		$this->form("text")->name("content");
	}

	//------------------------------------------------------------------ select button
	public function post_type() 
	{
		$this->form("select")->name("type")->type("select")->maxlength(50)->required()->validate();
		$this->setChild();
	}
	public function post_url() 
	{
		$this->form("text")->name("url");
	}
	public function post_comment() 
	{
		$this->form("text")->name("comment")->type('radio');
	}
	public function post_count() 
	{
		$this->form("text")->name("count")->min(0)->max(99999)->type('number');
	}

	//------------------------------------------------------------------ select button
	public function post_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function post_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(99999)->type('number');
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}
	public function post_publishdate() 
	{
		$this->form("text")->name("publishdate");
	}
	public function date_modified() {}
}
?>