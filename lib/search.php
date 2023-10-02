<?php

// $jsonFilePath = '../data.json';


  $jsonContents = file_get_contents('../../data.json');
  $products = json_decode($jsonContents, true);
  if($products === null) {
    die('jsonファイルの読み込みに失敗しました');
  }

  $keyword = isset($_GET['query']) ? $_GET['query'] : '';

  $searchResults = array_filter($products, function($product) use ($keyword){
    return stripos($product['name'], $keyword) !== false;
  });
?>
