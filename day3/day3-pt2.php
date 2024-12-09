<?php

    $input1 = file_get_contents("input1.txt", 2);
    $total = 0;
    preg_match_all('/(mul\([0-9]+,[0-9]+\))|(don\'t\(\))|(do\(\))/', $input1, $matches);
    $do = true;

    foreach($matches[0] as $match)
    {

        if ($match == "do()")
        {
            $do = true;
        }
        elseif ($match == "don't()")
        {
            $do = false;
        }
        elseif ($do)
        {
            preg_match('/mul\([0-9]+,/',$match, $num1);
            preg_match('/,[0-9]+\)/', $match, $num2); 
            
            preg_match('/[0-9]+/',$num1[0], $num1);
            preg_match('/[0-9]+/',$num2[0], $num2);

            $total += $num1[0] * $num2[0]; 
        }
    } 
    echo $total;
