<?php
namespace console\controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use console\components\SocketServer;
use Yii;

class SocketController extends \yii\console\Controller
{
    public function actionStartSocket($port = 8080)
    {
        //Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer()
                )
            ),
            $port
        );
        $server->run();
    }
}