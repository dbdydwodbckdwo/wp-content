<?php get_header(); ?>

<h1>테스트(CPT)-1 목록</h1>

<?php if ( have_posts() ) : ?>
    <ul class="test1-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else : ?>
    <p>CPT게시판테스트_1 에 해당하는 글이 없습니다.</p>
<?php endif; ?>

<?php get_footer(); ?>
