<?php get_header(); //include the header.php to the theme ?>

<div class="container-fluid">
    <div class="posts">
        <div class="row">

            <!--  sidebar           -->
            <div class="col-md-3">
                <div class="el-sidebar">
                    <?php
                    // create sidebar from wordpress system; this will not include the sidebar.php file
                    if(is_active_sidebar('main-sidebar')) { // check if sidebar exists, the parameter is the id of sidebar form the function.php file
                        dynamic_sidebar('main-sidebar'); // include the sidebar with main-sidebar id to the theme; if the sidebar not exists the default sidebar will be included
                    }
                    ?>
                </div>
            </div>

            <!--   the posts section         -->
            <div class="col-md-9">

<?php
    if(have_posts() ) // all posts
    {
        while(have_posts())
        {
            the_post(); // for initialize
?>
                <div class="post">
                    <h3 class="title os-font"><a href="<?php the_permalink(); // link to the current post ?>"><?php the_title(); ?></a></h3>
                    <div class="image">
                        <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail']); // get featured image ?>
                    </div>
                    <div class="content sans-font">
                        <?php the_excerpt() // display small paragraph of the post content?>
                    </div>
                    <hr />
                    <div class="info cm-font">
                        <i class="fa fa-user"></i> <span class="author"><?php the_author_posts_link(); // display the post author with like to all posts of that author ?></span> |
                        <i class="fa fa-calendar"></i> <span class="date"><?php the_date(); // display the date of the post ?></span> &nbsp; <span><?php the_time(); // display the time of the post ?></span> |
                        <i class="fa fa-comments"></i> <span class="comments-number"><?php comments_popup_link("0 Comments", '1 Comment', '% Comments', '', 'Comments Disabled') // display the number of comments with link to all comments of that post ?></span>
                    </div>
                    <div class="categories cm-font">
                        <i class="fa fa-folder"></i>
                        <span>Categories: </span>
                        <?php the_category(', '); // display the category of the post ?>
                    </div>
                    <div class="tags cm-font">
                        <i class="fa fa-tags"></i>
                        <?php
                            if(has_tag()) // check if post has tags
                                the_tags();
                            else
                                echo "<span class='red-color'>no tags</span>";
                        ?>
                    </div>
                </div>
<?php

        }
    } else { // if no post exists ?>

        <!--  if no posts exists      -->
        <div class="col-md-12">
            <div class="el-no-posts sans-font red-color"><i class="fa fa-info-circle"></i> no posts</div>
        </div>
    <?php } ?>
            </div>
        </div>

            <!--  pagination as previous and next, not numbered pagination      -->
<!--        <div class="row">-->
<!--            <div class="col-md-3"></div>-->
<!--            <div class="col-md-9 text-right">-->
<!--                <div class="index-pagination">-->
<?php
//                if(get_previous_posts_link()) // check if there is page previous the current page
//                  previous_posts_link(); // display the previous link to the next page
//                else
//                    echo "<span class='gray-color pointer-not-allowed'>« No Previous Pages</span>";
//?>
<!--                &nbsp; &nbsp;-->
<?php
//                if(get_next_posts_link()) // check if there are pages next the current page
//                    next_posts_link(); //display the next link to the next page
//                else
//                    echo "<span class='gray-color pointer-not-allowed'>No Next Page »</span>"
//?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- make numbered pagination -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 text-right">
                <div class="el-numbered-pagination">
                    <?php echo elzero_numbered_pagination(); // make numbered pagination ?>
                </div>
            </div>
        </div>
    </div>
</div>






<?php get_footer(); // include the footer.php to the theme ?>
