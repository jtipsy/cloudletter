<h1 align="center"> Cloudletter </h1>

<p align="center"> 基于网易云课堂直播的 PHP SDK</p>

## 依赖

- php >= 7.3
- composer
- guzzle >= 7.4


## 安装

```shell
$ composer require jtipsy/cloudletter:dev-master  #开发版本
$ composer require jtipsy/cloudletter #正式版本
```

## 配置

请先前往 [网易云信开放平台](https://dev.yunxin.163.com/) 注册账号，创建应用，获取应用Api Key、Secret


```shell

 require __DIR__ .'/vendor/autoload.php';

 use Jtipsy\Cloudletter\Netease;

 $appKey = 'xxxxxxxxx';
 $appSecret = 'xxxxxxxxx';
 $appHost = 'https://yiyong-xedu-v2.netease.im/';
 $appAuthorization = 'xxxxxxxxx';
 $uuid = 1;
 $roomName = 'jtipsy的直播间';
 $roomUuid = 1;
 $configId = '7';
 $live = false;
 $rtc = true;
 $chatroom = true;
 $whiteboard = true;

 $netease = new Netease($appKey,$appSecret,$appHost,$appAuthorization);

 // 获取云课堂用户Token
 $token = $netease->createUser($uuid);

 // 创建云课堂房间
 $room = $netease->createRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard);

 // 关闭云课堂房间
 $shut = $netease->shutRoom($roomUuid);

 // 获取回放
 $record = $netease->recordPlayBack($roomUuid,$rtcCid);
 
```

## 在 Laravel 中使用

```shell
 config/services.php 配置如下：
 
 'netease' => [
    'appKey' => env('NETEASE_APP_KEY',NULL),
    'appSecret' => env('NETEASE_APP_SECRET',NULL),
    'appHost' => env('NETEASE_APP_HOST',NULL),
    'appAuthorization' => env('NETEASE_APP_AUTHORIZATION',NULL),
 ],
```
```shell
 .env 配置变量
 
 NETEASE_APP_KEY=1c520fxxxxx4a0b5xxxx
 NETEASE_APP_SECRET=1eb8dxxx29xxx
 NETEASE_APP_HOST=https://yiyong-xedu-v2.netease.im/
 NETEASE_APP_AUTHORIZATION=20fxx8d=xxx
```

## 方法参数注入
```shell
 use Jtipsy\Cloudletter\Netease;
 use Illuminate\Http\Request;
 
 public function getToken(Netease $netease,Request $request)
 {
    $uuid = $request->uuid;
    $roomName = $request->roomName;
    $roomUuid = $request->roomUuid;
    $configId = $request->cinfigId;
    $live = $request->live;
    $rtc = $request->rtc;
    $chatroom = $request->chatroom;
    $whiteboard = $request->whiteboard;
    $rtcCid = $request->rtcCid;
    
    // 获取云课堂用户Token
    $token = $netease->createUser($uuid);
    
    // 创建云课堂房间
    $room = $netease->createRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard);
    
    // 关闭云课堂房间
    $shut = $netease->shutRoom($roomUuid);
    
    // 获取回放
    $record = $netease->recordPlayBack($roomUuid,$rtcCid);
 }
```
## 服务名访问
```shell
 use Illuminate\Http\Request;
 
 public function getToken(Request $request)
 {
    $uuid = $request->uuid;
    $roomName = $request->roomName;
    $roomUuid = $request->roomUuid;
    $configId = $request->cinfigId;
    $live = $request->live;
    $rtc = $request->rtc;
    $chatroom = $request->chatroom;
    $whiteboard = $request->whiteboard;
    $rtcCid = $request->rtcCid;
    
    // 获取云课堂用户Token
    $token = app('netease')->createUser($uuid);
    
    // 创建云课堂房间
    $room = app('netease')->createRoom($roomName,$roomUuid,$configId,$live,$rtc,$chatroom,$whiteboard);
    
    // 关闭云课堂房间
    $shut = app('netease')->shutRoom($roomUuid);
    
    // 获取回放
    $record = app('netease')->recordPlayBack($roomUuid,$rtcCid);
    
 }
```

## 参考

网易云信-云课堂服务端Api文档，请自行联系销售获取

## License

MIT