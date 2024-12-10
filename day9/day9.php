<?php

    $input = file("example.txt", 2);
    $rawDisk = str_split($input[0],1);
    $blocks = [];

    $blockID = 0;
    foreach($rawDisk as $diskIndex=>$diskChar){

        if (is_int($diskIndex / 2)){
            for ($x = 1; $x <= $diskChar; $x++)
            {
                array_push($blocks,$blockID);
            }
            $blockID++;
        }
        else{
            for ($x = 1; $x <= $diskChar; $x++)
            {
                array_push($blocks,".");
            }
        }

    }
    var_dump($blocks);
    DrawBlocks($blocks);
    sortBlocks($blocks);



    function sortBlocks($sortedBlocks){
        

        do{

        }while(array_search(".",$sortedBlocks));

    }

    function DrawBlocks($blocks){
        foreach($blocks as $block){
            echo $block;
        }
    }
    