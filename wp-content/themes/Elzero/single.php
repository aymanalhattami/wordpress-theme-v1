<!-- single.php page is for every post -->
<?php get_header(); //include the header.php to the theme ?>

<div class="container-fluid">
    <?php include(get_template_directory() . '/includes/breadcrumb.php'); //include the breadcrumb ?>
    <div class="posts single-posts">
        <div class="row">

            <!--   sidebar     -->
            <div class="col-sm-3">
                <div class="el-sidebar">
                    <?php
                    // create sidebar from wordpress system; this will not include the sidebar.php file
                    if(is_active_sidebar('main-sidebar')) { // check if sidebar exists, the parameter is the id of sidebar form the function.php file
                        dynamic_sidebar('main-sidebar'); // include the sidebar with main-sidebar id to the theme; if the sidebar not exists the default sidebar will be included
                    }
                    ?>
                </div>
            </div>

            <!--   the current post information     -->
            <div class="col-sm-9">
                <div class="row">
                    <?php
                    if(have_posts() ) // all posts
                    {
                        while(have_posts()) // check if there ara posts
                        {
                            the_post(); // for initialize
                            ?>

                            <div class="col-sm-12">
                                <div class="single-post">
                                    <h3 class="title os-font pull-left"><?php the_title(); ?></h3>
                                    <div class="pull-right"><?php edit_post_link('<i class="fa fa-pencil"></i> Edit', '', '', '', 'btn btn-warning btn-sm no-border-radius'); ?></div>
                                    <div class="clearfix"></div>
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
                                    <div class="tags single-tags cm-font">
                                        <i class="fa fa-tags"></i>
                                        <?php
                                        if(has_tag()) // check if post has tags
                                            the_tags();
                                        else
                                            echo "<span class='red-color'>no tags</span>";
                                        ?>
                                    </div>
                                    <div class="image">
                                        <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail']); // get featured image ?>
                                    </div>
                                    <div class="content sans-font">
                                        <?php the_content() // display the whole content ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">

            <!--   pagination for the previous post and next post    -->
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-right">
                <div class="single-pagination">
                    <div class='pull-left'>
                <?php
                if(get_previous_post_link()) // check if there is post previous the current post
                    previous_post_link('%link', '<i class="fa fa-chevron-left"></i> <span class="black-color">previous post</span> <span class="bold-font">"%title"</span>'); // display the previous link to the next post
                else
                    echo "<span class='gray-color pointer-not-allowed'>« No Previous Pages</span>";
                ?>
                    </div>
                    <div class="pull-right">
                <?php
                if(get_next_post_link()) // check if there are post next the current post
                    next_post_link('%link', '<span class="black-color">next post</span> <span class="bo  ld-font">"%title"</span> <i class="fa fa-chevron-right"></i>'); //display the next link to the next post
                else
                    echo "<span class='gray-color pointer-not-allowed'>No Next Page »</span>"
                ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!--   author information of the current post    -->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <hr class="aaa-hr" />
                <div class="el-author-meta">
                    <h4 class="border-left cm-font"><i class="fa fa-info red-color"></i> Author Information</h4>
                    <div class="row">
                        <div class="col-sm-2">
                            <?php echo get_avatar(get_the_author_meta("ID")/* id of the author */, 64, '', 'author avatar', ['class' => 'img-responsive img-thumbnail text-center center-block']); // to display the avatar of the author ?>
                        </div>
                        <div class="col-sm-10">
                            <span class="blue-color bold-font"><?php the_author_meta('first_name') // name of the post writer ?></span>
                            <span class="blue-color bold-font"><?php the_author_meta('last_name') // name of the post writer ?></span>
                            [<span class="bold-font"><?php the_author_meta('nickname') // name of the post writer ?></span>]
                            <?php if(get_the_author_meta('description')) { // check if author has description ?>
                                <p class="sans-font">
                                    <?php the_author_meta('description') // description of the post writer ?>
                                </p>
                            <?php } else { ?>
                                <p class="red-color sans-font"><i class="fa fa-info"></i> This author Does not has description</p>
                            <?php } ?>
                        </div>
                    </div>
                    <hr class="aaa-hr" />
                    <div class="el-author-posts sans-font">
                        <span><i class="fa fa-user red-color"></i> Author Profile Link: </span> <span class="bold-font"><?php the_author_posts_link() //display link to the current author profile ?></span> &nbsp;
                        <span>&& Posts Numbers: </span> <span class="bold-font red-color"><?php echo count_user_posts(get_the_author_meta("ID")) //display the number of posts for the currnet author ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!--    display comment form from comments.php    -->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-7">
                <hr class="aaa-hr" />
                <?php comments_template(); // to display the comment form from comments.php ?>
            </div>
        </div>

        <!--    display random posts from the categories of the current post, and exclude the current post    -->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="el-author-post el-random-post">
                    <h4>Random Posts from the Same Categories <hr class="aaa-hr" /></h4>

                    <?php
                    // query for random posts
                    // wp_get_post_categories() => function to specify the current post categories
                    // get_queried_object_id() => function returns the current post id
                    $random_posts = new WP_Query([
                        'posts_per_page'    => 4,
                        'orderby'           => 'rand',
                        'category__in'      => wp_get_post_categories(get_queried_object_id()),
                        'post__not_in'      => [get_queried_object_id()]
                    ]);

                    if($random_posts->have_posts() ) // all posts
                    {
                        while($random_posts->have_posts())
                        {
                            $random_posts->the_post(); // for initialize
                    ?>
                                <div class="post">
                                    <h3 class="title os-font"><a href="<?php the_permalink(); // link to the post ?>"><?php the_title(); ?></a></h3>
                                </div>
                    <?php
                        }
                    } else { ?>
                        <div class="el-no-posts sans-font red-color"><i class="fa fa-info-circle"></i> no posts for this author <span class="bold-font">(<?php the_author_meta('nickname') ?>)</span></div>
                    <?php
                    }
                        wp_reset_postdata(); // reset the loop
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>






<?php get_footer(); // include the footer.php to the theme ?>
