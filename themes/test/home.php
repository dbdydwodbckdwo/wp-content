<?php get_header(); ?>

<h1>포스트 페이지. home.php 파일이다.</h1>


<h3>
    정적인페이지 > 글페이지 선택한 후 page_for_posts를 타면 등록한 페이지의 슬러그의 URL을 빌려서 "디폴트 포스트 리스트"를 들고 이쪽으로 오게됨.
</h3>

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
    <!-- 

    page_for_posts란?
    → 글(post) 목록을 보여줄 “주소(URL)”를 제공하는 페이지의 ID

    -->

    <div>
    <a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
        관리자에서 설정한 최신글 or 글페이지로 이동
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
