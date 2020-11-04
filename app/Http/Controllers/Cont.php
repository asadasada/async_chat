<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \ZMQContext;
use \ZMQ;
class Cont extends Controller
{

    //Requestの処理
    public function ret_post(Request $request){
//3項演算子は他では少し違うので注意する
        $text = $request->get("text")?:"nashi";
        $name = $request->get("name")?:"nanashi";

        session(['name' => $name]);
        $request->session()->push('texts', $text);

        $values['name'] = $request->session()->get('name');
        $values['ip'] = substr(md5($_SERVER["REMOTE_ADDR"]),0,8);
        $values['vars'] = $request->session()->get('texts',function(){return ["GIGE"];});

        $entryData = array(
            'name'=>$values['name'],
            'ip'=>$values['ip'],
            'vars'=>$values['vars']
        );
    $context = new \ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
    $socket->connect("tcp://localhost:9102");

    $socket->send(json_encode($entryData));
       /*
        */
        // return view('chat_kun',compact('values'));
        return compact('values');
/*
return values["name"=>"name","vars"=>['vars',...]]
*/
    }
}
