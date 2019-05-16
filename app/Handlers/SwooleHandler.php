<?php
namespace App\Handlers;

use Swoole\Websocket\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use SwooleTW\Http\Server\Facades\Server;
use SwooleTW\Http\Websocket\HandlerContract;

class SwooleHandler implements HandlerContract
{
    public function onOpen($fd, $request)
    {

    }

    public function onMessage($frame)
    {
        $user_id = $frame->data;
        $fd = LRedis::hGet('FRONT_USERS', $user_id);
        echo "client - {$fd} is send\n";
        $num = Message::query()->where('user_id', $user_id)->count();
        $ws->push($fd, $num);
    }

    public function onClose($fd, $reactorId)
    {
        echo "client - {$fd} is closed\n";
        $all = LRedis::hGetAll('FRONT_USERS');
        foreach ($all as $key => $val) {
            if ($fd == LRedis::hGet('FRONT_USERS', $key)) {
                LRedis::hDel('FRONT_USERS', $key);
                echo "del {$key}\n";
            }
        }
    }
}
