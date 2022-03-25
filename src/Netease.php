<?php
/**
 * Created by PhpStorm.
 * User: jtipsy
 * Date: 2022/3/25
 * Time: 18:59
 */

namespace Jtipsy\Cloudletter;

use Jtipsy\Cloudletter\YunXin\YunXin;
use Jtipsy\Cloudletter\Interfaces\NeteaseInterface;
use Jtipsy\Cloudletter\Exceptions\InvalidArgumentException;

class Netease extends YunXin implements NeteaseInterface
{
    protected $appKey;
    protected $appSecret;
    protected $appHost;
    protected $appAuthorization;

    public function __construct(string $appKey, string $appSecret, string $appHost, string $appAuthorization)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->appHost = $appHost;
        $this->appAuthorization = $appAuthorization;
        $this->getConfig([
            'appKey'=>$this->appKey,
            'appSecret'=>$this->appSecret,
            'appHost'=>$this->appHost,
            'appAuthorization'=>$this->appAuthorization
        ]);
    }

    public function createUser($uuid)
    {
        if(!$uuid){
            throw new InvalidArgumentException('Check whether the parameters are configured');
        }
        return $this->addUser($uuid);
    }

    public function createRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard)
    {
        if(!$roomName && !$roomUuid && !$configId){
            throw new InvalidArgumentException('Check whether the parameters are configured');
        }
        return $this->addRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard);
    }

    public function shutRoom($roomUuid)
    {
        if(!$roomUuid){
            throw new InvalidArgumentException('Check whether the parameters are configured');
        }
        return $this->roomShut($roomUuid);
    }

    public function recordPlayBack($roomUuid,$rtcCid)
    {
        if(!$roomUuid && !$rtcCid){
            throw new InvalidArgumentException('Check whether the parameters are configured');
        }
        return $this->playBack($roomUuid,$rtcCid);
    }

}