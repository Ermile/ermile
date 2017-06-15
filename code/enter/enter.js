// on start
route('*', function ()
{
	// on successfull load check mobile
	verifyInputMobile(null, true);
	$('#mobile').on('input', function()
	{
		verifyInputMobile();
	});
}).once(function()
{

});



/**
 * [verifyInputMobile description]
 * @param  {[type]} _target [description]
 * @return {[type]}         [description]
 */
function verifyInputMobile(_target, _quick)
{
	if(!_target)
	{
		_target = $('#' + 'ego');
	}
	// validate mobile number with pattern
	if(validateMobile($('#mobile').val()))
	{
		if(!_quick)
		{
			_target.slideDown(300);
		}
		_target.removeClass('hide');
	}
	else
	{
		_target.slideUp(200, function()
		{
			$(this).addClass('hide');
		});
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

