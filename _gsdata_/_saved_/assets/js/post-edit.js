$(document).ready(function () {
    $("#edit-post-submit").click(function (event) {
        event.preventDefault();
        
        //send the items of the form to the server for insertion
        post_id = $(this).parent().attr("post_id");
        title = $("[name='title']").val();
        subtitle = $("[name='subtitle']").val();
        body = $("[name='body']").val();
        if (!title || !body) {
            bootbox.alert("The Title or Body of your post are empty. Please fill in at least these two fields to add the entry.");
            return;
        }
        $.ajax({
            url:'addPostToDB.php',
            type: "POST",
            data: {'title': title, 'subtitle':subtitle, 'body':body, 'post_id': post_id}
        }).done(function (data){
            response = JSON.parse(data);
            if (response.result) {
                bootbox.alert(response.message, function () {
                    window.location = "blog-edit.php";
                });
            } else {
                bootbox.alert(response.message);
            }
        });
    });
});

$(document).ready(function () {
    $("#cancel-button").click(function (event) {
        event.preventDefault();
        bootbox.confirm("Are you sure you want to cancel?", function (result) {
            if (result) {
                $.cookie("post_id", null);
                post_to_url("blog-edit.php");
            }
        })
    });
});