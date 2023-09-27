const cartItems = {};

function addToCart(productId) {
  const quantityInput = document.querySelector('input[name="' + productId + '"]');
  const quantity = parseInt(quantityInput.value);

  if(quantity > 0) {
    if(cartItems[productId]) {
      // 同じ商品がカートにすでに存在する場合、個数を増やすのではなく、数量を置き換える
      cartItems[productId].quantity = quantity;
    } else {
      // カートに同じ商品がない場合、新しい商品を追加
      cartItems[productId] = {
        quantity: quantity,
      }
    }
    updateCartCount();
  } else {
    alert('数量を選択してください')
  }
}

function updateCartCount() {
  const cartCountElement = document.querySelector('.cart-count');
  cartCountElement.innerText = getCartTotalQuantity();
}

function getCartTotalQuantity() {
  let totalQuantity = 0;
  for (const productId in cartItems) {
    totalQuantity += cartItems[productId].quantity;
  }
  return totalQuantity;
}


$(function() {
  $('.card-title').matchHeight();
});
