<?php

    $input1 = file("example.txt", 2);
    $xmasCount = 0;

    foreach ($input1 as $index=>$line)
    {
       $input1[$index] = str_split($input1[$index],1);
    }
    foreach ($input1 as $lineIndex=>$line)
    {
        $positionChanges = [-11,-10,-9,9,10,11];
        foreach ($line as $charIndex=>$character)
        {
            if($character != "X"){
                continue;
            }
            else{
                #echo "\nFound X";
                lookonCurrentLine($lineIndex,$charIndex, "M");  
               # echo "Line: $lineIndex character: $charIndex\n";
                lookonDifferentLine($lineIndex,$charIndex,"M");
            }
        }

    }

    function lookonCurrentLine($lineNum,$position,$target)
    {
        #Check if next character is on the same line as current character
        global $input1;
        global $xmasCount;
        if(isset($input1[$lineNum][$position + 1]) && $input1[$lineNum][$position + 1] == $target)
        {
            switch($target):
                case "M":
                    lookonCurrentLine($lineNum,$position + 1,"A");
                    break;
                case "A":
                    lookonCurrentLine($lineNum,$position + 1,"S");
                    break;
                case "S":
                $xmasCount += 1;
                    break;
            endswitch;
            
        }
        if(isset($input1[$lineNum][$position - 1]) && $input1[$lineNum][$position - 1] == $target){
            switch($target):
                case "M":
                    lookonCurrentLine($lineNum,$position - 1,"A");
                    break;
                case "A":
                    lookonCurrentLine($lineNum,$position - 1,"S");
                    break;
                case "S":
                $xmasCount += 1;
                    break;
            endswitch;
        }


    }

    function lookonDifferentLine($lineIndex,$charIndex, $target)
    {
        global $input1;
        global $xmasCount;
        #Get the line above and below
          
          $topLine = isset($input1[$lineIndex - 1]) ? $input1[$lineIndex - 1] : null;
          $bottomLine = isset($input1[$lineIndex + 1]) ? $input1[$lineIndex + 1] : null;
     
        if ($topLine != null)
        {
            if(isset($topLine[$charIndex - 1]) && $topLine[$charIndex - 1] == $target){
                checkDiagonal();
            }
            if($topLine[$charIndex] == $target){
                checkVertical($lineIndex - 1, $charIndex, 'A',true);
            }
            if(isset($topLine[$charIndex + 1]) && $topLine[$charIndex + 1] == $target){
                checkDiagonal();
            }
        }
        if ($bottomLine != null)
        {
          #  echo var_dump($bottomLine);
            if(isset($bottomLine[$charIndex - 1]) && $bottomLine[$charIndex - 1] == $target){
                checkDiagonal();
            }
            if($bottomLine[$charIndex] == $target){
                checkVertical($lineIndex + 1, $charIndex, 'A',false);
            }
            if(isset($bottomLine[$charIndex + 1]) && $bottomLine[$charIndex + 1] == $target){
                checkDiagonal();
            }
        }
        
        

    }

    function checkDiagonal($lineIndex,$charIndex, $target, $goingup = null, $goingLeft = null)
    {
        

    }

    function checkVertical($lineIndex,$charIndex,$target,$goingup = null){
        global $input1;
        global $xmasCount;
 
        if($goingup){
            if(isset($input1[$lineIndex-1][$charIndex]) && $input1[$lineIndex-1][$charIndex] == $target){
               if($target == 'A'){
                checkVertical($lineIndex-1,$charIndex,"S",true);
               }
               elseif($target == 'S'){
              
                $xmasCount += 1;
                echo $xmasCount;
                echo "\n";
               } 
            }
        }
        else{
            if(isset($input1[$lineIndex+1][$charIndex]) && $input1[$lineIndex+1][$charIndex] == $target){
          
                if($target == 'A'){
                 checkVertical($lineIndex+1,$charIndex,"S",false);
                }
                elseif($target == 'S'){
                   
                 $xmasCount += 1;
                 echo $xmasCount;
                 echo "\n";
                } 
             }
        }
        
    }

echo $xmasCount;
#var_dump($input1);