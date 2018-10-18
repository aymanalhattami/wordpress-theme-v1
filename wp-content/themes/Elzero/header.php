<!DOCTYPE html>
<html <?php language_attributes(); // html element attributes like: lang, dir ?>>
    <head>
        <meta charset="<?php bloginfo("charset"); // return the character set like: utf-8 ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php wp_title('|', 'true', 'right'); ?>
            <?php bloginfo('name') // name of the blog ?>
        </title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); // pingback ?>" />
        <?php wp_head(); // before closing head tag, you should include this function; this function add styles, scripts, meta tags ?>
    </head>
    <body>
    <nav class="navbar navbar-inverse no-border-radius no-margin">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php bloginfo('url'); // url to the blog (index page) ?>"><?php bloginfo('name') // display name of the blog ?></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php elzero_bootstrap_menu(); // display the menu like navbar ?>
            </div>
        </div>
    </nav>
    <div class="navbar-border"></div>