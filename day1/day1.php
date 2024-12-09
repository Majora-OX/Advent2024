<?php
use Phalcon\Di\Di;

$input1 = file("input1.txt", 2);
$input2 = file("input2.txt", 2);
sort($input1);
sort($input2);
$differences = [];

        foreach ($input1 as $index=>$input)
        {
            $number2 = null;
            $difference = null;

            $number2 = $input2[$index];
          # echo "$input $index \n";
            $difference =  $input - $number2;
            $difference = $difference < 0 ? $difference * -1 : $difference;
            
            array_push($differences, $difference);
        
        }
        $total = 0;
        
        foreach ($differences as $item)
        {
            $test = $item < 0;
            echo "$item $test";
            echo "\n";
            $total += $item;
        }
echo $total;


   /* foreach ($input1 as $index=>$input){
        $input1[$index] = [$input,$index];  
    }


    foreach ($input2 as $index=>$input){
        $input2[$index] = [$input,$index];  
    }

    
    foreach ($input1 as $input)
    { 
        echo implode(",", $input);
        echo "\n";
    } */



/*foreach ($input2 as $input){
    echo $input;
}

*/