const cartItems = {};
/**
 * カートに商品を追加する関数
 * @param {string} productId 追加する商品のID
 */
function addToCart(productId) {
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
          if (quantity === 0) {
            // カートから商品を削除
            delete cartItems[productId];
          } else {
            // カートの数量を更新
            cartItems[productId] = { quantity };
          }
          updateCartCount();
        } else {
          alert('カートの更新に失敗しました');
        }
      })
      .catch((error) => {
        console.error('エラー:', error);
        alert('カートの更新に失敗しました');
      });
}





/**
 * カートの数量を更新する
 */
function updateCartCount() {
  const cartCountElement = document.querySelector('.cart-count');
  cartCountElement.innerText = getCartTotalQuantity();
}

/**
 * カートの数量を取得する
 * @returns {number} カート内の合計
 */
function getCartTotalQuantity() {
  let totalQuantity = 0;
  for (const productId in cartItems) {
    totalQuantity += cartItems[productId].quantity;
  }
  return totalQuantity;
}

$(document).ready(function() {
  function keyword() {
    let name_input = $('name').val();
    let data = {
      name: name_input
    }
    $.ajax({
      url: '../../lib/search.php',
      type: 'POST',
      data: data,
      timespan: 5000
    }).done(function (data) {
      $('#cards').empty();
      // JSONを読み込む
      let search_word = JSON.parse(data || 'null');
      // 入力ワードがあれば
      if(search_word.length != 0) {
        for(let i = 0; i < search_word.length; i++) {
          $('.card .card-title').text(search_word[i]).prependTo('#cards');
        }
      } else {
        $('#cards').text('一致する商品はございません');
      }
    }).fail(function() {
    });
  }
  $('.card .card-title').keyup(function() {
    keyword();
  });
});
// https://qiita.com/yushimasu/items/693c19cae7d62d8911c3


$(function() {
  $('.card-title').matchHeight();
});
