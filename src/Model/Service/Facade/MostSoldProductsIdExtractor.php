<?php
/**
 * Created by PhpStorm.
 * User: mirza
 * Date: 9/14/18
 * Time: 9:27 AM
 */

namespace Model\Service\Facade;


class MostSoldProductsIdExtractor
{

    public function __construct()
    {
    }


    /**
     * @param array $products
     * @return array
     */
    public function extractIds($products){
        // ids holder
        $ids = [];

        if(!empty($products)){
            // loop through products and extract their ids
            for($i = 0; $i < count($products); $i++){
                $ids[$i] = $products[$i]->id;
            }
        }


        // return ids
        return $ids;
    }
}