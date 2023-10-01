export function addToCart(productId) {
    const quantityInput = document.querySelector('input[name="' + productId + '"]');
    const quantity = parseInt(quantityInput.value);
    
    // サーバーサイドのAPIエンドポイントに非同期リクエストを送信
    fetch('/lib/add-to-cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ productId, quantity }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          if (cartItems[productId]) {
            if(quantity === 0) {
              delete cartItems[productId];
            } else {
              // すでにカートに同じ商品がある場合、数量を更新
              cartItems[productId].quantity = quantity;
  
            }
          } else {
            if (quantity > 0) {
              // カートに同じ商品がない場合、新しいエントリを追加
              const product = products.find((p) => p.id === productId);
              cartItems[productId] = { quantity, product };
            }
          }
          
          updateCartCount();
  
          // 合計金額を計算して表示
          updateCartTotal();
  
          updateSideMenu();
  
          const relatedInput = document.querySelector('input[data-id="' + productId + '"]');
          if (relatedInput) {
            relatedInput.value = quantity.toString();
          }
        } else {
          alert('カートの更新に失敗しました01');
        }
      })
      .catch((error) => {
        alert('カートの更新に失敗しました02');
      });
}