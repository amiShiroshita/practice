<?php
// 予期せぬエラーになった場合エラー内容を画面に出力する
ini_set('display_errors', true);

try {
    // 初期値の設定
    $urlParam       = [];
    $controllerName = '<自分で考える>';
    $actionName     = '<自分で考える>';

    // REQUEST_URI を取得して $urlParam に詰める

    // $controllerName に $urlParam の適切な値を詰める

    // $actionName に $urlParam の適切な値を詰める

    // $controllerName が記載されたファイルがあるかチェックする
    // - FALSE: 404画面を出す
    // - TRUE:  クラスをインスタンス化して、その中の $actionName メソッドを呼び出す


} catch (Exception $e) {
    var_dump($e->__toString());
    exit();
}
