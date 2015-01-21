<?php
function transtext()
{
	// add static text for detect poedit translate
	// Saloos Default data
	echo T_('Saloos');
	echo T_('Another Project with Saloos');
	echo T_('Saloos is an artichokes for PHP programming!!');
	echo T_('Saloos is powerfull.');
	
	// Your new static text that does not exist on this project! Add them manually
	echo T_('home');
	echo T_('Homepage');
	echo T_('Signup');
	echo T_('Add new');
	echo T_('Add New');
}
?>
