<?php

    $input1 = file("input1.txt", 2);
    $xmasCount = 0;
    set_error_handler("beSilent", E_WARNING);
    foreach ($input1 as $index=>$line)
    {
       $input1[$index] = str_split($input1[$index],1);
    }
    foreach ($input1 as $lineIndex=>$line)
    {
  
        $positionChanges = [-1,0,1];
        foreach ($line as $charIndex=>$character)
        {
            if($character == "X"){
                foreach ($positionChanges as $adjust){
                 
                    #Lines above
                    if(isset($input1[$lineIndex - 1][$charIndex + $adjust])){
                        if ($input1[$lineIndex - 1][$charIndex + $adjust] == 'M')
                        {
                            switch($adjust):
                                case -1:
                                    if(isset($input1[$lineIndex - 2][$charIndex - 2]) && $input1[$lineIndex - 2][$charIndex - 2] == 'A'){
                                        $xmasCount += $input1[$lineIndex - 3][$charIndex - 3] == "S" ? 1 : 0;
                                       
                                    }
                                    break;
                                case 0:
                                    if($input1[$lineIndex - 2][$charIndex] == "A"){
                                        $xmasCount += $input1[$lineIndex - 3][$charIndex] == "S" ? 1 : 0;
                                       
                                    }
                                    break;
                                case 1:
                                    if($input1[$lineIndex - 2][$charIndex + 2] == 'A'){
                                        $xmasCount += $input1[$lineIndex - 3][$charIndex + 3] == "S" ? 1 : 0;
                                       
                                    }
                                    break;
                                endswitch;
                        }
                    }

                    #linesBelow
                    if ($input1[$lineIndex + 1][$charIndex + $adjust] == 'M')
                    {
                        switch($adjust):
                            case -1:
                                if($input1[$lineIndex + 2][$charIndex - 2] == 'A'){
                                    $xmasCount += $input1[$lineIndex + 3][$charIndex - 3] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            case 0:
                                if($input1[$lineIndex + 2][$charIndex] == "A"){
                                    $xmasCount += $input1[$lineIndex + 3][$charIndex] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            case 1:
                                if($input1[$lineIndex + 2][$charIndex + 2] == 'A'){
                                    $xmasCount += $input1[$lineIndex + 3][$charIndex + 3] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            endswitch;
                    }

                    #CurrentLine
                    if ($input1[$lineIndex][$charIndex + $adjust] == 'M')
                    {
                        switch($adjust):
                            case -1:
                                if($input1[$lineIndex][$charIndex - 2] == 'A'){
                                    $xmasCount += $input1[$lineIndex][$charIndex - 3] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            case 0:
                                if($input1[$lineIndex][$charIndex] == "A"){
                                    $xmasCount += $input1[$lineIndex][$charIndex] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            case 1:
                                if($input1[$lineIndex][$charIndex + 2] == 'A'){
                                    $xmasCount += $input1[$lineIndex][$charIndex + 3] == "S" ? 1 : 0;
                                   
                                }
                                break;
                            endswitch;
                    }


                }
            }
        }

    }

echo $xmasCount;




function beSilent($errno, $errstr, $errfile, $errline)
{

# echo "Error no: $errno Error String $errstr Error File $errfile Line $errline\n";
}


  