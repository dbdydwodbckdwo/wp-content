<?php
/**
 * CPT 타입 등록
 */
add_action('init', function () {

    // CPT 포스트타입 테스트 1
    register_post_type('test1', [
        'label' => 'CPT게시판테스트_1',
        'public' => true,
        'has_archive' => true, // 항상 rewrite rules flush를 해주자(퍼머링크 설정 그냥 저장)
        'supports' => ['title', 'editor'],
        'taxonomies' => ['category', 'post_tag'],
    ]);

    // CPT 포스트타입 테스트 2
    register_post_type('test2', [
        'label' => 'CPT게시판테스트_2',
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor'],
    ]);
});



/**
 * 
 * 메인 쿼리
* 카테고리 페이지에서 post + mypage + test1 같이 나오게 사용자가 코드로 쿼리 조작
*/
add_action('pre_get_posts', function ($query) {

    if (is_admin()) return; // 관리자 페이지면 종료
    if (!$query->is_main_query()) return; // 메인 쿼리가 아니면 종료
    if (!is_category()) return; 

    $query->set('post_type', ['post', 'mypage', 'test1']);
});

add_action('pre_get_posts', function ($query) {

    if (is_admin()) return;
    if (!$query->is_main_query()) return;

    // test1 아카이브 전용
    if ($query->is_post_type_archive('test1')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
});



/**
 * test1(CPT게시판테스트_1) 메타박스 추가
 */
add_action('add_meta_boxes', function () {

    add_meta_box(
        'test1_box1',
        '메타박스 1',
        'render_test1_box1', // 메타박스 출력 함수
        'test1',
        'side'
    );

    add_meta_box(
        'test1_box2',
        '메타박스 2',
        'render_test1_box2', // 메타박스 출력 함수
        'test1',
        'normal'
    );

    add_meta_box(
        'test1_box3',
        '메타박스 3',
        'render_test1_box3', // 메타박스 출력 함수
        'test1',
        'normal'
    );
});



/**
 * 메타박스 출력 함수들 (관리자 화면의 test1(CPT게시판테스트_1) 편집 화면에서 호출됨)
 */
function render_test1_box1($post) {
    $value = get_post_meta($post->ID, 'box1', true);
    ?>
    <input type="text"
           name="test1_box1"
           value="<?php echo esc_attr($value); ?>"
           style="width:100%;" />
    <?php
}

function render_test1_box2($post) {
    $value = get_post_meta($post->ID, 'box2', true);
    ?>
    <input type="text"
           name="test1_box2"
           value="<?php echo esc_attr($value); ?>"
           style="width:100%;" />
    <?php
}

function render_test1_box3($post) {
    $value = get_post_meta($post->ID, 'box3', true);
    ?>
    <textarea name="test1_box3"
              style="width:100%; height:100px;"><?php echo esc_textarea($value); ?></textarea>
    <?php
}



/**
 * test1(CPT게시판테스트_1) 메타 저장
 * 
 */
add_action('save_post_test1', function ($post_id) {

    // 자동 저장 방지
    // 자동 저장 중에 제목과 본문은 저장되지만 메타박스 값은 저장되지 않도록 하기 위함
    // 메타저장 : 본문과 제목을 제외하고 글에 붙는 추가 정보 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (
        !isset($_POST['project_nonce']) ||
        !wp_verify_nonce($_POST['project_nonce'], 'save_project')
    ) return;


    if (isset($_POST['test1_box1'])) {
        update_post_meta(
            $post_id,
            'box1',
            sanitize_text_field($_POST['test1_box1'])
        );
    }

    if (isset($_POST['test1_box2'])) {
        update_post_meta(
            $post_id,
            'box2',
            sanitize_text_field($_POST['test1_box2'])
        );
    }

    if (isset($_POST['test1_box3'])) {
        update_post_meta(
            $post_id,
            'box3',
            sanitize_textarea_field($_POST['test1_box3'])
        );
    }
});



/**
 * test1(CPT게시판테스트_1) 전용 분류 (커스텀 택소노미) 등록
 * test1 글들을 test1_custom_ctgr 라는 분류로 묶기 위함. 
 * 화면에는 label 이라는 이름으로 표시됨
 * 현재는 rewrite 옵션이 없어서 URL은 /test1_custom_ctgr/카테고리명/ 형태로 접근 가능
 * 카테고리명은 관리자 화면에서 직접 지정 가능
 */

// register_taxonomy('분류 이름', '어떤 포스트타입에 적용할지', [옵션들]);
register_taxonomy('test1_custom_ctgr_1', 'test1', [
    'label' => '커스텀 카테고리 택소노미_1',
    'hierarchical' => true,
]);

register_taxonomy('test1_custom_ctgr_2', 'test1', [
    'label' => '커스텀 카테고리 택소노미_2',
    'hierarchical' => true,
]);



/**
 * 7️⃣ 테마 스타일시트 로드
 * add_action(액션이름, 콜백함수)
 * wp_enqueue_scripts(액션이름, 기본 제공 스타일시트 또는 커스텀 스타일시트 로드 함수)
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
});