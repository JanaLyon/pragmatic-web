<?php

$topTrumpSet_query = new WP_Query(
    array(
        'post_type' => 'tt_toptrumps',
        'posts_per_page' => '30',
        'order' => 'DESC',
    )
);

while ($topTrumpSet_query->have_posts()) {
    $topTrumpSet_query->the_post();

    $height_value = get_post_meta(get_the_ID(), "_tt_create_height", true);
    $intelligence_value = get_post_meta(get_the_ID(), "_tt_create_intelligence", true);
    $strength_value = get_post_meta(get_the_ID(), "_tt_create_strength", true);
    $speed_value = get_post_meta(get_the_ID(), "_tt_create_speed", true);
    $agility_value = get_post_meta(get_the_ID(), "_tt_create_agility", true);
    $fighting_skills_value = get_post_meta(get_the_ID(), "_tt_create_fighting_skills", true);

    //var_dump($height_value)
    ?>

    <div class="tt_card-container ontouchstart=" this.classList.toggle(
    'hover');">
    <div class="tt_card">
        <div class="front">
            <div class="name-container">
                <?php echo the_title(); ?>
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
                    <p><?php echo $height_value; ?></p>
                    <p><?php echo $intelligence_value ?></p>
                    <p><?php echo $strength_value ?></p>
                    <p><?php echo $speed_value ?></p>
                    <p><?php echo $agility_value ?></p>
                    <p><?php echo $fighting_skills_value ?></p>
                </div>
            </div>
        </div>
        <div class="back">
            <div class="description-container">
                <div class="name-container">Origin story</div>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                    Consonantia, there
                    live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                    the semantics, a large language ocean. It is a paradisematic country, in which
                    roasted parts of sentences fly into your mouth. </p>
            </div>
            <div class="image-container">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="name-container">
                <?php echo the_title(); ?>
            </div>
        </div>
    </div>
    </div>
    <?php
} //if ($this_query)
wp_reset_query(); // Restore global post data stored by the_post().
?>
