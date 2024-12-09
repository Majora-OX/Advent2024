<?php

    $input = file("input.txt", 2);
    $map = []; 
    $boundary["x"] = strlen($input[0]) - 1;
    $boundary["y"] = count($input) - 1;
    $guardPos = null;
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
        $echoY = $targetSpot["y"];
        $echoX = $targetSpot["x"];
        $echoGY = $guardPos[0];
        $echoGX = $guardPos[1];
        
   
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
            
            
            if($map[$push1][$push2] != "#"){
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
            }
        }
            # var_dump($visitedSpots);
            # $count += 1;
            $guardPos[0] = $targetSpot["y"];
            $guardPos[1] = $targetSpot["x"];
        }
    


    } while($completed == false);

    
    foreach($map as $index=>$line){
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
    }
    #echo "Map\n";
echo "\033[01;31m"; echo count($visitedSpots);
#$fp = fopen('vardump.txt', 'w');
#var_dump($visitedSpots);
#fwrite($fp, serialize($visitedSpots));
#fclose($fp);
   # var_dump($map[69]);
    #var_dump($map);
    #var_dump($startingPos);
    #var_dump($boundary);