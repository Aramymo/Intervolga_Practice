<?php foreach ($reviews as $review) : ?>
    <div class="row review_block">
        <div class="col-md-4centered_text">
            <h3><?php echo $review['username']?></h3>
        </div>
        <div class="col-md-8">
            <h5><?php echo $review['rating']?>/10</h5>
            <p><?php echo $review['comment']?></p>
        </div>
    </div>
<?php endforeach ?>