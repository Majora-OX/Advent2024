<?php

    $input = file("input.txt", 2);
    $map = []; 
    $noncompletedSpots = [];
    $boundary["x"] = strlen($input[0]) - 1;
    $boundary["y"] = count($input) - 1;
    $guardPos = null;
    $OGguardPos = null;
    $visitedSpots = [];
    enum Direction{
        case UP;
        case RIGHT;
        case DOWN;
        case LEFT;
    }
    $guard = null;
    foreach($input as $lineIndex=>$line){
       $chars = str_split($line,1);
        foreach($chars as $charIndex=>$char){
            if($char == "^"){
                $guardPos = [$lineIndex,$charIndex];
                $OGguardPos = [$lineIndex,$charIndex];
                array_push($visitedSpots,"$lineIndex,$charIndex");
                echo "$guardPos[0] $guardPos[1]\n";
                $chars[$charIndex] = "^";
                $guard = Direction::UP;
            }
     
            
        }
        array_push($map,$chars);
    }

    $completed = false;
  $debug = 0;
    do {


        $targetSpot["x"] = null;
        $targetSpot["y"] = null;
        $OOB = false;
        $blocked = false;
    
        switch($guard):
            case Direction::UP:
                $targetSpot["y"] = $guardPos[0] - 1;
                $targetSpot["x"] = $guardPos[1];
                break;
            case Direction::RIGHT:
                $targetSpot["y"] = $guardPos[0];
                $targetSpot["x"] = $guardPos[1] + 1;
                break;
            case Direction::DOWN:
                $targetSpot["y"] = $guardPos[0] + 1;
                $targetSpot["x"] = $guardPos[1];
                break;
            case Direction::LEFT:
                $targetSpot["y"] = $guardPos[0];
                $targetSpot["x"] = $guardPos[1] - 1;
                break;
        endswitch;
   
        $completed = $targetSpot["y"] < 0 || $targetSpot["y"] > $boundary["y"] || $targetSpot["x"] < 0 || $targetSpot["x"] > $boundary["x"] ? true : false;
        $blocked = $map[$targetSpot["y"]][$targetSpot["x"]] == "#" ? true : false;
    
        if($blocked){
            switch($guard):
                case Direction::UP:
                    $guard = Direction::RIGHT;
                    break;
                case Direction::RIGHT:
                    $guard = Direction::DOWN;
                    break;
                case Direction::DOWN:
                    $guard = Direction::LEFT;
                    break;
                case Direction::LEFT:
                    $guard = Direction::UP;
                    break;
            endswitch;
        }
        else{
            $push1 = $targetSpot["y"];
            $push2 = $targetSpot["x"];

            if(!array_search("$push1,$push2",$visitedSpots) && array_search("$push1,$push2",$visitedSpots) !== 0 && !$completed){
                array_push($visitedSpots,"$push1,$push2");
            
            
           /* if($map[$push1][$push2] != "#"){
                switch($guard):
                    case Direction::UP:
                        $map[$push1][$push2] = "^";
                        break;
                    case Direction::RIGHT:
                        $map[$push1][$push2] = ">";
                        break;
                    case Direction::DOWN:
                        $map[$push1][$push2] = "⌄";
                        break;
                    case Direction::LEFT:
                        $map[$push1][$push2] = "<";
                        break;
                endswitch;
            } */
        }
            $guardPos[0] = $targetSpot["y"];
            $guardPos[1] = $targetSpot["x"];
        }
    


    } while($completed == false);

    
  /*  foreach($map as $index=>$line){
        foreach($line as $charIndex=>$char){
            if($char != "." && $char != "#")
            {
                $arrayIndex = array_search("$index,$charIndex",$visitedSpots);
                $arrayIndex = substr($arrayIndex, -1);
                
                switch($arrayIndex):
                    case 0:
                      echo  "\033[0;31m$char\033[0m";
                        break;
                        case 1:
                            echo  "\033[0;33m$char\033[0m";
                              break;
                              case 2:
                                echo  "\033[1;33m$char\033[0m";
                                  break;
                                  case 3:
                                    echo  "\033[1;32m$char\033[0m";
                                      break;
                                      case 4:
                                        echo  "\033[0;32m$char\033[0m";
                                          break;
                                          case 5:
                                            echo  "\033[1;34m$char\033[0m";
                                              break;
                                              case 6:
                                                echo  "\033[0;34m$char\033[0m";
                                                  break;
                                                  case 7:
                                                    echo  "\033[0;35m$char\033[0m";
                                                      break;
                                                      case 8:
                                                        echo  "\033[1;35m$char\033[0m";
                                                          break;
                                                          case 9:
                                                            echo  "\033[1;31m$char\033[0m";
                                                              break;

                endswitch;
            }
            else {  echo $char; } 
        
        }
        echo " Line $index\n";
    }*/
 
