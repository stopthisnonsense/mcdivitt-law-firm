<h4><?php the_title(); ?>
<a href="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()) {
    the_post_thumbnail('post-thumbnail', ['class' => 'alignleft']);
} ?></a></h4>
<?php the_excerpt(); ?>
<div class="blog">
<div class="blog-entry">
<div class="blog-post-excerpt"><a class="read-button" href="<?php the_permalink(); ?>">Read More</a></div>
</div>
</div>