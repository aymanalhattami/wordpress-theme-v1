<?php get_header() // include the header.php ?>

<div class="container-fluid">
    <div class="row">

        <!--   sidebar     -->
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

        <!--    author information    -->
        <div class="col-md-9">
            <div class="el-profile-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            <span><?php the_author_meta('nickname') ?>'s</span>
                            <span>Page</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="el-profile-names">
                <div class="row">
                    <div class="col-md-3">
                        <?php echo get_avatar(get_the_author_meta("ID")/* id of the author */, 192, '', 'author avatar', ['class' => 'img-responsive img-thumbnail text-center center-block']); // to display the avatar of the author ?>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <i class="fa fa-user red-color"></i> <span class="bold-font">Full Name: </span><span><?php the_author_meta('first_name') ?> <?php the_author_meta('last_name') ?></span> &nbsp; &nbsp; <span class="bold-font">Nick Name: </span><span><?php the_author_meta('nickname'); ?></span>
                        </div>
                        <hr class="no-margin-btm"/>
                        <div>
                            <i class="fa fa-bars red-color"></i> <span class="bold-font">Description: </span>
                            <?php if(get_the_author_meta('description')) { // check if author has description ?>
                                <p class="sans-font">
                                    <span>Description: </span> <?php the_author_meta('description') // description of the post writer ?>
                                </p>
                            <?php } else { ?>
                                <p class="red-color sans-font"><i class="fa fa-info"></i> This author Does not has description</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="el-author-status">
                <div class="row">
                    <div class="col-md-4">
                        <div class="status">
                            <span class="count posts-count pull-left"><?php echo count_user_posts(get_the_author_meta('ID')) // number of author posts  ?></span>
                            <span class="heading pull-left">Posts Counts</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status">
                            <span class="count comments-count pull-left"><?php echo get_comments(['user_id' => get_the_author_meta('ID'), 'count' => true]);  // return the number of comments for the author ?></span>
                            <span class="heading pull-left">Comments Counts</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status">
                            <span class="count views-count pull-left">0</span>
                            <span class="heading pull-left">Totoal Views</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--   latest author posts     -->
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="el-author-post">
                <h4>Latest <?php the_author_meta('nickname'); ?>'s Posts</h4>
                <?php
                //display the current author posts only
                $author_posts = new WP_Query(['author' => get_the_author_meta('ID'), 'posts_per_page' => 5]);

                if($author_posts->have_posts() ) // all posts
                {
                    while($author_posts->have_posts())
                    {
                        $author_posts->the_post(); // for initialize
                        ?>
                            <div class="post">
                                <h3 class="title os-font"><a href="<?php the_permalink(); // link to the current post ?>"><?php the_title(); ?></a></h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="image">
                                            <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail']); // get featured image ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="content sans-font">
                                            <?php the_excerpt() // display small paragraph of the post content?>
                                        </div>
                                        <hr class="no-margin-btm" />
                                        <div class="info cm-font">
                                            <i class="fa fa-calendar red-color"></i> <span class="date"><?php the_date(); // display the date of the post ?></span> &nbsp; <span><?php the_time(); // display the time of the post ?></span> ||
                                            <i class="fa fa-comments red-color"></i> <span class="comments-number"><?php comments_popup_link("0 Comments", '1 Comment', '% Comments', '', 'Comments Disabled') // display the number of comments with link to all comments of that post ?></span>
                                        </div>
                                    </div>
                                </div>
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

        <!--   latest author comments     -->
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <div class="el-author-last-comments">
                <h4>Latest <?php the_author_meta('nickname'); ?>'s Comments</h4>
                <?php
                    //display the current author comments
                    $comments = get_comments(['user_id' => get_the_author_meta('ID'), 'status'  =>  'approve', 'number' => 5, 'post_status' => 'publish', 'post_type' => 'post']);

                    //check if there are comments for this author
                    if($comments)
                    {
                        foreach($comments as $comment)
                        {
                ?>
                            <div class="el-comment-info">
                                <h5 class="bold-font pull-left"><a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a></h5><!-- display the post name with link to the post details(single.php) -->
                                <span class="pull-right"><i class="fa fa-calendar red-color"></i> on <strong><?php echo mysql2date('l, F j, Y' ,$comment->comment_date) ?></strong></span> <!-- display the comment date -->
                                <div class="clearfix"></div>
                                <hr />
                                <p><?php echo $comment->comment_content ?></p> <!-- display the comment content -->
                            </div>
                <?php
                        }
                    }
                    else
                    {
                ?>
                        <div class="red-color"><i class="fa fa-info-circle"></i> No Comments for this Author</div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); //include the footer.php ?>
