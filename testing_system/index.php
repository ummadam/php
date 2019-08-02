
<?php
session_start();

$value = 'q1';

if(isset($_SESSION['answers'][0])){
    $value = 'q2';
}
if(isset($_SESSION['answers'][1])){
    $value = 'q3';
}
if(isset($_SESSION['answers'][2])){
    $value = 'q4';
}
if(isset($_SESSION['answers'][3])){
    $value = 'q5';
}
if(isset($_SESSION['answers'][4])){
    echo 'Вы закончили тестирование! И Ваш результат:'.'<br>';
    echo $_SESSION['result'].' балла из 5'; 
    die();
}
$qa = [
'q1' => [
    0 => '1. Логика – это:',
    'a1' => 'наука об умозаключениях и доказательствах;',
    'a2' => 'наука о правилах мышления;',
    'a3' => 'наука о формах и законах мышления;',
    'a4' => 'наука о формах и законах познания.'
],
'q2' => [ 
    0 => '2. Нестрогая дизъюнкция ложна тогда, когда:',
    'a1' => 'все её элементы истинны;',
    'a2' => 'все её элементы ложны;',
    'a3' => 'один её элемент истинен, а остальные – ложны;',
    'a4' => 'один её элемент ложен, а остальные – истинны;'
],
'q3' => [
    0 => ' 3. Сложное суждение: «Посеешь ветер – пожнёшь бурю», – является:',
    'a1' => 'импликацией;',
    'a2' => 'сублимацией',
    'a3' => 'онъюнкцией',
    'a4' => 'изостенцией.'
],
'q4' => [
    0 => '4. Суждение – это:',
    'a1' => 'предложение;',
    'a2' => 'незаконченная мысль;',
    'a3' => 'обобщённое понятие;',
    'a4' => 'форма мышления'
],
'q5' => [
    0 => '5. Данной схеме не соответствует следующая группа понятий:',
    'a1' => 'рыба, хищник, акула;',
    'a2' => 'растение, дерево, сосна;',
    'a3' => 'представитель древней истории, самодержец, Александр Македонский;',
    'a4' => 'русский писатель, знаменитый человек, Лев Николаевич Толстой;'
]
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ТЕСТ</title>
</head>
<body>
Доброе время суток! Начинаем тестирование по предмету "Логика".
<br><br>

    <form action="check.php" method="post">
  <?php  echo $qa["$value"][0]?>
    <br>
    <input type="radio" name="q" value="a1"><?php echo $qa["$value"]['a1'] ?>
    <br>
    <input type="radio" name="q" value="a2"><?php echo $qa["$value"]['a2'] ?>
    <br>
    <input type="radio" name="q" value="a3"><?php echo $qa["$value"]['a3'] ?>
    <br>
    <input type="radio" name="q" value="a4"><?php echo $qa["$value"]['a4'] ?>
    <br>
    <input type="submit" value="Ответить">
    </form>
    <br><br>
Источник: https://intellect.icu/100-testov-po-logike-s-otvetami-5645
</body>
</html>