$(document).ready(function () {
    hideFields();

    $(".fields-toggle").change(function () {
    var box = $("."+this.value);
        box.toggleClass('disappear');
    });
    $("#options-link").click(function () {
        $("#options-meta").toggleClass('disappear');
    });
});

function hideFields()
{
    $("input:checkbox").each(function()
    {
        if( !$(this).is(":checked") )
        {
            $("."+$(this).val()).addClass('disappear');
        }
    }
);}
