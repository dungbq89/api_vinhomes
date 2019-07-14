<?php
//require_once( '../lib/vendor/SolrPHPClient/Apache/Solr/Service.php' );
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SolrHelper {
    
    public static function getConfig(){
        $config = array(
            'adapteroptions' => array(
                'host' => 'localhost',
                'port' => 8083,
                'path' => '/solr/vtp',
            )
        );;
        
//        $config = array(
//            'adapteroptions' => array(
//                'host' => '10.58.50.19',
//                'port' => 8083,
//                'path' => '/solr/db',
//            )
//        );
//        $config = array(
//            'adapteroptions' => array(
//                'host' => '10.58.50.30',
//                'port' => 8080,
//                'path' => '/solr/db',
//            )
//        );
//        $config = array(
//            'adapteroptions' => array(
//                'host' => '10.58.71.157',
//                'port' => 8983,
//                'path' => '/solr/db',
//            )
//        );
        return $config;
    }
    
    public static function searchSolr($filterQueries,$limit = 3){
//        echo $filterQueries;die;
        $config = self::getConfig();
        $client = new Solarium_Client($config);
//        $client->setAdapter('Solarium_Client_Adapter_Curl');
        $query = $client->createSelect();
        $query->setQuery($filterQueries);
        $query->setRows($limit);        

        $resultset = $client->select($query);
        $data = array();
        foreach ($resultset as $document) {
            
        $data['full_items'][] = $document;
        }
        return $data;
    }
    
    
    
    public static function searchSolrFull($filterQueries, $pageLimit = 1, $pageNumber = 1){
//        echo $filterQueries;die;
        $config = self::getConfig();
        $client = new Solarium_Client($config);
//        $client->setAdapter('Solarium_Client_Adapter_Curl');
        $query = $client->createSelect();
        
        //khanhnq16 test boost
//        $edismax = $query->getDisMax();
//        $edismax->setQueryParser('edismax');
//        $edismax->setBoostQuery('huawei_tone_code:555*^1.0');
        
        
        //endboots
        $query->setQuery($filterQueries);
        $query->setRows($pageLimit*$pageNumber);
        $resultset = $client->select($query);
        $data = array();
//        var_dump($resultset);die;
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }
}
