<?php

    function printEditCommentsHtml($result) {
	
	print "<table class='table-bordered table table-stripped'>";
        print "<tr>";
        print "<th>Name</th><th>Email</th><th>Comment</th><th>Delete</th>";
        print "</tr>";
        
        while ($comment= mysql_fetch_array($result)) {
            print "<tr>";
            print "<td>".$comment['name']."</td>";
            print "<td>";
            print $comment['email'];
            print "</td>";
            print "<td>".$comment['body']."</td>";
            print "<td><a class='delete-comment' href='#' comment_id={$comment['id']}><i class='icon-remove'> </i></a></td>";
            print "</tr>";
        }
        
	
        print "</table>";
        
    }
    

    
    
    function printEditBlogHtml($blog) {
	
       
        return;
        
    }
    
    
    function printPostNotFoundError() {
	$result =  "<div class=\"alert alert-error\">";
	$result += "<h4 class=\"alert-heading\">";
	$result += "Error!";
	$result += "</h4>";
	$result += "The post you are trying to edit was not found.</div>";
	print result;
    }


    function printAddPostForm($post) {
	print "<div class='fow-fluid'>";
	print "<br><br>";
	print "</div>";
	print "<form class='well span10' post_id=";
	if ($post) {
	    print $post['id'];
	} else {
	    print "newpost";
	}
	print ">";
	print "<label>Post Title</label>";
	print "<input type=\"text\" class='span12' name=\"title\" value=";
	print "\"".$post['title']."\"";
	print " />";
	print "<label>Post Subtitle</label>";
	print "<input type=\"text\" class='span12' name=\"subtitle\" value=";
	print "\"".$post['subtitle']."\"";
	print " />";
	print "<label>Post Body</label>";
	print "<textarea id='body' rows='20' name='body' class='span12'>";
	print $post['body'];
	print "</textarea>";
	print "<button type='submit' id='edit-post-submit' class='btn btn-primary pull-right'>Done</button>";
	print "<button id='cancel-button' class='btn'>Cancel</button>";
	print "</form>";
    }
    
    function printErrorModal() {
	print "<div id='errorModal' class='modal fade'>";
        print "<div class='modal-header'>";
	print "<h3>Oopsies!</h3>";
	print "</div>";
	print "<div class='modal-body'>";
	print "<p>modal body</p>";
	print "</div>";
	print "<div class='modal-footer'>";
	print "<input class='btn btn-primary' onclick=\"$('#errorModal').modal('hide')\" value='Go back'>";
        print "</div></div>";
    }
    
    
?>