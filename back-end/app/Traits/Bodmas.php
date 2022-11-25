<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


trait Bodmas{

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
                            singleton($eq,$count);
                        }
                    }
                }
            return $results;
        }

}