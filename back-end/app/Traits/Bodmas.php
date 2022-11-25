<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


trait Bodmas{

    protected function evaluate($str){
        $count = 0;
    preg_match_all("/\([^\^(\)]*\)/", $str, $matches);
    foreach($matches[0] as $key=>$value){
        $value = str_replace(["(",")"], ["",""], $value);
        $eq = bodmas($value,$count,false);
        $count++;
        eval("\$result = $value;");
        $str = str_replace("($value)", $result, $str);
        $results[$i] = $eq;
        $i++;
    }
    $results = $this->bodmas($str,$count,true);
    return $results;
    }

        protected function bodmas($eq,$count,$op){
                $i = 0;
                $results[$i] = $eq;
                $i++;
                foreach (['*','/','+','-'] as $key => $symbol) {
                    preg_match_all("!\d+(\.\d+)?\\$symbol\d+(\.\d+)?!", $eq, $matches);
                    if(count($matches[0])){
                        foreach ($matches[0] as $key2 => $match) {
                            $count++;
                            eval("\$result = $match;");
                            $eq = str_replace($match, $result, $eq);
                            if($op){
                               $results[$i] = $eq;
                               $i++;
                            }
                            $this->singleton($eq,$count);
                        }
                    }
                }
            return $results;
        }

        protected function singleton($str,$count){
            preg_match_all("/\(\d+(\.\d+)?\)/", $str, $matches);
            if(count($matches[0])){
            foreach($matches[0] as $key=>$value){
                $str = str_replace(["(",")"], ["",""], $str);
            }
            bodmas($str,$count,true);
            }
         }

}