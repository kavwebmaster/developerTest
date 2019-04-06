<?php
/**
 * Created by PhpStorm.
 * User: kav.webmaster
 * Date: 06/04/2019
 * Time: 18:43
 */

namespace Project\Helpers;


use Bitrix\Main\Web\HttpClient;

class RssHelper
{
    public static function getLentaNews()
    {
        $client = new HttpClient();
        $client->get('https://lenta.ru/rss');

        $xmlOb = new \SimpleXMLElement($client->getResult());

        $result = [];
        foreach ($xmlOb->channel->item as $item) {
            $result[] = $item;
        }
        return $result;
    }
}