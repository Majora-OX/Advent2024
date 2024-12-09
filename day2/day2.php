<?php

$input1 = file("input1.txt", 2);
$safeNumbers = [3,2,1,-1,-2,-3];
$safereports = 0;

foreach($input1 as $input)
{
    $damper = false;
    $levels = explode(" ", $input);
    $prevNum = null;
    $desc = null;
    $safe = true;
    foreach ($levels as $index=>$level)
    {
        switch($index)
        {
            case 0:
                
                break;
            case 1:
                $difference = $prevNum - $level;
                $safe = in_array($difference,$safeNumbers);
                $desc = $level < $prevNum ? true : false;
                
              
             
                break;
            default:
      
                $difference = $prevNum - $level;
                $safe = $desc ? in_array($difference,$safeNumbers) && $level < $prevNum : in_array($difference,$safeNumbers) && $level > $prevNum ;
              
                if(!$safe && $desc && $level > $prevNum)
                {
                    $reason = "Swapped to ASC";
                    $desc = $level < $levels[$index + 1] ? false : true;
                }
                elseif (!$safe && !$desc && $level < $prevNum)
                {   
                    $reason = "Swapped to DESC";
                    $desc = $level < $levels[$index + 1] ? false : true;
                }
                elseif(!$safe)
                {
                    $reason = $difference == 0 ? "duplicate" : "Difference higher than 4";
                }
                
                
                break;
        }
        #$dump = #var_dump($index,$safe,$damper);
      #  echo "$level PrevNum: $prevNum safe $safe DESC? $desc\n";
        if($safe == false && $damper == true){ 
           $died = $index + 1;
        #   echo "$input INDEX: $died\n";
            break; 
        }
        elseif ($safe == false && $damper == false) { 
            $prevNum = $level;
            $safe = true; 
            $damper = true;
        }
        else {  
            $prevNum = $level;
        }
      
    }
    $bool = $damper ? 'true' : 'false';
    if ($safe == true) {$safereports += 1;} else { 
       echo "$input $reason $died\n";
    }
}
echo $safereports;