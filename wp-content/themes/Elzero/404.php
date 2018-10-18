<?php get_header(); // include the header.php ?>

<div class="container">

    <!--   not found information page      -->
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="not-found">
                <img class="img-responsive center-block" src="<?php echo get_template_directory_uri() . '/images/DeviceNotFound.png' ?>" alt="Not Found" />
                <h1>Page Not Fount</h1>
                <p>Try to Search Instead <i class="fa fa-smile-o red-color"></i></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); // include the footer.php ?>