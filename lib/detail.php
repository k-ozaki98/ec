<?php
  include_once 'function.php';

  $productId = isset($_GET['product_id']) ? $_GET['product_id'] : null;
  // echo 'Product ID: ' . $productId;

  // var_dump($productId);


  $jsonFilePath = '../data.json';
  $jsonContents = file_get_contents($jsonFilePath);
  if ($jsonContents === false) {
    die('JSONファイルの読み込みに失敗しました');
  }
  $products = json_decode($jsonContents, true);

  if ($products === null) {
    die('JSONデータのデコードに失敗しました');
  }

  // $productId を整数に変換
  $productId = (int)$productId;

  // var_dump($products);

  // 商品IDを使用して詳細情報を取得
  // var_dump($products);
  if (isset($products) && isset($products[$productId])) {
    $product = $products[$productId];


    $imagePath = '../' . $product['image'];

    $detail = <<< EOM
    <div class="product-wrap">
      <div class="product-img">
        <img src="{$imagePath}" alt="{$product['name']}">
      </div>
      <div class="product-text">
        <h2>{$product['name']}</h2>
        <p>価格：¥{number_format(displayPrice({$product['price']}))}円</p>
      </div>
    </div>
    EOM;

    
  } else {
    echo '商品が見つかりません。商品ID: ' . $productId;
  }
  
?> 

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>商品詳細ページ</title>
  <link rel="stylesheet" href="../src/style/style.css">
</head>
<body>

<header class="header">
  <div class="header-nav">
    <div class="header-nav__logo"><img src="src/images/common/logo.png" alt=""></div>
    <p class="header-nav__text"><span>こんにちは</span>お届け先を選択</p>
    <div class="header-nav__search">
        <select name="" id="search">   
          <option value="すべて">すべて</option>
          <option value="カテゴリー01">カテゴリー01</option>
          <option value="カテゴリー02">カテゴリー02</option>
          <option value="カテゴリー03">カテゴリー03</option>
          <option value="カテゴリー04">カテゴリー04</option>
          <option value="カテゴリー05">カテゴリー05</option>
          <option value="カテゴリー06">カテゴリー06</option>
          <option value="カテゴリー07">カテゴリー07</option>
          <option value="カテゴリー08">カテゴリー08</option>
          <option value="カテゴリー09">カテゴリー09</option>
        </select>
        <form action="" method="GET">
          <input type="text" placeholder="検索 Amazon.co.jp" name="query" id="search-query" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES); ?>">
          <input type="submit" value="検索" class="search-icon">
        </form>

    </div>
    <div class="header-nav__lang">JP</div>
    <p class="header-nav__login">
      <span>こんにちは、ログイン</span>アカウント＆リスト
    </p>
    <p class="header-nav__history">
      <span>返品もこちら</span>注文履歴
    </p>
    <div class="header-nav__cart">
      <div class="header-nav__count">
        <span class="cart-count">0</span>
        <span class="cart-icon"></span>
      </div>
      <p class="header-nav__cart-text">カート</p>
    </div>
  </div>
</header>
  <div class="detail-inner">
    <?php
      echo $detail;
    ?>
  </div>

  
</body>
</html>
