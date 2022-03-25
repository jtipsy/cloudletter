<?php
/**
 * Created by PhpStorm.
 * User: jtipsy
 * Date: 2022/3/25
 * Time: 19:00
 */

namespace Jtipsy\Cloudletter\YunXin;

class YunXin extends Base
{
    protected $config = [];

    /*
     * 配置信息
     * @param string appKey
     * @param string appSecret
     * @param string appHost
     * @param string appAuthorization
     * @return array
     */
    public function getConfig($config)
    {
        return $this->config = $config;
    }

    /*
     * 创建用户
     * @param int uid
     * @return mixed
     */
    public function addUser(string $uuid)
    {
        $url = $this->config['appHost'].'apps/'.$this->config['appKey'].'/v1/users/'.$uuid;
        $param = [
            'userToken' => $this->nonce(),
        ];
        return $this->httpPut($url,$param,$this->headers('application/json;charset=utf-8'));
    }

    /*
     * 创建房间
     * @param string roomName
     * @param int roomUuid
     * @param int configId
     * @param boolean config.resource.live
     * @param boolean config.resource.rtc
     * @param boolean config.resource.chatroom
     * @param boolean config.resource.whiteboard
     * @return mixed
     */
    public function addRoom(string $roomName, string $roomUuid, int $configId, bool $live, bool $rtc, bool $chatroom, bool $whiteboard)
    {
        $url = $this->config['appHost'].'apps/'.$this->config['appKey'].'/v1/rooms/'.$roomUuid;
        $param = [
            'roomName' => $roomName,
            'roomUuid' => $roomUuid,
            'configId' => $configId,
            'config.resource.live' => $live,
            'config.resource.rtc' => $rtc,
            'config.resource.chatroom' => $chatroom,
            'config.resource.whiteboard' => $whiteboard,
        ];
        return $this->httpPut($url,$param,$this->headers('application/json;charset=utf-8'));
    }

    /*
     * 关闭房间
     * @param string roomUuid
     * @return mixed
     */
    public function roomShut(string $roomUuid)
    {
        $url = $this->config['appHost'].'apps/'.$this->config['appKey'].'/v1/rooms/'.$roomUuid;
        return $this->httpDelete($url,[],$this->headers('application/json;charset=utf-8'));
    }

    /*
     * 获取回放
     * @param string roomUuid
     * @param string rtcCid
     * @return mixed
     */
    public function playBack(string $roomUuid, string $rtcCid)
    {
        $url = $this->config['appHost'].'scene/apps/'.$this->config['appKey'].'/v1/rooms/'.$roomUuid.'/'.$rtcCid.'/record/playback';
        return $this->httpGet($url,[],$this->authHeaders('application/json;charset=utf-8'));
    }

    /*
     * 随机字符
     * @return string
     */
    protected function nonce()
    {
        return (string)(md5(time()));
    }

    /*
     * 时间戳
     * @return string
     */
    protected function curTime()
    {
        return (string)(time());
    }

    /*
     * 校验
     * @return string
     */
    protected function checkSum(){
        return (string)(sha1($this->config['appSecret'] . $this->nonce() . $this->curTime()));
    }

    /*
     * 设备标识
     * @return string
     */
    protected function uuid(){
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /*
     * 公共请求头
     * @param string contentType
     * @return array
     */
    protected function headers(string $contentType)
    {
        return [
            'AppKey'       => $this->config['appKey'],
            'Nonce'        => $this->nonce(),
            'CurTime'      => $this->curTime(),
            'CheckSum'     => $this->checkSum(),
            'Content-Type' => $contentType,
        ];
    }

    /*
     * 认证请求头
     * @param string contentType
     * @return array
     */
    protected function authHeaders(string $contentType)
    {
        return [
            'Content-Type' => $contentType,
            'Authorization' => 'Basic '.$this->config['appAuthorization'],
            'deviceId' => $this->uuid(),
        ];
    }


}