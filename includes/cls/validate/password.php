<?php
namespace cls\validate;

return function(){
	var_dump("password validate");
	exit();
	if(!preg_match("/^\d+$/", $this->value)){
		return false;
	}else{
		return true;
	}
}
?>