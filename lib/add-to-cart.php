<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // リクエストデータの取得
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['productId'];
    $quantity = $data['quantity'];

    // カートの更新処理（例：セッションを使用）
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if ($quantity === 0) {
        // 数量が0の場合、カートから商品を削除
        unset($_SESSION['cart'][$productId]);
    } else {
        // 数量が0でない場合、カートに商品を追加または更新
        $_SESSION['cart'][$productId] = $quantity;
    }

    // レスポンスの生成
    $response = [
        'success' => true,
        // 他のカートの情報を追加
    ];

    // レスポンスをJSON形式で返す
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // 不正なリクエスト
    http_response_code(400); // バッドリクエスト
    echo json_encode(['error' => 'Bad Request']);
}

?>
