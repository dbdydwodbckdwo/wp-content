<?php
get_header(); // header.php 로드 (없으면 무시됨)
?>

<main class="test1-single">

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!-- 제목 -->
                <h1 class="test1-title">
                    <?php the_title(); ?>
                </h1>

                <!-- 본문 -->
                <div class="test1-content">
                    <?php the_content(); ?>
                </div>

                <!-- 메타 정보 -->
                <?php
                $role = get_post_meta(get_the_ID(), 'role', true);
                $tech = get_post_meta(get_the_ID(), 'tech', true);
                $desc = get_post_meta(get_the_ID(), 'desc', true);
                ?>

                <?php if ($role || $tech || $desc) : ?>
                    <section class="test1-meta">

                        <?php if ($role) : ?>
                            <p><strong>담당 역할:</strong> <?php echo esc_html($role); ?></p>
                        <?php endif; ?>

                        <?php if ($tech) : ?>
                            <p><strong>사용 기술:</strong> <?php echo esc_html($tech); ?></p>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p><strong>수행 내용:</strong><br>
                                <?php echo nl2br(esc_html($desc)); ?>
                            </p>
                        <?php endif; ?>

                    </section>
                <?php endif; ?>

            </article>

        <?php endwhile; ?>
    <?php else : ?>

        <p>CPT게시판테스트_1 글이 없습니다.</p>

    <?php endif; ?>

</main>

<?php
get_footer(); // footer.php 로드 (없으면 무시됨)
?>
