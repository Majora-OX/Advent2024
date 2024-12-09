<?php

    $rulesRaw = file("rulesInput.txt", 2);
    $rulesFormatted = [];
    $updates = file("updatesInput.txt", 2);
    $total = 0;
    $incorrectUpdates = [];
    $correctedUpdates = [];

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
               
                        }
                       

                    }
                    if (!$valid){ 
                        break; 
                    }
                }
        }
        if(!$valid) {
            array_push($incorrectUpdates,$update);
        }

    }

    foreach($incorrectUpdates as $update){
        $pages = explode(",",$update);
        
        restart:
        
        foreach($pages as $index=>$page){
            #check if this is an invalid page in the update
            if(isset($rulesFormatted[$page])){
                    
                foreach($rulesFormatted[$page] as $laterPage){
                    $search = array_search($laterPage,$pages);
                    if($search !== false){
                        if($search < $index){
                            array_splice($pages,$index,1);
                            array_splice($pages,$search,1,array($page,$laterPage));
                    
                            goto restart;
                        }
                    }
             
                }

            }
          
        }
        
        $total += $pages[(count($pages) - 1) / 2];
        echo "$total\n";

    }


    echo $total;