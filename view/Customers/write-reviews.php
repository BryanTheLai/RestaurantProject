<?php 
include_once('view/components/header.php');
?>
<section id="hero" style="position: relative;">
    <div class="hero container" style="position: relative; z-index: 1;">
       <div id="review-writing">
            <h1>Write us a review!</h1>
            <form action="processes/Customers/review_process.php" method="POST">
                <input type="hidden" name="action" value="review">
                
                <label for="title">Title</label>
                <input type="text" name="title" id="title">

                <label for="content">Content</label>
                <textarea name="content" id="content" cols="100%" rows="5"></textarea>
                
                <label for="ratings">Star Ratings</label>
                <div class="rateYo" data-rateyo-full-star="true" data-rateyo-rating="0"></div>
                <input type="hidden" name="rating">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </form>
       </div>
    </div>
</section>
<?php 
include_once('view/components/footer.php');
?>