<?php
/**
 * Created by PhpStorm.
 * User: jana
 * Date: 12/05/2017
 * Time: 16:33
 */

$height_value = get_post_meta(get_the_ID(), "_tt_create_height", true);
$intelligence_value = get_post_meta(get_the_ID(), "_tt_create_intelligence", true);
$strength_value = get_post_meta(get_the_ID(), "_tt_create_strength", true);
$speed_value = get_post_meta(get_the_ID(), "_tt_create_speed", true);
$agility_value = get_post_meta(get_the_ID(), "_tt_create_agility", true);
$fighting_skills_value = get_post_meta(get_the_ID(), "_tt_create_fighting_skills", true);



?>
<style>
    .card-container{
        border-radius: 10px;
        border: 10px solid black;
        background-color: darkred;
        color: white;
    }
    .name-container{

    }
    .image-container{

    }
    .card-container img{
        min-width: 100%;
        height: auto;
    }
    .data-container .tt-attriubute{
        display: inline-block;
        width: 50%;
    }
    .data-container .tt-data{
        display: inline-block;
        width: 50%;
    }
</style>
<div class="card-container">

    <div class="name-container">
        <?php echo the_title();?>
    </div>
    <div class="image-container">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="data-container">
        <div class="tt-attriubute">
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
