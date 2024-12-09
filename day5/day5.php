<?php

    $rulesRaw = file("rulesInput.txt", 2);
    $rulesFormatted = [];
    $updates = file("updatesInput.txt", 2);
    $total = 0;
    foreach($rulesRaw as $index=>$rule)
    {
        $separated = explode("|",$rule);
            if(!isset($rulesFormatted[$separated[0]])) { 
                $rulesFormatted[$separated[0]] = []; 
            }
        
            array_push($rulesFormatted[$separated[0]], $separated[1]);
    }

    foreach($updates as $update){
        $valid = true;
        $pages = explode(",", $update);

        foreach($pages as $index=>$page){
                if(isset($rulesFormatted[$page])){
                    
                    foreach($rulesFormatted[$page] as $laterPage){
                        $search = array_search($laterPage,$pages);
                        if($search !== false){
                          $valid = $search > $index;
                          #echo "$search > $index \n";
                        }
                        #echo "index $index Page $page Later page $laterPage Search $search Valid $valid\n";

                    }
                    if (!$valid){ 
                        break; 
                    }
                }
        }
        if($valid) {$count = $pages[(count($pages) - 1) / 2]; echo "Count: $count Update $update\n";}
        $total += $valid ? $pages[(count($pages) - 1) / 2] : 0;

    }
    echo $total;