<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendSms()
    {
        try {
            $sid = 'ACfef2d3b2914362f4ee82888403fc9792';
            $token = '79b9e3d266f2f5c124e1f8439ab0809a';
            $senderNumber = '+18312187371';
            $receiptNumber = '+18777804236';
            $client = new Client($sid, $token);

            $message = $client->messages->create(
                $receiptNumber, // Recipient's number
                [
                    "body" => "Hii ni sms ya test kwajili ya Advance purchase",
                    "from" => $senderNumber
                ]
            );

            return response()->json(['message' => 'SMS sent successfully!', 'sid' => $message->sid]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
