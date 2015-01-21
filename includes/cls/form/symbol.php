<?php
namespace cls\form;
class symbol extends \lib\form
{
	function __construct()
	{
		// $this->username       = $this->make("text")->name("username")->label("username");
		// $this->username->validate()->username()->formUsername("username incorrect");
		// $this->number         = $this->make("text")->name("number")->label("number");
		// $this->number->validate()->number()->formNumber("number incorrect");
		// $this->price          = $this->make("text")->name("price")->label("price");
		// $this->price->validate()->price()->formPrice("price incorrect");
		// $this->nationalcode   = $this->make("text")->name("nationalcode")->label("nationalcode");
		// $this->nationalcode->validate()->nationalcode()->formNationalcode("nationalcode incorrect");
		// $this->unicodetext    = $this->make("text")->name("text")->label("Text");
		// $this->unicodetext->validate();
		// $this->entext         = $this->make("text")->name("entext")->label("English Text");
		// $this->entext->validate()->reg("/^([a-z]{2,}\s?)+[a-z]$/Ui")->forMreg("text must be english");
		// $this->fatext         = $this->make("text")->name("fatext")->label("fatext");
		// $this->fatext->validate()->farsi()->formfarsi("text must be persian");
		// $this->date           = $this->make("text")->name("date")->label("date")->date("date");
		// $this->date->validate()->date()->formdate("date incorrect");
		// $this->time           = $this->make("time")->name("time")->label("time");
		// $this->submitadd      = $this->make("submit")->value(_("Submit"));
		// $this->submitedit     = $this->make("submit")->value(_("Save"));
		// $this->submitlogin    = $this->make("submit")->value(_("Sign in"));
		// $this->submitregister = $this->make("submit")->value(_("Create Account"));
		// $this->robot          = $this->make("robot")->name("name")->label("User Name")->pl("Please Enter Your Name!");
		// $this->check          = $this->make("checkbox");
		// $this->foreignkey     = $this->make("text")->name("foreignkey")->label("foreignkey");
		// $this->foreignkey->validate()->foreignkey()->formForeignkey("foreignkey incorrect");
/**
 * if parameter for second col is not set, copy from first variable to second
 * name 	-> id
 * label 	-> placeholder
 **/
		// New -----------------------------------------------------------------------------------------
		// Above lines must be delete after complete below lines!
		// 
		// if user don't set name 	of element give it from *->make('name')* 		and set it as name
		// if user don't set id 	of element give it from *->name('username')* and set it as id
		// if user don't set pl 	of element give it from *->label('Hi')* 		and set it as placeholder
		//  Make -> Name -> ID     | label -> pl

		$this->title   = $this->make("text")->name('title');
		$this->slug		= $this->make("text")->name('slug')->maxlength(40);
								 // ->validate()->slugify("'.$prefix.'_title")
		$this->desc 	= $this->make("textarea")->name("desc");
		$this->email 	= $this->make("email")->name("email");
		$this->website = $this->make("text")->name("website");
		$this->type 	= $this->make("text")->name("type");

		$this->tel 	   = $this->make("tel")->name('tel')->type("tel")->label(T_("Tel"))
							->required()->maxlength(17)->pattern(".{9,}");

		$this->mobile 	= $this->make("mobile")->name('mobile')->type("tel")->label(T_("Mobile"))->pl(T_("Mobile"))
							->required()->maxlength(17)->pattern(".{10,}")->autocomplete('off')
							->pos('hint--rounded hint--top')->desc(T_("we send a verification code to this number"));

		$this->pass =
		$this->password = $this->make("password")->type("password")->label(T_("Password"))->autocomplete('off')
							->required()->maxlength(20)->pattern("^.{5,20}$")->title(T_("between 5-20 character"))
							->pos('hint--rounded hint--bottom')->desc(T_("between 5-20 character. be tricky!"));
							// ->validate()->password();


	}
}
?>