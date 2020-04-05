<?php


namespace App\Http\Controllers;


class MailSendController extends Controller
{
    public function emailSend()
    {
        return view('emails.orders.shipped');
    }
}
