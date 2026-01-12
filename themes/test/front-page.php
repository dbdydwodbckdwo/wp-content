<?php get_header(); ?>

<h1>디폴트 홈페이지 - 페이지 목록</h1>

<div>front-page.php로 접근한다.</div>
<div>
    워드프레스 관리자에서 기본으로 제공하는 '홈페이지' </br>
    고정 페이지”를 선택하면 page가 루트 URL(/)를 차지하고, </br>
    템플릿은 front-page.php → page.php → index.php 순서로 선택됨. </br>
    여기선 그냥 페이지 목록 보여주게 해놨음
</div>

<?php if ( have_posts() ) : ?>
    <ul class="page-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else : ?>
    <p>페이지 목록이 없습니다.</p> 

<?php endif; ?>


<nav>

    <h3>글페이지</h3>

    <div>
    <a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
        관리자에서 설정한 글페이지로 이동
    </a>
    </div>


    <h3>CPT 포스트 타입 test 1</h3>
    <a href="<?php echo get_post_type_archive_link('test1'); ?>">
        test1 글 목록으로 이동
    </a>



</nav>


<?php get_footer(); ?>
