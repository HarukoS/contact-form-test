<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;

class AuthController extends Controller
{  
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        $contacts = Contact::Paginate(7);
        
        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->GenderSearch($request->gender)->DateSearch($request->created_at)->Paginate(7)->withQueryString();
        $categories = Category::all();   

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

}
