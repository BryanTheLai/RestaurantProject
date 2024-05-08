<?php 
include_once('components/header.php'); 
?>
<section id="hero" style="position: relative;">
    <video autoplay loop muted playsinline poster="your-poster-image.jpg"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <source src="assets/image/BurgerGrilling.mp4" type="video/mp4">
        <!-- Add additional source elements for 
        1.  SteakOnGrillCloseup
        other video formats if needed -->
    </video>
    <div
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(20, 20, 20, 0.1);">
    </div>
    <div class="hero container" style="position: relative; z-index: 1;">
        <div>
            <h1><strong>
                    <h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> GRILL US!</h1>
                    <span></span>
                </strong></h1>
            <h1><strong style="color:white;">Send in your reviews!<span></span></strong></h1>
            <a href="#reviews" type="button" class="cta">Read Reviews</a>
        </div>
    </div>
</section>


<section id="reviews">
    <div class="reviews container">
        <h1 class="section-title">See What People <span>Says!</span></h1>
        <div id="reviews-box">
            <div class="review">
                <div>
                    <h2>Great Restaurant!</h2>
                    <ul class="star-rating">
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                    </ul>
                </div>
                <h3>From: Gordon Ramsey</h3>
                <p>Food was great but the place looks awesome! One thing I didn't liked is the child crying.</p>
            </div>
            <div class="review">
                <h2>Title</h2>
                <h3>From: Gordon Ramsey</h3>
                <p>Content bla bla blah</p>
            </div>
            <div class="review">
                <h2>Title</h2>
                <h3>From: Gordon Ramsey</h3>
                <p>Content bla bla blah</p>
            </div>
    </div>
        <button id="review-btn">WRITE YOUR REVIEW HERE!</button>
    </div>


</section>

<?php include_once('components/footer.php'); ?>