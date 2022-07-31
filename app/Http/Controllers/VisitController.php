<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        Visit::insert([
            'domain' => $data['domain'] ?? '-',
            'refer' => $data['refer'] ?? '-',
            'ip_address' => $this->getClientIp(),
            'click_type' => $data['click_type'] ?? 0,
            'date' => date('Y-m-d'),
            'created_at' => now()
        ]);
        return response()->json([
            'code' => 0,
            'msg' => 'success'
        ]);
    }

    protected function getClientIp()
    {
        $ip = "unknown";
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            //这个提到最前面，作为优先级,nginx代理会获取到用户真实ip,发在这个环境变量上，必须要nginx配置这个环境变量HTTP_X_FORWARDED_FOR
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR")) {
            //在nginx作为反向代理的架构中，使用REMOTE_ADDR拿到的将会是反向代理的的ip，即拿到是nginx服务器的ip地址。往往表现是一个内网ip。
            $ip = getenv("REMOTE_ADDR");
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else if (getenv("HTTP_CLIENT_IP")) {
            //HTTP_CLIENT_IP攻击者可以伪造一个这样的头部信息，导致获取的是攻击者随意设置的ip地址。
            $ip = getenv("HTTP_CLIENT_IP");
        }
        if (strpos($ip, ',') !== false) {
            $arr = array_filter(explode(',', $ip));
            if (count($arr) > 1) {
                $ip = trim($arr[count($arr) - 2]);
            } else {
                $ip = trim($arr[0]);
            }
        }
        return $ip;
    }
}
