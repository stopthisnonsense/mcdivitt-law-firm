
<div <?php post_class('frog-item'); ?>>
    <div class="frog-item__left">
        <?php if( has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', ['class' => 'frog-item__image']); ?>
        </a><?php } ?>
    </div>
    <div class="frog-item__right">
    <h4 class="frog-item__title"><?php the_title(); ?>
    </h4>
    <div class="frog-item__excerpt">
        <?php the_excerpt(); ?>
        <div class="blog">
            <div class="blog-entry">
                <div class="frog-item__button-container"><a class="frog-item__button" href="<?php the_permalink(); ?>">Read More</a></div>
            </div>
        </div>
    </div>
    </div>

</div>
