class window.saloos.getParent
	constructor : (el)->
		name = $(el).attr('name')
		$(el).removeAttr('name')
		$("<input type=\"hidden\" name=\"#{name}\" value=\"#{$(el).val()}\">").insertAfter($(el))
		$(el).change ()->
			$(@).attr('disabled', '')
			val = $(@).val()
			addr = location.pathname.replace(/\/[^\/]*$/, '') + "/get-list"
			$.ajax({
				url : addr
				data : {parent:val}
				success : (data) ->
					console.log(data)
				})

route('*', ()->
	$("#sp-parent", this).each(()->
		new saloos.getParent(@)
		)
	)