<?php
namespace database\ermile;
class posts 
{
	public $id               = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                                       );
	public $post_language    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Language',      'type' => 'char@2',                                           );
	public $post_title       = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@100',                                      );
	public $post_cat         = array('null' =>'YES', 'show' =>'YES', 'label'=>'Cat',           'type' => 'varchar@50',                                       );
	public $post_slug        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Slug',          'type' => 'varchar@100',                                      );
	public $post_content     = array('null' =>'YES', 'show' =>'YES', 'label'=>'Content',       'type' => 'text@',                                            );
	public $post_type        = array('null' =>'NO',  'show' =>'YES', 'label'=>'Type',          'type' => 'enum@post,page!post',                              );
	public $post_status      = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@publish,draft,schedule,deleted,expire!draft', );
	public $post_father      = array('null' =>'YES', 'show' =>'YES', 'label'=>'Father',        'type' => 'smallint@5',                                       );
	public $user_id          = array('null' =>'NO',  'show' =>'NO',  'label'=>'User',          'type' => 'smallint@5',                                       'foreign'=>'users@id!user_nickname');
	public $attachment_id    = array('null' =>'YES', 'show' =>'YES', 'label'=>'Attachment',    'type' => 'int@10',                                           'foreign'=>'attachments@id!attachment_title');
	public $post_publishdate = array('null' =>'YES', 'show' =>'YES', 'label'=>'Publishdate',   'type' => 'datetime@',                                        );
	public $date_modified    = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                                       );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}
	public function post_language() 
	{
		$this->form("text")->name("language")->maxlength(2)->type('text');
	}

	//------------------------------------------------------------------ title
	public function post_title() 
	{
		$this->form("#title")->maxlength(100)->required()->type('text');
	}
	public function post_cat() 
	{
		$this->form("text")->name("cat")->maxlength(50)->type('text');
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
		$this->form("select")->name("type")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ select button
	public function post_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function post_father() 
	{
		$this->form("text")->name("father")->min(0)->max(9999)->type('number');
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function attachment_id() 
	{
		$this->form("select")->name("attachment_")->min(0)->max(999999999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function post_publishdate() 
	{
		$this->form("text")->name("publishdate");
	}
	public function date_modified() {}
}
?>