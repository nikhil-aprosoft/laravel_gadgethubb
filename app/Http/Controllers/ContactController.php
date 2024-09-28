<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        return view('website.contact-us'); 
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email'=> 'required|string|email|max:200',
            'desc' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with('status', implode(' ', $errors))->with('status_type', 'error');
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'desc' => $request->desc,
        ]);

        return redirect('/')->with('status', 'Your query send successfully.We will replay you in our working hours')->with('status_type', 'success');
    }
}
