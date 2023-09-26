
  <?php
  // セッションの開始
  session_start();
  
  // カートがセッションに存在しない場合、新しいカートを作成
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }
  
  // リクエストの受け取り
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId']) && isset($_POST['quantity'])) {
      $productId = $_POST['productId'];
      $quantity = $_POST['quantity'];
  
      // 商品情報をデータベースや商品リストから取得（適切な方法で取得する必要があります）
      $product = getProductById($productId);
  
      if ($product) {
          // カートに商品を追加
          $_SESSION['cart'][$productId] = [
              'name' => $product['name'],
              'price' => $product['price'],
              'quantity' => $quantity,
          ];
  
          // カート内の合計数量を計算
          $totalQuantity = calculateTotalQuantity($_SESSION['cart']);
  
          // カートの状態をJSONで返す
          echo json_encode(['totalQuantity' => $totalQuantity]);
          exit;
      }
  }
  
  // 商品情報を取得する関数（実際のデータソースから取得する必要があります）
  function getProductById($productId) {
      // ここでデータベースから商品情報を取得するなどの処理を行う
      // 仮の商品データを返す例:
      $products = [
          '1' => ['name' => '商品1', 'price' => 10],
          '2' => ['name' => '商品2', 'price' => 20],
          // 他の商品情報
      ];
  
      return isset($products[$productId]) ? $products[$productId] : null;
  }
  
  // カート内の合計数量を計算する関数
  function calculateTotalQuantity($cart) {
      $totalQuantity = 0;
      foreach ($cart as $item) {
          $totalQuantity += $item['quantity'];
      }
      return $totalQuantity;
  }
  ?>
  