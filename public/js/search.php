<?php

$search = $_POST['search'];
$search = up_letter(addslashes(htmlspecialchars(stripslashes(trim($search)))));

if($search == '') exit();
$db = new SQLite3('E:\MyOpenServer\OSPanel\domains\kursi\database\database.sqlite');
$result = $db->query("SELECT name, alias FROM current_cities WHERE name LIKE '{$search}%'");
$array = [];
while($data = $result->fetchArray(SQLITE3_ASSOC)) $array[] = $data;

if ($array == []) { echo '<pre>Такого города нет</pre>'; exit();}

echo '<div class="row col-md-12">
      <h2 style="color: #000000;">
      <strong>&nbsp&nbsp&nbsp'.mb_substr(trim($search), 0, 1, 'UTF-8').'</strong></h2></div>';

foreach($array as $item){
    echo '<a style="color: #676a6d; font-size: large;" href = "http://sureswap/'.$item['alias'].'"> '.$item['name'].' </a>';
}

function up_letter($string, $encoding = 'UTF-8'){
    return mb_strtoupper(mb_substr(trim($string), 0, 1, $encoding), $encoding) . mb_substr(trim($string), 1, null, $encoding);
}