<?php

namespace App\Services;

class FCM{

    public $title;
    public $body;
    public $data=[];
    public $users;

    public function send(){
        
        // $data = array
        // (
        //     'message'   => 'data-1',
        //     'productId' => '632180',
        // );


        $serverKey = config('fcm.server_key');

        $channelId = config('fcm.channel_id');

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $payload = [
            "registration_ids" => $this->users,
            "notification" => [
                "title" => $this->title,
                "body" => $this->body,
                "android_channel_id"=> $channelId,
                "sound"=> "Tri-tone"  
            ],
            'data'=> $this->data,
            'priority'=> 'high'
        ];

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $payload ) );
        $result = curl_exec($ch );
        if ($result === FALSE) 
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );
        return $result;


    }


}