<?php

$input1 = file("input1.txt", 2);
$input2 = file("input2.txt", 2);
sort($input1);

$similarityScores = [];

#var_dump(count($matchingArray));
foreach ($input1 as $list1num)
{
    $matchingArray = array_keys($input2, $list1num);
    $count = 0;
    $count = $list1num * count($matchingArray);
  
    if(!array_key_exists($list1num, $similarityScores))
    {
        $similarityScores[$list1num] = $count;
    }
    else
    {
        $similarityScores[$list1num] += $count;
    }
    
    
}
$total = 0;
foreach ($similarityScores as $num)
{
$total += $num;
}
var_dump($total);
