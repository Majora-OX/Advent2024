<?php

    $input = file("input.txt", 2);
    $boundary["x"] = strlen($input[0]) - 1;
    $boundary["y"] = count($input) - 1;
    $map = [];
    $antiNodes = [];
    $uniqueSymbols = [];

    #Make base map
    foreach($input as $lineIndex=>$line){
        
        $chars = str_split($line,1);
        array_push($map,$chars);
        
        foreach($chars as $char){
            array_push($uniqueSymbols, $char);
        }

    }
    
    $uniqueSymbols = array_unique($uniqueSymbols);

    foreach($uniqueSymbols as $symbol){
        
            if($symbol != "."){
                attennaSearch($symbol);
              # var_dump($antiNodes);
              #  var_dump(count($antiNodes));
            }
    }

    drawMap();
    var_dump($antiNodes);
    var_dump(count($antiNodes));
    
    
    
    function attennaSearch(string $symbol){
        $locations = [];
        GLOBAL $map;

        foreach($map as $rowIndex2=>$row2){
            
            foreach($row2 as $charIndex2=>$char2){
                if($symbol == $char2){
                    array_push($locations,[$rowIndex2,$charIndex2]);
                }

            }

        }
        findAntiNodes($locations);
      
    }

    function findAntiNodes(array $anttenaSpots){
        GLOBAL $map;
        GLOBAL $antiNodes;
        GLOBAL $boundary;

        foreach($anttenaSpots as $spotIndex=>$spot){

            foreach($anttenaSpots AS $targetIndex=>$target){
                
                if($spotIndex == $targetIndex){
                    continue;
                }
                $yDiff = $target[0] - $spot[0];
                $xDiff = $target[1] - $spot[1];

                $antinodePos = [$target[0] + $yDiff, $target[1] + $xDiff];
                #if ($antinodePos[0] == -1) { echo "DEBUG "; var_dump($spot,$target);}
                $NOOB = $antinodePos[0] <= $boundary["y"] && $antinodePos[0] >= 0 && $antinodePos[1] <= $boundary["x"] && $antinodePos[1] >= 0;
                var_dump($antinodePos);
                echo " OOB: $NOOB\n";
                if (!array_search($antinodePos,$antiNodes) && $NOOB){
                    array_push($antiNodes,$antinodePos);
                }  

            }

        }

    }

    function drawMap(){
        GLOBAL $map;
        GLOBAL $antiNodes;

        foreach($map as $rowIndex=>$row){
            foreach($row as $charIndex=>$char){
               if(array_search([$rowIndex,$charIndex],$antiNodes)){
                echo "#";
               }
               else{
                echo ".";
               }
                
            }
            echo "\n";
        }

    }