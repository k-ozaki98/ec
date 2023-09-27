<?php
  // require_once 'lib/products.php';
  require_once 'lib/function.php';

  $jsonFilePath = 'data.json';

  $jsonContents = file_get_contents($jsonFilePath);
  $products = json_decode($jsonContents, true);

  if($products === null) {
    die('jsonファイルの読み込みに失敗しました');
  }

  

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ECサイト</title>
  <link rel="stylesheet" href="src/style/style.css">
</head>
<body>
<header class="header">
  <div class="header-nav">
    <div class="header-nav__logo"><img src="src/images/common/logo.png" alt=""></div>
    <p class="header-nav__text"><span>こんにちは</span>お届け先を選択</p>
    <div class="header-nav__search">
      <select name="" id="search">
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
      <input type="text" placeholder="検索 Amazon.co.jp">
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
<div class="container">
      <!-- <form id="cart" method="POST" action="lib/cart.php"> -->
        <div class="cards-container">
        <?php foreach ($products as $product): ?>
          <?php
          $productName = $product['name'];
          $maxLength = 70;
          
          if (mb_strlen($productName, 'UTF-8') > $maxLength) {
              $productName = mb_substr($productName, 0, $maxLength, 'UTF-8').'...';
          }
          
          ?>
            <div class="card">
              <div class="card-image">
                <img src="<?php echo $product['image'] ?>" alt="">
              </div>
              <p class="card-title"><?php echo $productName ?></p>
              <p class="card-price"><?php echo displayPrice($product['price']) ?></p>
              <input name="<?php echo $product['id'] ?>" min="0" max="9" class="item-number" type="number" value="0">
              <button class="cart-button" onclick="addToCart('<?php echo $product['id'] ?>')">カートに追加</button>
            </div>
          <?php endforeach; ?>
        </div>
      <!-- </form>   -->
      <!-- <div class="btn-footer bg-white">
        <input form="cart" class="cart-btn" type="submit" name="submit" value="カートに追加" />
      </div> -->
  </div>
  <script src="src/js/main.js"></script>
</body>
</html>