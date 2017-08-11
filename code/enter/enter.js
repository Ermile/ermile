// on start
route('*', function ()
{
	// on successfull load check mobile
	// run for each input
	$('input').on('input', function()
	{
		runDataRequire();
	});
	allowTogglePass();
	runTimer();



}).once(function()
{
	// add check handler to all data-require elements
	runDataRequire(true);
	setLanguageURL();

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


		// console.log(checkResult);
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
https://tejarak.dev/enter/

/**
 * set link of language on each page
 */
function setLanguageURL()
{
  var urlPath     = window.location.pathname;
  var urlHash     = window.location.hash;
  var indexOfLang = urlPath.indexOf('/' + $('html').attr('lang') + '/');
  var urlBase     = $('base').attr('href');
  urlBase         = urlBase.substr(0, urlBase.indexOf('/', 9));
  console.log(urlPath);
  console.log(indexOfLang);
  console.log(urlBase);

  if(indexOfLang === 0)
  {
    urlPath = urlPath.substr(4);
  }
  else
  {
    urlPath = urlPath.substr(1);
  }
  console.log(urlPath);

  $('.langlist a').each(function(key, index)
  {
    var lang = $(index).attr('hreflang');
    // if we are in this language
    if(lang == $('html').attr('lang'))
    {
      $(index).attr('class', 'isActive');
    }
    if(lang == 'en')
    {
      lang = '';
    }
    else if(lang == $('html').attr('lang'))
    {
      // lang = '/' + lang;
    }
    var myUrl = urlPath;
    if(lang)
    {
      myUrl = lang + '/' + myUrl;
    }
    // add hash if exist
    if(urlHash)
    {
      myUrl += urlHash;
    }
    myUrl = urlBase + '/' + myUrl;
    $(index).attr('href', myUrl.trim('/'));
  })
}


function allowTogglePass()
{
	$('#eramzNew label, #eramz label').on('click', function()
	{
		var inputEl = $(this).parent().find('input');
		var oldVal  = inputEl.attr('type');

		if(oldVal === 'password')
		{
			inputEl.attr('type', 'text');
		}
		else
		{
			inputEl.attr('type', 'password');
		}
	});
}


function runTimer()
{
	$('[data-timer]').each(function(_index, _el)
	{
		startTimer($(_el).attr('data-timer'), $(_el));
	});
}


function startTimer(duration, display)
{
	var timer      = duration, minutes, seconds;
	var myInterval = setInterval(function ()
	{
		minutes = parseInt(timer / 60, 10)
		seconds = parseInt(timer % 60, 10);

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.text(minutes + ":" + seconds);


		if (--timer <= 0)
		{
			if(display.attr('data-href'))
			{
				display.attr('href', display.attr('data-href'));
			}

			if(display.attr('data-text'))
			{
				display.fadeOut(function()
				{
					$(this).text(display.attr('data-text'));
				}).fadeIn();
			}

			console.log('finish');
			clearInterval(myInterval);
			// timer = duration;
		}
	}, 1000);
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

