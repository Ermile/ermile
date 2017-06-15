// on start
route('*', function ()
{
	// on successfull load check mobile
	// run for each input
	$('input').on('input', function()
	{
		runDataRequire();
	});



}).once(function()
{
	// add check handler to all data-require elements
	runDataRequire(true);

});


function runDataRequire(_firstTime)
{
	// check on start
	$("[data-require]").each(function()
	{
		var $this        = $(this);
		var requireEl    = $this.attr('data-require');
		var requireElVal = $('#'+ requireEl).val();
		var checkResult  = null;

		switch(requireEl)
		{
			case 'mobile':
				checkResult = validateMobile(requireElVal);
				break;

			case 'usercode':
				checkResult = validateUsercode(requireElVal);
				break;
		}


		console.log(checkResult);
		// if its true and okay show it
		if(checkResult)
		{
			if(!_firstTime)
			{
				$this.slideDown(300);
			}
			$this.removeClass('hide');
		}
		else
		{
			if(_firstTime)
			{
				$this.addClass('hide');
			}
			else
			{
				$this.slideUp(200, function()
				{
					$this.addClass('hide');
				});
			}
		}
	});
}



/**
 * call function if exist
 * @param  {[type]} _func [description]
 * @return {[type]}       [description]
 */
function callFunction(_func, _arg1, _arg2, _onlyCheckExist)
{
	isExist = false;
	// if wanna to call function and exist, call it
	if(_func && typeof window[_func] === 'function')
	{
		isExist = true;
		if(!_onlyCheckExist)
		{
			window[_func](_arg1, _arg2);
		}
	}
	return isExist;
}



function validateUsercode(_user)
{
	if(!_user)
	{
		return null;
	}
	// convert to string for continue
	_user    = _user.toString();
	// define variables
	var numLen = _user.length;
	var result = null;
	console.log(numLen);
	// if len is true then check another filters
	if(numLen >= 5 && numLen <= 30)
	{
		result = true;
	}
	else
	{
		result = false;
	}
	return result;
}



/**
 * [validateMobile description]
 * @param  {[type]} _number [description]
 * @return {[type]}         [description]
 */
function validateMobile(_number)
{
	if(!_number)
	{
		return null;
	}
	// parse as integer to remove zero from start of number
	// _number = parseInt(_number);
	// convert to string for continue
	_number    = _number.toString();
	// define variables
	var result = true;
	var numLen = _number.length;
	// if len is true then check another filters
	if(numLen >= 7 && numLen <= 15)
	{
		// this is iranian number probably
		if(validateIranMobile(_number, true))
		{
			if($('html').attr('lang') === 'fa')
			{
				result = validateIranMobile(_number);
			}
			else
			{
				// do nothing!
				// if have problem comment below code
				result = validateIranMobile(_number);
			}
		}
	}
	else
	{
		result = false;
	}

	return result;
}


/**
 * [validateIranMobile description]
 * @param  {[type]} _number    [description]
 * @param  {[type]} _onlyCheck [description]
 * @return {[type]}            [description]
 */
function validateIranMobile(_number, _onlyCheck)
{
	var status = null
	if(_onlyCheck === true)
	{
		status = !!_number.match(/^((\+|00)?98|0)?9[0-3](\d{0,15})$/);
	}
	else
	{
		status = !!_number.match(/^((\+|00)?98|0)?9[0-3](\d{8})$/);
	}

	return status;
}

