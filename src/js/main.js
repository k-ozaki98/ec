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
          if (quantity === 0) {
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

        // カートの数量を更新
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

/**
 * カートの数量を更新する
 */
function updateCartCount() {
  const cartCountElement = document.querySelector('.cart-count');
  cartCountElement.innerText = getCartTotalQuantity();
}

/**
 * カートの数量を取得する
 * @returns {number} カート内の合計数量
 */
function getCartTotalQuantity() {
  let totalQuantity = 0;
  for (const productId in cartItems) {
    totalQuantity += cartItems[productId].quantity;
  }
  return totalQuantity;
}

/**
 * カートの合計金額を更新する
 */
function updateCartTotal() {
  let total = 0;
  for (const productId in cartItems) {
    const product = products.find((p) => p.id === productId);
    if (product) {
      total += product.price * cartItems[productId].quantity;
    }
  }

  // 合計金額を表示する要素を取得して更新
  const totalElement = document.querySelector('.total-price');
  if (totalElement) {
    totalElement.innerHTML = '小計<span class="red-text">' + total + '円</span>';
  }
}

/**
 * カートサイドメニュー内の商品画像を更新する
 * @param {string} productId 商品のID
 */
function updateSideMenu() {
  const sideContents = document.querySelector('.side-contents');

  // クリックイベントを削除
  sideContents.removeEventListener('click', sideMenuClickHandler);

  sideContents.innerHTML = ''; // 既存の内容をクリア

  for (const productId in cartItems) {
    const { product, quantity } = cartItems[productId];

    const buyItem = document.createElement('div');
    buyItem.classList.add('buy-item');

    buyItem.innerHTML = `
      <div class="buy-item-img">
        <img src="${product.image}" alt="${product.name}">
      </div>
      <p class="item-price">価格：${product.price}円</p>
      <div class="item-quantity">
        <input name="${product.id}" data-id="${product.id}" min="0" max="9" class="item-number" type="number" value="${quantity}">
        <button class="update-quantity" data-product-id="${product.id}">決定</button>
      </div>
      <button class="remove-item" name="${productId}">削除</button>
    `;

    sideContents.appendChild(buyItem);

    // カートサイドメニューのクリックイベントリスナーを設定
    buyItem.addEventListener('click', sideMenuClickHandler);
  }
}

function sideMenuClickHandler(event) {
  const target = event.target;

  // 削除ボタンがクリックされた場合
  if (target.classList.contains('remove-item')) {
    const productId = target.name;
    delete cartItems[productId];

    // カートの数量と合計金額を更新
    updateCartCount();
    updateCartTotal();

    const relatedInput = document.querySelector(`input[data-id="${productId}"]`);
    if (relatedInput) {
      relatedInput.value = '0';
    }

    const sideMenuItem = target.closest('.buy-item');
    if (sideMenuItem) {
      sideMenuItem.remove();
    }

    event.stopPropagation();
  }

  // 数量変更ボタンがクリックされた場合
  if (target.classList.contains('decrement') || target.classList.contains('increment')) {
    const productId = target.name;
    const currentValue = parseInt(target.parentElement.querySelector('input').value);

    if (target.classList.contains('decrement')) {
      // 減少ボタンがクリックされた場合
      if (currentValue > 0) {
        target.parentElement.querySelector('input').value = currentValue - 1;
      }
    } else {
      // 増加ボタンがクリックされた場合
      target.parentElement.querySelector('input').value = currentValue + 1;
    }

    // カートアイテムの数量を更新
    cartItems[productId].quantity = parseInt(target.parentElement.querySelector('input').value);

    // カートの数量と合計金額を更新
    updateCartCount();
    updateCartTotal();

    event.stopPropagation();
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



