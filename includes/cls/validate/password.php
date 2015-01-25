<?php
namespace cls\validate;

return function(){
	// exit();
	if(!preg_match("/^\d+$/", $this->value)){
		return false;
	}else{
		return true;
	}
}
?>