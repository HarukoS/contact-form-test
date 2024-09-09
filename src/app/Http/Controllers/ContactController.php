<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $categories = Category::all();        
        return view('confirm', compact('contact','categories'));
    }

    public function store(Request $request)
    {
        $contact = $request->only('category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail');
        Contact::create($contact);
        return view('thanks');
    }

}
