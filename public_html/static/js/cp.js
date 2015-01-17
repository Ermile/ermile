route('*', 'cp.js', function() {
    hideFields();

    $(".fields-toggle", this).change(function () {
    var box = $("."+this.value);
        box.toggleClass('disappear');
    });
    $("#options-link", this).click(function () {
        console.log('clicked');
        $("#options-meta").toggleClass('disappear');
    });
});

function hideFields()
{
    $("input:checkbox", this).each(function()
    {
        if( !$(this).is(":checked") )
        {
            $("."+$(this).val()).addClass('disappear');
        }
    }
);}
