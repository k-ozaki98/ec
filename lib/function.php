<?php
/**
 * Undocumented function
 *
 * @param [type] $price
 * @return void
 */
  function calPriceIncludedTax($price) {
    $taxRate = 0.1;
    return $price + $price * $taxRate;
  }
  /**
   * Undocumented function
   *
   * @param [type] $price
   * @return void
   */
  function displayPrice($price) {
    $priceIncludedTax = calPriceIncludedTax($price);
    return $priceIncludedTax;
  }
?>