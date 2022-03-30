<?php
/**
 * Created by PhpStorm.
 * User: jtipsy
 * Date: 2022/3/25
 * Time: 19:05
 */

namespace Jtipsy\Cloudletter\Interfaces;


interface NeteaseInterface
{
    public function createUser($uuid);

    public function createRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard);

    public function shutRoom($roomUuid);

    public function snapshotRoom($roomUuid,$token,$user);

    public function recordPlayBack($roomUuid,$rtcCid);

}