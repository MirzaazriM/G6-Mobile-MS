<?php
/**
 * Created by PhpStorm.
 * User: mirza
 * Date: 9/10/18
 * Time: 7:56 PM
 */

namespace Model\Mapper;

use Component\DataMapper;

class MobileMapper extends DataMapper
{

    public function getConfiguration(){
        return $this->configuration;
    }
}