<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        $email = $request->only(['name', 'email', 'subject', 'message']);

        Mail::to('marcos.antonio.duarte.bento@gmail.com')->send(new ContactEmail($email));

        return redirect()->route('home')->with('success', 'Mensagem enviada !');
    }
}
