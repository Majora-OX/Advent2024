<?php

    $input1 = file("input1.txt", 2);
    $xmasCount = 0;
    set_error_handler("beSilent", E_WARNING);
    foreach ($input1 as $index=>$line)
    {
       $input1[$index] = str_split($input1[$index],1);
    }
    $positionChanges = [-1,1];
    foreach ($input1 as $lineIndex=>$line)
    {
  
        
        foreach ($line as $charIndex=>$character)
        {$crossCount = 0;
            if($character == "A"){
                foreach ($positionChanges as $adjust){
                # echo "LINE: $lineIndex Position $charIndex";
                    #Lines above
                    if(isset($input1[$lineIndex - 1][$charIndex + $adjust])){
                        if ($input1[$lineIndex - 1][$charIndex + $adjust] == 'M')
                        {
                            switch($adjust):
                                case -1:
                                        $crossCount += $input1[$lineIndex + 1][$charIndex + 1] == "S" ? 1 : 0;               
                                    break;
                                case 0:
                              
                                    break;
                                case 1:
                                    $crossCount += $input1[$lineIndex + 1][$charIndex - 1] == "S" ? 1 : 0;     
                                    break;
                                endswitch;
                        }
                    }

                    #linesBelow
                    if(isset($input1[$lineIndex + 1][$charIndex + $adjust])){
                        if ($input1[$lineIndex + 1][$charIndex + $adjust] == 'M')
                        {
                            switch($adjust):
                                case -1:
                                        $crossCount += $input1[$lineIndex - 1][$charIndex + 1] == "S" ? 1 : 0;               
                                    break;
                                case 0:
                              
                                    break;
                                case 1:
                                    $crossCount += $input1[$lineIndex - 1][$charIndex - 1] == "S" ? 1 : 0;     
                                    break;
                                endswitch;
                        }
                    }
                    
                }
                    $xmasCount += $crossCount == 2 ? 1 : 0;
                    echo " XMAS count: $xmasCount\n";
            }
        }

    }

echo $xmasCount;




function beSilent($errno, $errstr, $errfile, $errline)
{

# echo "Error no: $errno Error String $errstr Error File $errfile Line $errline\n";
}


  