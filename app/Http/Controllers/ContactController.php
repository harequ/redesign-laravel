<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Http\Requests\GetInTouchRequest;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
   public function sendEmail(GetInTouchRequest $request) {

   	$data = $request->only('name', 'email');
	   $data['messageLines'] = explode("\n", $request->get('message'));

	   Mail::send('emails.email', $data, function ($message) use ($data) {
			$message->to('inkncode@gmail.com')->subject('Message from inkncode.ru by ' . $data['name']);
	   });

	   return 'success';

   } 
}
