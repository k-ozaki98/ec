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


function updateCartTotal() {
  let total = 0;
  for(const productId in cartItems) {
    const product = products.find((p) => p.id === productId);
    if(product) {
      total += product.price * cartItems[productId].quantity;
    }
  }

  // 合計金額を表示する要素を取得して更新
  const totalElement = document.querySelector('.total-price');
  totalElement.innerHTML = '小計<span class="red-text">' + total + '円</span>';
}

/**
 * カートサイドメニュー内の商品画像を更新する
 * @param {string} productId 商品のID
 */
function updateSideMenu() {
  const sideMenu = document.querySelector('.side-img');
  sideMenu.innerHTML = '';

  for(const productId in cartItems) {
    console.log(cartItems);
    const product = cartItems[productId].product;
    if(product) {
      const imageElement = document.createElement('img');
      imageElement.src = product.image;
      imageElement.alt = product.name;
      sideMenu.appendChild(imageElement);
    }
  }
}





// ページが読み込まれたときに実行される処理
window.onload = function() {
  // 検索フォームの要素を取得
  var searchInput = document.getElementById('search-query');
  
  // 検索フォームの内容が変更されたときに実行される処理
  searchInput.addEventListener('click', function(event) {
    event.preventDefault();
    // 入力されたテキストを取得
    var searchText = this.value.trim().toLowerCase();
    
    // すべてのカード要素を取得
    var cardElements = document.querySelectorAll('.card');
    
    // 入力が空の場合、すべてのカードを表示
    if (searchText === '') {
      cardElements.forEach(function(card) {
        card.style.display = 'block';
      });
      return;
    }
    
    // カード要素をループして、キーワードにマッチしないものを非表示にする
    cardElements.forEach(function(card) {
      var cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
      if (cardTitle.indexOf(searchText) === -1) {
        card.style.display = 'none';
      } else {
        card.style.display = 'block';
      }
    });
  });
};

document.querySelectorAll('.card-wrap').forEach(function(card) {
  card.addEventListener('click', function() {
    var productId = card.getAttribute('data-id');
    window.location.href = 'lib/detail.php?product_id=' + productId;
  });
});

$(function() {
  $('.card-title').matchHeight();
});
