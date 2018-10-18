<?php
    /* configuartion for comments */
    if(comments_open()) // if comments enabled
    {
        //display number of comments
        echo '<h5 class="el-comment-num bold-font text-right">'; comments_number('0 Comments', '1 Comment', '% Comments'); echo '</h5>';

        echo "<ul class='list-unstyled elzero-comments-list'>"; // for design
        // display all comments for specific post
        wp_list_comments(array(
            'max-depth' => 2,
            'type' => 'comment',
            'reverse-top-level' => true,
        ));

        echo "</ul>";

        echo "<hr class='aaa-hr' />";

        echo "<div class='row'>";
            echo "<div class='col-sm-9'>";
                //display the commment form and add arguments to the form
                comment_form();
            echo "</div>";
        echo "</div>";
    }
    else // if comments disabled
    {
        echo "<span class='red-color'><i class='fa fa-info-circle'></i> Comments Disabled</span>";
    }