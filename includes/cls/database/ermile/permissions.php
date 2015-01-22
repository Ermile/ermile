<?php
namespace database\ermile;
class permissions 
{
	public $id                = array('null' =>'NO',  'show' =>'NO',  'label'=>'Id',            'type' => 'smallint@5',                        );
	public $permission_title  = array('null' =>'NO',  'show' =>'YES', 'label'=>'Title',         'type' => 'varchar@50',                        );
	public $Permission_module = array('null' =>'NO',  'show' =>'YES', 'label'=>'Module',        'type' => 'varchar@50',                        );
	public $permission_view   = array('null' =>'NO',  'show' =>'YES', 'label'=>'View',          'type' => 'enum@yes,no!yes',                   );
	public $permission_add    = array('null' =>'NO',  'show' =>'YES', 'label'=>'Add',           'type' => 'enum@yes,no!no',                    );
	public $permission_edit   = array('null' =>'NO',  'show' =>'YES', 'label'=>'Edit',          'type' => 'enum@yes,no!no',                    );
	public $permission_delete = array('null' =>'NO',  'show' =>'YES', 'label'=>'Delete',        'type' => 'enum@yes,no!no',                    );
	public $permission_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'Status',        'type' => 'enum@enable,disable,expire!enable', );
	public $date_modified     = array('null' =>'YES', 'show' =>'NO',  'label'=>'Modified',      'type' => 'timestamp@',                        );


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ title
	public function permission_title() 
	{
		$this->form("#title")->maxlength(50)->required()->type('text');
	}
	public function Permission_module() 
	{
		$this->form("text")->name("module")->maxlength(50)->required()->type('text');
	}

	//------------------------------------------------------------------ radio button
	public function permission_view() 
	{
		$this->form("radio")->name("view")->type("radio")->required();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function permission_add() 
	{
		$this->form("radio")->name("add")->type("radio")->required();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function permission_edit() 
	{
		$this->form("radio")->name("edit")->type("radio")->required();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function permission_delete() 
	{
		$this->form("radio")->name("delete")->type("radio")->required();
		$this->setChild();
	}

	//------------------------------------------------------------------ radio button
	public function permission_status() 
	{
		$this->form("radio")->name("status")->type("radio")->required();
		$this->setChild();
	}
	public function date_modified() {}
}
?>