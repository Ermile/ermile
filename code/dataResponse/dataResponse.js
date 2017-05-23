/**
 * v1.0
 */


/**
 * check input for first time
 * @return {[type]} [description]
 */
function runDataResponse()
{
	// on select and input check inputs
	$(document).on('change', 'input:not([data-response-realtime]), select', function()
	{
		checkInputResponse(this, false);
	});
	// add data-response-realtime to run realtime on input type
	$(document).on('input', 'input[data-response-realtime]', function()
	{
		checkInputResponse(this, false);
	});

	// // run for the first time
	// $('input[type=checkbox]').each(function ()
	// {
	//   checkInputResponse(this, true);
	// });
}


/**
 * [getInputValue description]
 * @param  {[type]} _el   [description]
 * @param  {[type]} _type [description]
 * @return {[type]}       [description]
 */
function getInputValue(_el)
{
	var elValue;
	switch ($(_el).attr('type'))
	{
		case 'checkbox':
			elValue = $(_el).is(":checked");
			break;

		case 'radio':
			elValue = $(_el).val();
			break;

		case 'text':
		default:
			elValue = $(_el).val();
			break;
	}

	return elValue;
}


/**
 * check inputs and change status of them if needed
 * V2.1
 * @param  {[type]} _this      [description]
 * @param  {[type]} _firstTime [description]
 * @return {[type]}            [description]
 */
function checkInputResponse(_this, _firstTime)
{
	// declare variable
	var elResult;
	var elGroup    = false;
	var elID       = $(_this).attr('id');
	var elName     = $(_this).attr('name');
	var elType     = $(_this).attr('type');
	var elGroupEl  = $(_this).parents('[data-respnse-group]');
	var elGet      = $(_this).attr('data-response-get');
	var elValue    = getInputValue($(_this), elType);
	var elSelector = elName;
	// change selector if exist
	if(elGet == 'id')
	{
		elSelector = elID;
	}
	var childrens  = $('[data-response="'+ elSelector +'"]');
	// if this name is not exist use id for selector
	if(childrens.length < 1)
	{
		elSelector = elID;
		childrens  = $('[data-response="'+ elSelector +'"]');
	}
	// if this name is not exist use id for selector
	if(childrens.length < 1)
	{
		elSelector = elID;
		childrens  = $('[data-response*="'+ elSelector +'"]');
	}


	// if one of then parents of this element has data-response-group then check for group
	if(elGroupEl.length)
	{
		elGroupEl.each(function(index, el)
		{
			var myGroup = $(this).attr('data-respnse-group');
			elGroup     = myGroup;
			childrens   = childrens.add('[data-response*="'+ myGroup +'"]');
		});
	}

	childrens.each(function()
	{
		var effect     = $(this).attr('data-response-effect');
		var timing     = $(this).attr('data-response-timing');
		var where      = $(this).attr('data-response-where');
		var whereNot   = $(this).attr('data-response-where-not');
		var toggle     = $(this).attr('data-response-toggle');
		var disable    = $(this).attr('data-response-disable');
		var classTrue  = $(this).attr('data-response-class');
		var classFalse = $(this).attr('data-response-class-false');
		var callFn     = $(this).attr('data-response-call');
		var repeat     = $(this).attr('data-response-repeat');

		if(!disable && $(this).attr('disabled'))
		{
			disable = $(this).attr('disabled');
			$(this).attr('data-response-disable', 'disabled-manual');
		}

		// set effect name and default is fade
		if(effect == 'slide')
		{
			effect = {'name':'slide', 'toggle':'slideToggle', 'open':'slideDown', 'close':'slideUp'}
		}
		else
		{
			effect = {'name':'fade', 'toggle':'fadeToggle', 'open':'fadeIn', 'close':'fadeOut'}
		}
		if(!timing)
		{
			timing = 'fast';
		}

		// if we have group then check for all values
		if(elGroup)
		{
			var groupWhere       = elGroupEl.attr('data-response-where');
			var groupWhereNot    = elGroupEl.attr('data-response-where-not');
			var groupWhereResult = true;
			if(groupWhereNot)
			{
				groupWhereResult = false;
			}
			// check all input in this group
			elGroupEl.find('input').each(function(index, el)
			{
				// if need where not then in normal it's false
				// if one condition is exist then set to true
				if(groupWhereNot)
				{
					if(getInputValue(el).toString() !== groupWhereNot)
					{
						groupWhereResult = true;
					}
				}
				// if condition is normal where on group
				// then chack false status and if exist set as false
				// else in normal condition it's true
				else if(groupWhere)
				{
					if(getInputValue(el).toString() !== groupWhere)
					{
						groupWhereResult = false;
					}
				}
			});
			// save group where as final where
			where = groupWhereResult;
		}
		else
		{
			// check where and if want set true or false for where
			if(where)
			{
				// for each sentence in where seperated by |
				$.each(where.split('|'), function(index, whereValue)
				{
					// if where is okay
					if(whereValue == elValue.toString())
					{
						where = true;
					}
				});
				// if where is not true set it as false
				if(where !== true)
				{
					where = false;
				}
			}
			else
			{
				if(elValue != false)
				{
					where = true;
				}
			}
		}

		// if wanna to toggle element do this
		if(toggle)
		{
			$(this)[effect['effect']](timing);
		}
		else
		{
			// show and hide elements depending on parent change
			if(where)
			{
				if(disable)
				{
					$(this).prop('disabled', false);
				}
				else
				{
					// if have class name toggle class name
					if(classTrue !== undefined)
					{
						$(this).addClass(classTrue);
						$(this).removeClass(classFalse);
					}
					else if(repeat != undefined)
					{

					}
					else
					{
						// if condition is true run effect
						$(this).attr('data-response-hide', null);
						$(this)[effect['open']](timing);
					}
				}
				if($(this).find('[data-response-focus]').length)
				{
					$(this).find('[data-response-focus]').focus();
				}
				else
				{
					$(this).closest('[data-response-focus]').focus();
				}
				elResult = 'open';
			}
			else
			{
				if(disable)
				{
					$(this).prop('disabled', true);
				}
				else
				{
					// if have class name toggle class name
					if(classTrue !== undefined)
					{
						$(this).addClass(classFalse);
						$(this).removeClass(classTrue);
					}
					else if(repeat != undefined)
					{

					}
					else
					{
						// if condition is false run effect
						$(this)[effect['close']](timing, function()
						{
							$(this).attr('data-response-hide', '');
						});
					}
				}
				elResult = 'close';
			}
		}
		// if wanna to repeat something
		if(repeat != undefined)
		{
			var parentValue = '';
			switch(elType)
			{
				case 'checkbox':
					parentValue = $(_this).is(":checked");
					$(this).prop('checked', parentValue);
					break;

				case 'radio':
				case 'text':
				default:
					parentValue = $(_this).val();
					$(this).val(parentValue);
					break;
			}
		}
		// if want to call
		if(callFn)
		{
			// true means open and false means close
			if(elResult == true)
			{
				elResult = true;
			}
			else
			{
				elResult = false;
			}
			// call function with 3 paramenter
			// first is status
			// second is current el
			// third is parent el
			if (typeof window[callFn] === "function")
			{
				window[callFn](elResult, $(this), $(_this));
			}
		}
	});

	$(window).trigger('response:open', [elSelector, elResult]);
}


/**
 * fix problem of jumping on first slide with set height
 * @return {[type]} [description]
 */
function fixSlideJumping()
{
	$('[data-response-hide][data-response-effect="slide"]:not([data-response-notfix])', this).css('height',function(i,h)
	{
		$(this).hide();
		return h;
	});
}