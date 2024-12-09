<?php

$input1 = file_get_contents("input1.txt", 2);
$total = 0;
preg_match_all('/mul\([0-9]+,[0-9]+\)/', $input1, $matches);
foreach($matches[0] as $match)
{
  
   preg_match('/mul\([0-9]+,/',$match, $num1);
   preg_match('/,[0-9]+\)/', $match, $num2); 
   
   preg_match('/[0-9]+/',$num1[0], $num1);
   preg_match('/[0-9]+/',$num2[0], $num2);
   echo "$num1[0] $num2[0]\n";

   $total += $num1[0] * $num2[0]; 

}
echo $total;
