<?php
get_header(); // header.php 로드 (없으면 무시됨)
?>

<main class="single">

<h3>이곳은 디폴트 포스트의 글이 나오는 single.php이다.</h3>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- 제목 -->
                <h1 class="">
                    <?php the_title(); ?>
                </h1>

                <!-- 본문 -->
                <div class="">
                    <?php the_content(); ?>
                </div>

            </article>

        <?php endwhile; ?>
    <?php else : ?>

        <p>포스트의 글이 없습니다.</p>

    <?php endif; ?>

</main>

<?php
get_footer(); // footer.php 로드 (없으면 무시됨)
?>
