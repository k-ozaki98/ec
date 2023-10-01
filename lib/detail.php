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
    $product = $products[$productId - 1];
    $imagePath = '../' . $product['image'];

    echo 'Product ID: ' . $productId;

    $detail = '<div class="product-wrap">
  <div class="product-img">
    <img src="' . $imagePath . '" alt="' . $product['name'] . '">
  </div>
  <div class="product-text">
    <h2>' . $product['name'] . '</h2>
    <div class="product-rating">';
    
  $rating = $product['rating'];
  for ($i = 0; $i < 5; $i++) {
  if ($i < $rating) {
    $detail .= '<span class="star-filled">&#9733;</span>'; // 星アイコン（塗りつぶし）
  } else {
    $detail .= '<span class="star-empty">&#9733;</span>'; // 星アイコン（空）
  }
  }

  $detail .= '</div>
    <p class="product-price">価格：¥' . $product['price'] . '円</p>
    <p class="product-intro">商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。商品説明が入ります。</p>
  </div>
</div>';

    
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

<?php
  include '../header.php';
?>
  <div class="detail-inner">
    <?php
      echo $detail;
    ?>
  </div>

  <div class="side-menu">
    <!-- 合計金額 -->
    <p class="total-price"></p>
    <div class="side-contents">

    </div>
  </div>

  <?php
    include '../footer.php';
  ?>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../src/js/main.js"></script>
</body>
</html>
