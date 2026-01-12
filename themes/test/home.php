<?php get_header(); ?>

<h1>디폴트 메인 포스트 목록 (home.php로 접근)</h1>

<?php if ( have_posts() ) : ?>
    <ul class="main-post-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else : ?>
    <p>메인 포스트 목록이 없습니다.</p>
<?php endif; ?>



<nav>
    <!-- post 목록으로 이동 -->

    <div>
    <a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
        포스트 글 목록
    </a>
    </div>

    <div>

    <!-- CPT 아카이브로 이동 -->
    <a href="<?php echo get_post_type_archive_link('test1'); ?>">
        CPT게시판테스트_1 글 목록(archive-test1.php)
    </a>

    </div>

</nav>


<?php get_footer(); ?>
