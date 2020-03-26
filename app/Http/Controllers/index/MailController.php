<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendCodemail;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    public function send_email(){
        Mail::to('328435440@qq.com')->send(new OrderShipped());
    }
}
