<?php

namespace Project\Helpers;

use Bitrix\Main\Data\Cache;
use Bitrix\Main\Loader;

class IblockElementHelper {

    public static function test()
    {
        Debug::dump('sdfs');
    }


    public static function getCachedList( array $params, int $ttl = 3600, callable $callback = null)
    {
        if(empty($params['filter'])){
            throw new \Exception('Фильтр обязателен');
        }

        Loader::includeModule('iblock');

        $cacheId = serialize([$params, $ttl]);
        if(is_callable($callback)){
            $cacheId .= '_with_callback';
        }
        $cache = Cache::createInstance();

        if ($cache->initCache($ttl, $cacheId)){
            $result = $cache->getVars();
        }
        elseif ($cache->startDataCache()) {

            $res = \CIBlockElement::GetList(
                $params['sort']?:['ID' => 'ASC'],
                $params['filter'],
                $params['group']?:false,
                $params['nav']?:false,
                $params['select']?:[]
            );
            $result = [];
            while ($arr = $res->GetNext()){

                $arr = is_callable($callback)?$callback($arr):$arr;
                if($arr){
                    $result[] = $arr;
                }
            }
            $cache->endDataCache($result);
        }
        return $result;
    }
}