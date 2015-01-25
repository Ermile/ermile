<?php
namespace cls\validate;

return function()
{
	// $this->value = utility::hasher($this->value)
	var_dump("password validate");
	exit();
	if(!preg_match("/^\d+$/", $this->value))
	{
		return false;
	}
	else
	{
		return true;
	}
}
?>