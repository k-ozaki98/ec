<?php

  /**
   * 税金の計算
   *
   * @param [type] $price
   * @return void 商品の金額に税金を含めた金額
   */
  function calPriceIncludedTax($price) {
    $taxRate = 0.1;
    return $price + $price * $taxRate;
  }
  
  /**
   * 商品の価格をフォーマットして表示
   *
   * @param [type] $price 商品の価格
   * @return void フォーマットされた商品の価格
   */
  function displayPrice($price) {
    $priceIncludedTax = calPriceIncludedTax($price);
    return $priceIncludedTax;
  }
?>