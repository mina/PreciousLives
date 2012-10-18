
$(document).ready(function () {
    
    $("#go-to-blog-edit").click(function () {
        window.location = "blog-edit.php";
    });
    
    //logout link
    $("#logout-link").click(function (event) {
        event.preventDefault();
        $.cookie("blog_id", null);
        $.cookie("post_id", null);
        window.location = "/";
    });
    
    //setup comment expanding buttons
    $(".comment-btn").live("click", function () {
        if ($(this).parent().parent().find(".comment-block").is(":hidden")) {
            $(this).parent().parent().find(".comment-block").slideDown();
        } else {
            $(this).parent().parent().find(".comment-block").slideUp();
        }
    });
    
    //setup expanding comment form
    $(".comment-add").live("focus", function () {
        $(this).parent().siblings(".hidden-field").slideDown(); 
    });
    
    //setup comment submit form
    $(".comment-submit").live("submit", function (event) {
        event.preventDefault();
        blog_id = $(this).attr("blog_id");
        post_id = $(this).attr("post_id");
        comment_name = $(this).parent().find("[name=comment-name]").val();
        comment_email = $(this).parent().find("[name=comment-email]").val();
        comment_body = $(this).find("[name=comment-body]").val();
        $.ajax({
            type: "post",
            url: "../submitComment.php",
            data: { comment_name: comment_name, comment_email: comment_email, comment_body: comment_body, post_id: post_id, blog_id: blog_id}
        }).done(function(data) {
            reply = JSON.parse(data);
            if (!reply.result) {
                bootbox.alert(reply.message);
            } else {
                comments = $(".comment-section[post_id="+post_id+"]").find(".comment-block").find(".comments");
                comments.append("<div class='row-fluid hide'><blockquote class='comment pull-right'><p>"+comment_body+"</p><small>"+comment_name+"</small></blockquote></div>");
                comments.find(".hide").slideDown();
                comments.siblings(".comment-form").children().find(".hidden-field").slideUp();
                $(".comment-add").attr("value", null);
                $(".comment-add").attr("Add another comment..");
            }
        });
    });
    
    //close the comment form
    $("#comment-close").live("click", function(event) {
        event.preventDefault();
        $(this).parent().slideUp();
    });
    
    $("#content").load("/myblog.php");
    
    $(".blog-link").click(function(event) {
        event.preventDefault();
        $(".my-navbar").children(".active").removeClass("active");
        $(".blog-link").parent().addClass("active");
        $(".page-header > h1").html("Blog");
        $(".page-header > h1").append("<small>Precious Lives</small>");
        loadURLtoContent("/myblog.php");
        
    });
    
    $(".projects-link").click(function(event) {
        event.preventDefault();
        $(".page-header > h1").html("Projects");
        loadURLtoContent("/projects.html");
        $(".my-navbar").children(".active").removeClass("active");
        $(".projects-link").parent().addClass("active");
    });
    
    $(".resume-link").click(function(event) {
        event.preventDefault();
        $(".my-navbar").children(".active").removeClass("active");
        $(".resume-link").parent().addClass("active");
        $(".page-header > h1").html("Resume");
        loadURLtoContent("/resume.html");
    });
    
    $(".contact-link").click(function(event) {
        event.preventDefault();
         $(".my-navbar").children(".active").removeClass("active");
        $(".contact-link").parent().addClass("active");
        $(".page-header > h1").html("Contact me!");
        $(".page-header > h1").append("<small>I'm (usually) friendly :)</small>");
        loadURLtoContent("/contact.html");

    });
    
    $(".about-link").click(function(event) {
        event.preventDefault();
        loadURLtoContent("/about.html");
         $(".my-navbar").children(".active").removeClass("active");
        $(".about-link").parent().addClass("active");
        $(".page-header > h1").html("About");
    });
    
    
    //delete comment
    $(".delete-comment").click(function(event) {
        event.preventDefault();
        link = $(this);
        comment_id = $(this).attr("comment_id");
        $.ajax({
            url: "deleteComment.php",
            type: "POST",
            data: {comment_id: comment_id}
        }).done(function (data) {
            response = JSON.parse(data);
            if (!response.result) {
                bootbox.alert(response.message);
            } else {
                bootbox.confirm("Are you sure you want to delete this comment?", function (result) {
                    if (result) {
                        link.parent().parent().hide();
                    }
                });
            }
        });
    });
    
});

