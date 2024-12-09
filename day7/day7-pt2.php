<?php

    $input = file("input.txt", 2);
    $testNumbers = [];
    $totalResult = 0;
    enum Operator{
        case ADD;
        case MULTIPLY;
        case CONCAT;
        }
    
    foreach($input as $lineIndex=>$line){
        preg_match('/[0-9]+:/',$line, $matches);
        preg_match('/[0-9]+/',$matches[0], $NumberOnly1);
        $num1 = $NumberOnly1[0];

        preg_match('/ .*/',$line, $matches);
        preg_match('/[0-9].*/',$matches[0], $NumberOnly2);
        $num2 = explode(" ", $NumberOnly2[0]);
        
        $formattedNum2 = [];
        foreach($num2 as $index=>$number){
            array_push($formattedNum2,$number);
            if($index < count($num2) - 1){
            array_push($formattedNum2,Operator::ADD);
            }
     }
     
     $combinations = count($num2) == 2 ? 3 : pow(3,count($num2) - 1);
     do {
        $calculatedNumber = 0;
        foreach($formattedNum2 as $index=>$number){
            
            if($index == 0){
                $calculatedNumber += $number;
            }
            elseif($number instanceof \UnitEnum){
                continue;
            }
            else{

                switch($formattedNum2[$index - 1]):
                    case Operator::ADD:
                        $calculatedNumber += $number;
                        break;
                    case Operator::MULTIPLY:
                        $calculatedNumber *= $number;
                        break;
                    case OPERATOR::CONCAT:
                        $calculatedNumber = $calculatedNumber.$number;
                        break;
                    endswitch;
            }

        }

        $lastOPIndex = count($formattedNum2) - 2;
        $adjusted = false;
        do{
            if($lastOPIndex > 0){
            switch($formattedNum2[$lastOPIndex]):
                case Operator::ADD:
                    $formattedNum2[$lastOPIndex] = Operator::MULTIPLY;
                    $adjusted = true;
                    break;
                case Operator::MULTIPLY:
                    $formattedNum2[$lastOPIndex] = Operator::CONCAT;
                    $adjusted = true;
                    break;
                case OPERATOR::CONCAT:
                    $formattedNum2[$lastOPIndex] = Operator::ADD;
                    $lastOPIndex -= 2;
                    break;
                endswitch;
            }
            else {$adjusted = true;}
        } while(!$adjusted);
       
        if($calculatedNumber == $num1){
            $totalResult += $num1;
            $combinations = 1;
        }
        $combinations -= 1;

     } while($combinations > 0);
     if($calculatedNumber != $num1){
       
     }
     echo "Line: $lineIndex\n";
    }
    var_dump($totalResult);
