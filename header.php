<header class="header">
  <div class="header-nav">
    <div class="header-nav__logo"><img src="src/images/common/logo.png" alt=""></div>
    <p class="header-nav__text"><span>こんにちは</span>お届け先を選択</p>
    <div class="header-nav__search">
      <form action="" method="GET">
          <select name="" id="search">   
            <option value="すべて">すべて</option>
            <option value="カテゴリー01">カテゴリー01</option>
            <option value="カテゴリー02">カテゴリー02</option>
            <option value="カテゴリー03">カテゴリー03</option>
            <option value="カテゴリー04">カテゴリー04</option>
            <option value="カテゴリー05">カテゴリー05</option>
            <option value="カテゴリー06">カテゴリー06</option>
            <option value="カテゴリー07">カテゴリー07</option>
            <option value="カテゴリー08">カテゴリー08</option>
            <option value="カテゴリー09">カテゴリー09</option>
          </select>
          <input type="text" placeholder="検索 Amazon.co.jp" name="query" id="search-query" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES); ?>">
          <input type="submit" value="検索" class="search-icon">
        </form>
    </div>
    <div class="header-nav__lang">JP</div>
    <p class="header-nav__login">
      <span>こんにちは、ログイン</span>アカウント＆リスト
    </p>
    <p class="header-nav__history">
      <span>返品もこちら</span>注文履歴
    </p>
    <div class="header-nav__cart">
      <div class="header-nav__count">
        <span class="cart-count">0</span>
        <span class="cart-icon"></span>
      </div>
      <p class="header-nav__cart-text">カート</p>
    </div>
  </div>
</header>
