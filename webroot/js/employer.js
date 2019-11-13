$(document).ready(function(){
    $("#dropdownMenuLink").click(function(){
        $.ajax({
            method: 'GET',
            url: $('#employerMetaLink').attr('href'),
            context: document.body
        }).done(function(data) {
            if (data.responseCount > 0) {
                $("#responseCount").text(data.responseCount);
            } else {
                $("#responseCount").hide();
            }

        }).fail(function() {
            console.log("fail");
        });
    });
});
