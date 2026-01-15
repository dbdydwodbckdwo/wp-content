<?php
/**
 * Plugin Name: Test Plugin
 * Description: 관리자 화면에 문구 하나 출력하는 플러그인 예제
 * Version: 1.0
 * Author: 나
 */

// Plugin Name 으로 워드프레스가 플러그인 인식
// 관리자 화면 상단에 문구 출력
add_action('admin_notices', function () {
    echo '<div class="notice notice-success"><p>플러그인이 정상 동작 중....</p></div>';
});

add_action('wp_footer', function () {
    echo '<p style="text-align:center;color:black;">플러그인 동작 중....</p>';
});