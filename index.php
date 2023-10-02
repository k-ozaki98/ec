<?php
  require_once 'lib/search.php';
  require_once 'lib/function.php';
  require_once 'lib/create-html.php';
  // require_once 'lib/detail.php';

  $jsonFilePath = 'data.json';

  $jsonContents = file_get_contents($jsonFilePath);
  $products = json_decode($jsonContents, true);

  if($products === null) {
    die('jsonファイルの読み込みに失敗しました');
  }

  echo '<script>';
  echo 'const products = ' . json_encode($products) . ';';
  echo '</script>';

  // キーワードを受け取る
  $keyword = isset($_GET['query']) ? $_GET['query'] : '';

  $searchResults = array_filter($products, function ($product) use ($keyword) {
    return stripos($product['name'], $keyword) !== false;
  });


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
<?php
  include 'header.php';
?>
<div class="container">
        <div class="cards-container" id="cards">
          
        <?php foreach ($searchResults as $product): ?>
          <?php echo generateProductCard($product); ?>
        <?php endforeach; ?>
        </div>
  </div>

  <div class="side-menu">
    <!-- 合計金額 -->
    <p class="total-price"></p>
    <div class="side-contents">

    </div>
  </div>

</div>
<?php
  include 'footer.php';
?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js" integrity="sha512-/bOVV1DV1AQXcypckRwsR9ThoCj7FqTV2/0Bm79bL3YSyLkVideFLE3MIZkq1u5t28ke1c0n31WYCOrO01dsUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="src/js/main.js"></script>
</body>
</html>