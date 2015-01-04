<?php
namespace cls\form;
class symbol extends \lib\form{
	function __construct(){
		// $this->hidden = $this->make("hidden")->name("_post");
		// $this->slug = $this->make("text")->name("slug");

		// $this->slug->validate()->slug()->formSlug("slug incorrect");
		// $this->desc = $this->make("textarea")->name("desc");
		// $this->desc->validate()->desc()->formDesc("desc incorrect");

		// $this->username = $this->make("text")->name("username")->label("username");
		// $this->username->validate()->username()->formUsername("username incorrect");

		// $this->password = $this->make("password")->name("password")->label("password");
		// $this->password->validate()->password()->formPassword("password incorrect");

		// $this->number = $this->make("text")->name("number")->label("number");
		// $this->number->validate()->number()->formNumber("number incorrect");

		// $this->price = $this->make("text")->name("price")->label("price");
		// $this->price->validate()->price()->formPrice("price incorrect");

		// $this->nationalcode = $this->make("text")->name("nationalcode")->label("nationalcode");
		// $this->nationalcode->validate()->nationalcode()->formNationalcode("nationalcode incorrect");

		// $this->unicodetext = $this->make("text")->name("text")->label("Text");
		// $this->unicodetext->validate();

		// $this->text_title = $this->make("text")->name("title")->label("Title");
		// $this->text_title->validate();

		// $this->text_website = $this->make("text")->name("website")->label("Website");
		// $this->text_website->validate()->website();

		// $this->text_desc = $this->make("textarea")->name("desc")->label("description");
		// $this->text_desc->validate()->description()->formDescription("description overflow");

		// $this->entext = $this->make("text")->name("entext")->label("English Text");
		// $this->entext->validate()->reg("/^([a-z]{2,}\s?)+[a-z]$/Ui")->forMreg("text must be english");

		// $this->fatext = $this->make("text")->name("fatext")->label("fatext");
		// $this->fatext->validate()->farsi()->formfarsi("text must be persian");

		// $this->date = $this->make("text")->name("date")->label("date")->date("date");
		// $this->date->validate()->date()->formdate("date incorrect");

		// $this->time = $this->make("time")->name("time")->label("time");

		// $this->email = $this->make("email")->name("email")->label("email");
		// $this->email->validate()->email()->formemail("email incorrect");

		// $this->submitadd = $this->make("submit")->value(_("Submit"));
		// $this->submitedit = $this->make("submit")->value(_("Save"));
		// $this->submitlogin = $this->make("submit")->value(_("Sign in"));
		// $this->submitregister = $this->make("submit")->value(_("Create Account"));

		// $this->robot = $this->make("robot")->name("name")->label("User Name")->pl("Please Enter Your Name!");
		// $this->check = $this->make("checkbox");


		// $this->website = $this->make("text")->name("website")->label("website");
		// $this->website->validate()->website()->formWebsite("website incorrect");

		// $this->foreignkey = $this->make("text")->name("foreignkey")->label("foreignkey");
		// $this->foreignkey->validate()->foreignkey()->formForeignkey("foreignkey incorrect");


/**
 * if parameter for second col is not set, copy from first variable to second
 * name 	-> id
 * label 	-> placeholder
 */

		$this->website = $this->make("text")->name("website")->label("website");

		$this->mobile 	= $this->make("mobile")->type("tel")->label(T_("Mobile"))->pl(T_("Mobile"))
							->required()->maxlength(17)->pattern(".{10,}")
							->pos('hint--rounded hint--top')->desc(T_("we send a verification code to this number"));
		// $this->form()->type("tel")->name("mobile")->pl("Mobile")->pattern(".{10,}")->maxlength(17)->required();

		$this->password = $this->make("password")->type("password")->label(T_("Password"))->pl(T_("Password"))->autocomplete('off')
							->required()->maxlength(20)->pattern("^.{5,20}$")->title("between 5-20 character")
							->pos('hint--rounded hint--bottom')->desc(T_("between 5-20 character. be tricky!"));
							// ->validate()->password();
		// $this->password->validate()->password(); //->formPassword("password incorrect");

		// $this->form()->name("pass")->pl("Password")->type("password")->required()->maxlength(20)
		// 	->pattern("^.{5,20}$")->title("between 5-20 character")->validate()->password();

			
		// $this->password = $this->make("password")->name("password")->label("password");
		// $this->password->validate()->password()->formPassword("password incorrect");
	}
}
?>