function loadURLtoContent($url) {
    $(".welcome-message").fadeOut();
    $("#content").fadeOut(400, function () {
        $("#content").load($url);
        $("#content").fadeIn();
    }); 
}

$(document).ready(function() {
    
    $(".signup-form").submit(function (event) {
        event.preventDefault();    
        var personname = $("#signup_name").val();
        var password_one = document.getElementById('password_one').value;
        var password_two = document.getElementById('password_two').value;
        var blogname = document.getElementById('signup_blogname').value;
        var username = document.getElementById('signup_username').value;
        var blogurl = $("#blog_url").val();
        
        if (!checkSignupForm(blogname, username, password_one, password_two, blogurl)) {
            return;
        }
        
        response = JSON.parse(ajaxAddRecordToDB(username, password_one, blogname, blogurl, personname));
        
        if (!response.result) {
            bootbox.alert(response.message);
            return;
        }
        
        bootbox.alert("You have successfully signed up!", function () {
            $.cookie("blog_id", response.blog_id, { expires : 7});
            window.location = "blog-edit.php";
        });
        
    });
});
    
    

function checkSignupForm(blogname, username, password_one, password_two, blogurl) {
    var err = "";
    
    if (!password_one || !password_two || !username || !blogname || !blogurl) {
        err += "<p>One of the fields is missing. We need all the fields to set up your blog.<br>";
    }
    if (password_one != password_two) {
        err += "<p>The two passwords you have entered are not the same. Please reenter the passwords.</p><br>";
    }
    if (blogname.length > 30) { 
        err += "<p>The Blog name cannot be greater than 30 characters</p><br>";
    }
    if (username.length > 30) {
        err += "<p>The username cannot be greater than 30 characters</p><br>";
    }
    if (username.match("\\W")) {
        err += "<p>The user name can only contain letters, underscores and numbers.</p><br>";
    }
    if (password_one.length > 8) {
        err += "<p>The password cannot be greater than 8 characters.</p><br>";
    }
    if (blogurl.match("\\W|[A-Z]")) {
        err += "<p>The URL can only contain lowercase letters, underscores and numbers</p><br>";
    }
    
    if (err) {
        bootbox.alert(err);
        return false;
    }
    
    return true;
}

function ajaxAddRecordToDB(username, password, blogname, blogurl, personname) {
        request = new XMLHttpRequest();
        request.open('post', 'validateSignup.php', false);
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request_text = "username="+username+"&password="+password+"&blogname="+blogname+"&blogurl="+blogurl+"&personname="+personname;
        request.send(request_text);
        response = request.responseText;
        return response;
}

function validLoginForm(username, password) {
    var err = "";
    if (!password || !username) {
        err += "<p>One of the fields is missing. We need all the fields to set up your blog.<br>";
    }
    
    if (!username || username.length > 30) {
        err += "<p>The username cannot be greater than 30 characters</p><br>";
    }
    if (!password || password.length > 8) {
        err += "<p>The password cannot be greater than 8 characters.</p><br>";
    }
    
    if (!err) {
        return true;
    }
    
    bootbox.alert(err);
    return false;
    
}

function processLoginForm() {
    
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var rememberme = $("rememberme").val();
    
    if (!validLoginForm(username, password)) {
        return false;
    }
    
    result = JSON.parse(validateUsernameAndPassword(username, password));
    if (!result.result) {
        bootbox.alert(result.message);
        return false;
    } else {
        $.cookie("blog_id", result.blog_id);
        window.location = "blog-edit.php";
        return false;
    }
}

function validateUsernameAndPassword(username, password) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", 'validateLogin.php', false);
    var request = "username=".concat(username).concat("&password=").concat(password);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(request);
    return xmlhttp.responseText;
}

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