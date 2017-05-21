<?php

$topTrumpSet_query = new WP_Query(
    array(
        'post_type' => 'tt_toptrumps',
        'posts_per_page' => '30',
        'order' => 'DESC',
    )
);
//read in cookies, strip \ set by js lib
$favourites_cookie = json_decode(stripcslashes($_COOKIE['favourites']));

?>
<div class="tt_card-set">
    <?php
    while ($topTrumpSet_query->have_posts()) {
    $topTrumpSet_query->the_post();

    $height_value = get_post_meta(get_the_ID(), "_tt_create_height", true);
    $intelligence_value = get_post_meta(get_the_ID(), "_tt_create_intelligence", true);
    $strength_value = get_post_meta(get_the_ID(), "_tt_create_strength", true);
    $speed_value = get_post_meta(get_the_ID(), "_tt_create_speed", true);
    $agility_value = get_post_meta(get_the_ID(), "_tt_create_agility", true);
    $fighting_skills_value = get_post_meta(get_the_ID(), "_tt_create_fighting_skills", true);
    // see if out title is in the array
    $favourite_btn_visibility = in_array(the_title('','',false), $favourites_cookie);

    ?>

    <div  class="tt_card-wrapper"  this.classList.toggle(
    'hover');"
    data-name="<?php echo the_title() ?>"
    data-height="<?php echo $height_value; ?>"
    data-intelligence="<?php echo $intelligence_value ?>"
    data-strength="<?php echo $strength_value ?>"
    data-speed="<?php echo $speed_value ?>"
    data-agility="<?php echo $agility_value ?>"
    data-fighting_skills="<?php echo $fighting_skills_value ?>"
    data-favourite="<?php echo $favourite_btn_visibility?1:0 ?>"
    >
<!--    data-compare=false-->

    <div class="tt_card-container ontouchstart=">
    <div class="tt_card">
        <div class="front">
            <div class="name-container">
                <?php the_title(); ?>
            </div>
            <div class="image-container">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="data-container">
                <div class="tt-attribute">
                    <p>Height (cm)</p>
                    <p>Intelligence</p>
                    <p>Strength</p>
                    <p>Speed</p>
                    <p>Agility</p>
                    <p>Fighting skills</p>
                </div>
                <div class="tt-data">
                    <p class="height_data"><?php echo $height_value; ?></p>
                    <p class="intelligence_data"><?php echo $intelligence_value ?></p>
                    <p class="strength_data"><?php echo $strength_value ?></p>
                    <p class="speed_data"><?php echo $speed_value ?></p>
                    <p class="agility_data"><?php echo $agility_value ?></p>
                    <p class="fighting_skills_data"><?php echo $fighting_skills_value ?></p>
                </div>
            </div>
        </div>
        <div class="back">
            <div class="description-container">
                <div class="name-container">Origin story</div>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the semantics, a large language ocean. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            <div class="image-container">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="name-container">
                <?php the_title(); ?>
            </div>
        </div>
    </div>
    </div>
    <div class="tt_selections">
<!--        <div class="tt_compare">-->
<!--            <i class="fa fa-check-square-o"-->
<!--               aria-hidden="true"-->
<!--               style="display: --><?php //echo $favourite_btn_visibility?'block':'none'?><!--"-->
<!--            ></i>-->
<!--            <i class="fa fa-check-square"-->
<!--               aria-hidden="true"-->
<!--               style="display: --><?php //echo $favourite_btn_visibility?'block':'none'?><!--"-->
<!--            ></i>-->
<!--        </div>-->
        <div class="tt_favourite">
            <i class="fa fa-heart-o"
               aria-hidden="true"
               style="display: <?php echo $favourite_btn_visibility?'none':'block'?>"
            ></i>
            <i class="fa fa-heart"
               aria-hidden="true"
               style="display: <?php echo $favourite_btn_visibility?'block':'none'?>"
            ></i>
        </div>
    </div>
</div>


<?php
} //if ($this_query)
wp_reset_query(); // Restore global post data stored by the_post().
?>
</div>
