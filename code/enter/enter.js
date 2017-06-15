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
		$this = $(this);
		var requireEl = $this.attr('data-require');
		callFunction('verifyInput_'+ requireEl, $this, _firstTime);
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



/**
 * [verifyInputMobile description]
 * @param  {[type]} _target [description]
 * @return {[type]}         [description]
 */
function verifyInput_mobile(_target, _quick)
{
	var mobileVal = $('#mobile').val();
	// validate mobile number with pattern
	if(validateMobile(mobileVal))
	{
		if(!_quick)
		{
			_target.slideDown(300);
		}
		_target.removeClass('hide');
	}
	else
	{
		if(_quick)
		{
			_target.addClass('hide');
		}
		else
		{
			_target.slideUp(200, function()
			{
				$(this).addClass('hide');
			});
		}
	}
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

