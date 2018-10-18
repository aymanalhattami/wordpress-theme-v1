<?php $all_cats = get_the_category(); // retrieve the current post categories ?>
<div class="el-breadcrumb">
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo get_home_url(); // url to the home page (index.php) ?>" class="red-color"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo esc_url(get_category_link($all_cats[0]->term_id)); // link to the category ?>"><?php echo esc_html($all_cats[0]->name); // name of the category ?></a></li>
                <li><?php echo get_the_title(); // the title of the current post ?></li>
            </ol>
        </div>
    </div>
</div>