#echo "\033[01;31m"; echo count($visitedSpots);
    $obstructCount = 0;    
    $modifiedMap = [];
   # $fD = file_get_contents('cutSpotsList.txt');
   # var_dump($fD);
    $visitedSpots3 = unserialize(file_get_contents("cutSpotsList.txt"));
   var_dump($visitedSpots);
    foreach($visitedSpots3 as $index=>$visitedSpot){
        if($index == 0){
            #sleep(3);
            continue;
        }
        
        $guardPos = $OGguardPos;
        $guard = Direction::UP;
        $spotToObstruct = explode(',', $visitedSpot);
        $completed = false;
        $loops = 0;
        $modifiedMap = $map;
        $modifiedMap[$spotToObstruct[0]][$spotToObstruct[1]] = "O";
        $visitedSpots2 = [];
        do {


            $targetSpot["x"] = null;
            $targetSpot["y"] = null;
            $OOB = false;
            $blocked = false;
            $loopBlocked = false;
            switch($guard):
                case Direction::UP:
                    $targetSpot["y"] = $guardPos[0] - 1;
                    $targetSpot["x"] = $guardPos[1];
                    break;
                case Direction::RIGHT:
                    $targetSpot["y"] = $guardPos[0];
                    $targetSpot["x"] = $guardPos[1] + 1;
                    break;
                case Direction::DOWN:
                    $targetSpot["y"] = $guardPos[0] + 1;
                    $targetSpot["x"] = $guardPos[1];
                    break;
                case Direction::LEFT:
                    $targetSpot["y"] = $guardPos[0];
                    $targetSpot["x"] = $guardPos[1] - 1;
                    break;
            endswitch;
          
           
            $completed = $targetSpot["y"] < 0 || $targetSpot["y"] > $boundary["y"] || $targetSpot["x"] < 0 || $targetSpot["x"] > $boundary["x"] ? true : false;
     
            if (!$completed){
            $blocked = $modifiedMap[$targetSpot["y"]][$targetSpot["x"]] == "#" ? true : false;
            $loopBlocked = $modifiedMap[$targetSpot["y"]][$targetSpot["x"]] == "O" ? true : false;
            }
         #   echo "Completeted $completed Pos: $guardPos[0] $guardPos[1] Blocked: $blocked LoopBlocked: $loopBlocked\n";
          #  var_dump($guardPos);
         #   var_dump($targetSpot);
            if($blocked || $loopBlocked){
                switch($guard):
                    case Direction::UP:
                        $guard = Direction::RIGHT;
                        break;
                    case Direction::RIGHT:
                        $guard = Direction::DOWN;
                        break;
                    case Direction::DOWN:
                        $guard = Direction::LEFT;
                        break;
                    case Direction::LEFT:
                        $guard = Direction::UP;
                        break;
                endswitch;
               
                    $loops += 1;
                 
                
            }
            else{
               /* $push1 = $targetSpot["y"];
                $push2 = $targetSpot["x"];
    
                if(!array_search("$push1,$push2",$visitedSpots2) && array_search("$push1,$push2",$visitedSpots2) !== 0 && !$completed){
                    array_push($visitedSpots2,"$push1,$push2");
                
                
                if($modifiedMap[$push1][$push2] != "#" && $modifiedMap[$push1][$push2] != "O"){
                    switch($guard):
                        case Direction::UP:
                            $modifiedMap[$push1][$push2] = "^";
                            break;
                        case Direction::RIGHT:
                            $modifiedMap[$push1][$push2] = ">";
                            break;
                        case Direction::DOWN:
                            $modifiedMap[$push1][$push2] = "⌄";
                            break;
                        case Direction::LEFT:
                            $modifiedMap[$push1][$push2] = "<";
                            break;
                    endswitch;
                }
            }*/
                $guardPos[0] = $targetSpot["y"];
                $guardPos[1] = $targetSpot["x"];
            }
        
            echo "Visited spot: $index Loop $loops Blocked: $blocked LoopBlocked: $loopBlocked\n";
        } while(!$completed && $loops <= 500);  
        
      /*  foreach($modifiedMap as $index=>$line){
            foreach($line as $charIndex=>$char){
                if($char != "." && $char != "#" && $char != "O")
                {
                    $arrayIndex = array_search("$index,$charIndex",$visitedSpots);
                    $arrayIndex = substr($arrayIndex, -1);
                    
                    switch($arrayIndex):
                        case 0:
                          echo  "\033[0;31m$char\033[0m";
                            break;
                            case 1:
                                echo  "\033[0;33m$char\033[0m";
                                  break;
                                  case 2:
                                    echo  "\033[1;33m$char\033[0m";
                                      break;
                                      case 3:
                                        echo  "\033[1;32m$char\033[0m";
                                          break;
                                          case 4:
                                            echo  "\033[0;32m$char\033[0m";
                                              break;
                                              case 5:
                                                echo  "\033[1;34m$char\033[0m";
                                                  break;
                                                  case 6:
                                                    echo  "\033[0;34m$char\033[0m";
                                                      break;
                                                      case 7:
                                                        echo  "\033[0;35m$char\033[0m";
                                                          break;
                                                          case 8:
                                                            echo  "\033[1;35m$char\033[0m";
                                                              break;
                                                              case 9:
                                                                echo  "\033[1;31m$char\033[0m";
                                                                  break;
    
                    endswitch;
                }
                else {  echo $char; } 
            
            }
            echo " Line $index\n";
        } */
     #   echo "Not a loop: $completed\n\n";

        
        if(!$completed){
            array_push($noncompletedSpots,$visitedSpot);
            $obstructCount += 1;
        }
     #   var_dump($visitedSpots2);
      #echo "Visited spot: $index\n";
    }
    echo $obstructCount;

    $fp = fopen('cutSpotsList.txt', 'w');
    fwrite($fp, serialize($noncompletedSpots));
    fclose($fp);

