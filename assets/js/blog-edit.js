function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

$(document).ready(function() {
    $(".update-title-form").submit(function() {
        event.preventDefault();
        bootbox.confirm("Are you sure you want to update your blog's title?", function (result) {
            if (result) {
                new_title = $("#edited_blogname").val();
                $.ajax({
                    url: "changeTitle.php",
                    type: "POST",
                    data: {new_blog_title: new_title}
                }).done(function (data){
                    response = JSON.parse(data);
                    if (response.result) {
                        setTimeout(function() {
                            bootbox.alert(response.message);
                            $(".brand").html(new_title);
                        }, 500);
                    } else {
                        bootbox.alert(response.message);
                    }
                })
            }
        });
    });
    
    //click edit-comments
    $(".edit-comments").click(function (event) {
        event.preventDefault();
        post_id = $(this).find("span").attr("post_id");
        var params = new Array();
        params['post_id'] = post_id;
        post_to_url("comment-edit.php", params, "post");
    });
});

$(document).ready(function() {
    $(".delete-post").click(function(event) {
        event.preventDefault();
        post_id = $(this).attr("post_id");
        $(this).parent().parent().attr("id", "to-be-deleted");
        bootbox.confirm("Are you sure you want to delete this entry? This can't be undone.", function(result) {
            if (result) {
                $.ajax({
                    url:"deletePost.php",
                    type: "POST",
                    data: {post_id: post_id}
                }).done(function (data) {
                    response = JSON.parse(data);
                    if (response.result) {
                        $("#to-be-deleted").slideUp(0, function () {
                            setTimeout(function () {
                                bootbox.alert(response.message);
                            }, 500);
                        }); 
                    } else {
                        bootbox.alert(response.message);
                    }
                });    
            } else {
                $(this).parent().attr("id", "");
            }
        });
    });
    
    $(".edit-post").click(function(event) {
        event.preventDefault();
        post_id = $(this).parent().parent().attr("post_id");
        post_to_url("post-edit.php", {post_id: post_id}, "post");
    });
});