<?php get_header(); ?>

<h1>디폴트 홈페이지 - 페이지 목록</h1>

<h3
    style="color:red">페이지 CSS, JS등 기능과 스타일을 제외하고 규칙과 구성만 알아보기 위해 만든 페이지</h3>

<div>front-page.php로 접근한다.</div>
<div>
    워드프레스 관리자에서 기본으로 제공하는 '홈페이지'에서 선택</br></br>
    1. 최신글 -> 디폴트 포스트 리스트를 가져온다.</br>
    2. 정적인페이지 -> 선택한 페이지를 가져온다.</br>
    3. 템플릿은 front-page.php → page.php → index.php 순서로 선택됨. </br></br>

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

    <h3>디폴트 포스트</h3>

    <div>

    <!--
    page_for_posts란?
    → 글(post) 목록을 보여줄 “주소(URL)”를 제공하는 페이지의 ID 

    최신글일경우 single.php로 감.

    글페이지일 경우 home.php로 감. 이때 post 글 목록을 들고 가는 듯
    -->
    <a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
        관리자에서 설정한 포스트 목록으로 이동
    </a>
    </div>


    <h3>CPT 포스트 타입 test 1</h3>
    <span>CPT란 : 커스텀 포스트 타입으로, 사용자가 정의한 새로운 게시물 유형</span>

    <div>
        <a href="<?php echo get_post_type_archive_link('test1'); ?>">
            test1 글 목록으로 이동
        </a>
    </div>



</nav>


<?php get_footer(); ?>
