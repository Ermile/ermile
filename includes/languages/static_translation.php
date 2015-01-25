<?php
function transtext()
{
	// add static text for detect poedit translate
	// Saloos Default data
	echo T_('Saloos');
	echo T_('Another Project with Saloos');
	echo T_('Saloos is an artichokes for PHP programming!!');
	echo T_('Saloos is powerfull.');
	echo T_('insert successfully');
	echo T_('insert failed!');
	echo T_('update successfully');
	echo T_('update failed!');
	echo T_('delete successfully');
	echo T_('delete failed!');
	echo T_('id does not exist!');
	echo T_('all require fields must fill');
	echo T_('some fields must be change for update!');
	echo T_('Ermile');
	echo T_('ermile');
	echo T_('now we only support Iran!');
	echo T_('your verification code is');
	echo T_('your recovery code is');
	echo T_('you account is verified successfully');
	echo T_('thanks for using our service');
	echo T_('made in iran');
	
	

	
	
	//----------------------------------------------------content_cp/home/display.html
	echo T_("Logout");                                                                // Line 43
	echo T_("Home");                                                                  // Line 40

	//-----------------------------------------------------content_cp/main/layout.html
	echo T_("Options");                                                               // Line 24 Seperate
	echo T_("Go to");                                                                 // Line 68
	echo T_("Does not exist");                                                        // Line 32 Seperate
	echo T_("Add New Record");                                                        // Line 39 Seperate
	echo T_("Actions");                                                               // Line 52
	echo T_("Edit");                                                                  // Line 71
	echo T_("Delete");                                                                // Line 74
	


	// For Datatable	
	echo T_('Next page');

	// Your new static text that does not exist on this project! Add them manually
	echo T_('home');
	echo T_('Homepage');
	echo T_('Signup');
	echo T_('Add new');
	echo T_('Add New');
	
}
?>
