<?php

     $input = file("input.txt", 2);
     $testNumbers = [];
     $totalResult = 0;
     foreach($input as $line){
     preg_match('/[0-9]+:/',$line, $matches);
     preg_match('/[0-9]+/',$matches[0], $NumberOnly1);
     $num1 = $NumberOnly1[0];

     preg_match('/ .*/',$line, $matches);
     preg_match('/[0-9].*/',$matches[0], $NumberOnly2);
     $num2 = explode(" ", $NumberOnly2[0]);

     $subtractNum = 1;
     $operatorsNumber = (count($num2) - 1);
     $combinations = pow(2, $operatorsNumber);
     $loopcombinations = strlen(decbin($combinations - 1));
     
     do {
        $calculatedNumber = 0;
        $operatorBits = sprintf("%0".$loopcombinations."b",$combinations - 1); #decbin($combinations - 1);
        $bitsArray = str_split($operatorBits,1);
        foreach($num2 as $index=>$number){
           
            if($index == 0){
                $calculatedNumber += $number;
            }
            else{
                if($bitsArray[$index - 1 ] == "0"){
                    $calculatedNumber += $number;
                    }
                    elseif($bitsArray[$index - 1] == "1"){
                    $calculatedNumber *= $number;
                    }

            }
        }          
        if($calculatedNumber == $num1){
            echo "$num1\n";
            $totalResult += $num1;
            $combinations = 1;
        }
        $combinations -= 1;
     } while($combinations > 0);
    }
    echo "$totalResult\n";
