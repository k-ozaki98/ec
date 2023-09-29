<?php
// JSONデータを読み込む
$jsonContents = file_get_contents('data.json');
$products = json_decode($jsonContents, true);

if ($products === null) {
    die('JSONファイルの読み込みに失敗しました');
}

// キーワードを受け取る
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// 商品リストをキーワードでフィルタリング
$searchResults = array_filter($products, function ($product) use ($keyword) {
    // 商品名にキーワードが含まれるかどうかをチェック
    return stripos($product['name'], $keyword) !== false;
});

// 検索結果をJSON形式で返す
header('Content-Type: application/json');
echo json_encode(array_values($searchResults));
?>
