<footer>
<div class="container">
    <div class="row">
        
    </div>
</div>
</footer>


<?php wp_footer(); ?>


<?php if (is_single()){ ?>
<script>


jQuery(window).scroll(function() {

    ScrollPosition = jQuery(window).scrollTop();

    jQuery('.scrool-container-position').html(ScrollPosition)
    
    
});


/*
ClassicEditor
    .create( document.querySelector( '#comment' ) )
    .catch( error => {
        console.error( error );
    } );*/
</script> 
<?php  } ?>

</body>
</html>