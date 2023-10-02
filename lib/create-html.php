<?php
function generateProductCard($product) {
    $productName = $product['name'];
    $maxLength = 70;

    if (mb_strlen($productName, 'UTF-8') > $maxLength) {
        $productName = mb_substr($productName, 0, $maxLength, 'UTF-8').'...';
    }

    $productCardHTML = <<<HTML
    <div class="card">
      <div class="card-wrap" data-id="{$product['id']}">
        <div class="card-image">
          <img src="{$product['image']}" alt="">
        </div>
        <p class="card-title">{$productName}</p>
      </div>
      <div class="product-rating">
    HTML;

    $rating = $product['rating'];
    for ($i = 0; $i < 5; $i++) {
        if ($i < $rating) {
            $productCardHTML .= '<span class="star-filled">&#9733;</span>'; // 星アイコン（塗りつぶし）
        } else {
            $productCardHTML .= '<span class="star-empty">&#9733;</span>'; // 星アイコン（空）
        }
    }

    $productCardHTML .= <<<HTML
  </div>
  <p class="card-price">{$product['price']}円</p>
  <input name="{$product['id']}" data-id="{$product['id']}" min="0" max="9" class="item-number" type="number" value="0">
  <button class="cart-button" onclick="addToCart('{$product['id']}')">カートに追加</button>
</div>
HTML;

    return $productCardHTML;
}
?>
