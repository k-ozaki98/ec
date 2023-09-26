<?php
  require_once 'lib/products.php';
  require_once 'lib/function.php';

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
<div class="container">
    <div class="app-container">
      <h1 class="title">DailyTrial Shopping</h1>
      <form id="cart" method="POST" action="lib/cart.php">
        <div class="cards-container">
          <?php foreach($products as $product): ?>
          <div class="card">
            <img class="card-image" src="https://dnbz0c2oupsw6.cloudfront.net/bcekt8ctzrsfdj1gsus49v9tnhqu" alt="">
            <p class="card-title"><?php echo $product['name'] ?></p>
            <div class="flex justify-between">
              <p class="card-price"><?php echo displayPrice($product['price']) ?></p>
              <input name="<?php echo $product['id'] ?>" min="0" max="9" class="item-number" type="number" value="0">
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </form>  
      <div class="btn-footer bg-white">
        <input form="cart" class="cart-btn" type="submit" name="submit" value="カートに追加" />
      </div>
    </div>
  </div>
</body>
</html>