<?php
/**
 * Created by PhpStorm.
 * User: mirza
 * Date: 9/10/18
 * Time: 7:55 PM
 */

namespace Application\Controller;


use Model\Entity\ResponseBootstrap;
use Model\Service\MobileService;
use Symfony\Component\HttpFoundation\Request;

class MobileController
{
    private $mobileService;

    public function __construct(MobileService $mobileService)
    {
        $this->mobileService = $mobileService;
    }


    /**
     * @return ResponseBootstrap
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData():ResponseBootstrap {

        return $this->mobileService->getAllData();
    }


//    /**
//     * Get products
//     *
//     * @param Request $request
//     * @return ResponseBootstrap
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     */
//    public function getProducts(Request $request):ResponseBootstrap
//    {
//        // call service for data
//        return $this->mobileService->getProducts();
//    }
//
//
//    /**
//     * @return ResponseBootstrap
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     */
//    public function getTags():ResponseBootstrap {
//        // call service for data
//        return $this->mobileService->getTags();
//    }
//
//
//    /**
//     * @return ResponseBootstrap
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     */
//    public function getMostsold():ResponseBootstrap {
//        // call service for data
//        return $this->mobileService->getMostSoldProducts();
//    }
}