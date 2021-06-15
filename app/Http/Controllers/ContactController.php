<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function saveNew(Request $request)
    {
        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Contact Inserted.',
            'alert-type'=> 'success'
        );
        return redirect()->route('index.contact')->with($notification);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        Contact::find($id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Contact Updated.',
            'alert-type'=> 'success'
        );
        return redirect()->route('index.contact')->with($notification);
    }

    public function delete($id)
    {
        Contact::find($id)->Delete();

        $notification=array(
            'message'=>'Contact Deleted.',
            'alert-type'=> 'error'
        );
        return redirect()->back()->with($notification);

    }

    public function viewContact()
    {
        $contactDetails = Contact::latest()->first();
        return view('pages.contact.index', compact('contactDetails'));
    }

    public function contactMessage(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Message Sent.',
            'alert-type'=> 'success'
        );
        return redirect()->route('contact')->with($notification);
    }

    public function message()
    {
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function deleteMessage($id)
    {
        ContactForm::find($id)->Delete();

        $notification=array(
            'message'=>'Message Deleted.',
            'alert-type'=> 'error'
        );
        return redirect()->back()->with($notification);

    }

}
