$(document).ready(function(){
    $("#title .upload").click(function (){
        $("#title input[type=file]") .click();
    });

    $("#title input[type=file]").on("change", function(e){
        $("#title img").attr("src", URL.createObjectURL(e.target.files[0]));
    });

    $("#title .edit").click(function(){
        $("#title input[type=text]").val($("#title .title").text().trim());
        $("#title .title").hide();
        $("#title input[type=text]").show();
        $(this).hide();
    });

    $("#title input[type=text]").keyup(function(e){
        if (e.keyCode == 13) {
            $("#title .title").text($(this).val().trim());
            $("#title .title").show();
            $(this).hide();
            $("#title .edit").show();
        }
    });

    $("#description .edit").click(function(){
        $("#description textarea").val($("#description p").text().trim());
        $("#description p").hide();
        $("#description textarea").show();
        $(this).hide();
    });

    $("#description textarea").keyup(function(e){
        if (e.keyCode == 13 && e.ctrlKey) {
            $("#description p").text($(this).val().trim());
            $("#description p").show();
            $(this).hide();
            $("#description .edit").show();
        }
    });

    $("#age .edit").click(function(){
        $("#age input").val($("#age .age").text().trim());
        $("#age .age").hide();
        $("#age input").show();
        $(this).hide();
    });

    $("#age input").keyup(function(e){
        if (e.keyCode == 13) {
            $("#age .age").text($(this).val().trim());
            $("#age .age").show();
            $("#age .edit").show();
            $(this).hide();
        }
    });

    $("#tags .edit").click(function(){
        tagString = "";
        $("#tags .tag").each(function(index){
            tagString += ', ' + $(this).text();
        });
        $("#tags input").val(tagString.substr(2));
        $("#tags .tag").hide();
        $("#tags input").show();
        $(this).hide();
    });

    $("#tags input").keyup(function(e){
        if (e.keyCode == 13) {
            tagString = $(this).val().split(',').map(function (val) { return val.trim(); }).filter(function (val, index, self) { return val && self.indexOf(val) == index; });
            $("#tags a").remove();

            tagString.forEach(function (tag) {
                $("#tags .taglist").append(
                    $("<a/>", { "href": "#", "text": " " }).append(
                        $("<span/>", { "class": "tag badge badge-secondary", "text": tag })
                    )
                );
            });

            $("#tags .tag").show();
            $(this).hide();
            $("#tags .edit").show();
        }
    });
});
