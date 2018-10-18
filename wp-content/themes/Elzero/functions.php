<?php
    require_once('wp-bootstrap-navwalker.php');

    /*********************************************************************************************************************
     * function to add styles to the theme
     */
    function elzero_add_styles()
    {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css'); // add the first style to the theme
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css'); // add second style to the theme
        wp_enqueue_style('skills-framework', get_template_directory_uri() . '/css/skills-framework.css');
        wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
    }

    /*********************************************************************************************************************
     * function to add scripts to the theme
     */

    function elzero_add_scripts()
    {
        // jquery is included in the wordpress by default; you need basic config to use the jquery
        wp_deregister_script('jquery'); // reomve the default configuration of jquery library;
        wp_register_script('jquery', includes_url('js/jquery/jquery.js'), false, '', true); // add new configuration to the jquery library by putting it before </body> tag
        wp_enqueue_script('jquery'); // put the jquery in the theme

        //wp_enqueue_script('jquery'); // load jquery from the wordpress repository, and put it in the <head> element
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true); // add bootstrap javascript file to the theme
        wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), false, true);

        wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js');
        wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

        wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.min.js');
        wp_script_add_data('respond', 'conditional', 'lt IE 9');
    }
    /*
     * add the styles and scripts to the theme
     */
    add_action('wp_enqueue_scripts', 'elzero_add_styles');
    add_action('wp_enqueue_scripts', 'elzero_add_scripts');


    /*********************************************************************************************************************
     * add menus like navbar
     */
    function elzero_custome_menu()
    {
        register_nav_menus(array( // create menus locations
            'bootstrap-menu' => 'navigation bar', // create first location
            'footer-menu' => 'footer menu', // create the second location
        ));
    }
    /*
     * add the menu to the theme
     */
    add_action('init', 'elzero_custome_menu');
    /*
     * dispaly the menu in the wordpress system
     */
    function elzero_bootstrap_menu()
    {
        wp_nav_menu(array(
            'theme_location' => 'bootstrap-menu',
            'menu_class' => 'nav navbar-nav',
            'container' => false,
            'depth' => 2,
            'walker' => new WP_Bootstrap_Navwalker(),
        ));
    }

    /*********************************************************************************************************************
     * make your theme support featured image
     */
    add_theme_support('post-thumbnails');

    /*********************************************************************************************************************
     * customize the excerpt length
     */
    function elzero_excerpt_lenght($lenght)
    {
        if(is_author()) // if you are in author.php page
        {
            return 40;
        }
        else if(is_category()) // if you are in category.php page
        {
            return 50;
        }
        return 40; // in another pages
    }
    add_filter('excerpt_length', 'elzero_excerpt_lenght');

    /*********************************************************************************************************************
     * change the text appear at the end of excerpt
     */
    function elzero_change_excerpts_dots($more)
    {
        return ' ...';
    }
    add_filter('excerpt_more', 'elzero_change_excerpts_dots');


    /*********************************************************************************************************************
    *   make numbered pagination
    */
    function elzero_numbered_pagination(){
        global $wp_query; // global wordpress variable; object of WP_query class
        $all_pages = $wp_query->max_num_pages; // total number of pages
        $current_page = max(1, get_query_var('paged')); //number of current page

        if($all_pages > 1) // check if there are more than one page
        {
            return paginate_links([
                'base'      => get_pagenum_link() . '%_%',
                'format'    => 'page/%#%',
                'current'   => $current_page
            ]);
        }
        else
        {

        }

    }


    /*********************************************************************************************************************
     * enable and register sidebar
     */
    function elzero_sidebar()
    {
        // register sidebar; you can add more than one sidebar; ( to support widget)
         register_sidebar([
             'name'         => 'Main Sidebar', // name of the sidebar
             'id'           => 'main-sidebar', // id for the sidebar to be used more than once, and must be small string
             'description'  => 'this is the main sidebar for the theme, and more sidebars can be added to the theme',
             'class'        => 'main-sidebar', // css class
             'before_widget'=> '<div class="el-side-widget">', // html tags
             'after_widget' => '</div>', // closing html tag
             'before_title' => '<h3 class="el-widget-title">', // widget title
             'after_title'  => '</h3>', // widget title
         ]);
    }
    add_action('widgets_init','elzero_sidebar'); // make the theme support widget