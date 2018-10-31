<?php
/**
 * Created by PhpStorm.
 * User: mirza
 * Date: 9/10/18
 * Time: 7:55 PM
 */

namespace Model\Service;


use Model\Entity\ResponseBootstrap;
use Model\Mapper\MobileMapper;
use Model\Service\Facade\MostSoldProductsIdExtractor;
use Monolog\Logger;

class MobileService
{

    private $mobileMapper;
    private $configuration;
    private $monolog;

    public function __construct(MobileMapper $mobileMapper)
    {
        $this->mobileMapper = $mobileMapper;
        $this->configuration = $mobileMapper->getConfiguration();
        $this->monolog = new Logger('monolog');
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllData() {
        // create response object
        $response = new ResponseBootstrap();

        // get data
        $allData['products'] = $this->getProducts();
        $allData['tags'] = $this->getTags();
        $allData['most_sold'] = $this->getMostSoldProducts();

       if(!empty($allData)){
            $response->setStatus(200);
            $response->setMessage('Success');
            $response->setData([
                'data' => $allData
            ]);
        }else {
            $response->setStatus(204);
            $response->setMessage('No content');
        }

        // return response
        return $response;
    }


    /**
     * Get all products
     *
     * @return ResponseBootstrap
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProducts() {

        try {
            // create response object
             // $response = new ResponseBootstrap();

            // call MS for data
            $client = new \GuzzleHttp\Client();
            $result = $client->request('GET', $this->configuration['products_url'] . '/products/all', []);
            $products = $result->getBody()->getContents();

            // retirn data
            return json_decode($products);
//            if(!empty($products)){
//                $response->setStatus(200);
//                $response->setMessage('Success');
//                $response->setData([
//                    'data' => json_decode($products)
//                ]);
//            }else {
//                $response->setStatus(204);
//                $response->setMessage('No content');
//            }
//
//            // return response
//            return $response;

        }catch (\Exception $e){
            // write monolog entry
            $this->monolog->addError('Get all products service: ' . $e);
//
//            // set response on failure
//            $response->setStatus(404);
//            $response->setMessage('Invalid data');
//            return $response;
        }

    }


    /**
     * Get all tags
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTags() {

        try {
            // create response object
           // $response = new ResponseBootstrap();

            // call MS for data
            $client = new \GuzzleHttp\Client();
            $result = $client->request('GET', $this->configuration['tags_url'] . '/tags/all', []);
            $tags = $result->getBody()->getContents();

            // return data
            return json_decode($tags);
//            if(!empty($products)){
//                $response->setStatus(200);
//                $response->setMessage('Success');
//                $response->setData([
//                    'data' => json_decode($products)
//                ]);
//            }else {
//                $response->setStatus(204);
//                $response->setMessage('No content');
//            }
//
//            // return response
//            return $response;

        }catch (\Exception $e){
            // write monolog entry
            $this->monolog->addError('Get all tags service: ' . $e);
//            // set response on failure
//            $response->setStatus(404);
//            $response->setMessage('Invalid data');
//            return $response;
        }
    }


    /**
     * Get most sold products
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMostSoldProducts() {

        try {
            // create response object
            // $response = new ResponseBootstrap();

            // call MS for data
            $client = new \GuzzleHttp\Client();
            $result = $client->request('GET', $this->configuration['products_url'] . '/products/mostsold', []);
            $products = $result->getBody()->getContents();

            // extract ids from most sold products
            $extractor = new MostSoldProductsIdExtractor();
            $products = json_decode($products);
            $products = $extractor->extractIds($products);

            // return data
            return $products;
//            if(!empty($products)){
//                $response->setStatus(200);
//                $response->setMessage('Success');
//                $response->setData([
//                    'data' => json_decode($products)
//                ]);
//            }else {
//                $response->setStatus(204);
//                $response->setMessage('No content');
//            }
//
//            // return response
//            return $response;

        }catch (\Exception $e){
            // write monolog entry
            $this->monolog->addError('Get most sold products service: ' . $e);
//            // set response on failure
//            $response->setStatus(404);
//            $response->setMessage('Invalid data');
//            return $response;
        }

    }
}