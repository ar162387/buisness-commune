<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NewContactRequest;

class ContactController extends Controller
{
    public function index() {


        // $data =[];
        
        $companies = Company::orderBy('name')->pluck('name' , 'id');
        DB::enableQueryLog();
        $contacts = Contact::latest()->where(function ($query)
        {
            if($companyId = request()->query('company_id')) {

                $query->where('company_id' , $companyId);
            }

            if($search = request()->query('search'))
        {
            $query->where("first_name" , "LIKE" , "%{$search}%");
            $query->orWhere("last_name" , "LIKE" , "%{$search}%");
            $query->orWhere("email" , "LIKE" , "%{$search}%");
        }

        })->paginate(10);

        dump(DB::getQueryLog());

        

        // foreach ($companies as $company) {

        //     $data[$company->id] = $company->name . " ( " . $company->contacts()->count() . " ) ";
        // }
    
        return view('contacts.index', [
        "contacts" => $contacts,
        'companies' => $companies
    ]);
        
    }

    public function create() {

        // dd(request()->method());

        $companies = Company::orderBy('name')->pluck('name' , 'id');
        return view("contacts.create" , [
            'companies' => $companies
        ]);
        
    }

    

    public function show($id) {
        
        $contact = Contact::findOrFail($id);

    

        
        return view("contacts.show" )->with('contact' , $contact);
        
    }
    public function store(Request $request) {

        $request->validate([
            'first_name' => ['required' , 'string' , 'max:255'],
            'last_name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'company_id' => ['required' , 'exists:companies,id']
        ]);

        Contact::create($request->all());

        
         return redirect()->route('contacts.index')->with('message' , 'Contact has been added successfully');
    }

    public function update(Request  $request , $id) {

        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'first_name' => ['required' , 'string' , 'max:255'],
            'last_name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'company_id' => ['required' , 'exists:companies,id']
        ]);

        
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message' , 'COntact has been updated succesfully');
        
    }

    function edit($id) {
        $companies = Company::orderBy('name')->pluck('name' , 'id');
        $contact = Contact::findOrFail($id);

        return view('contacts.edit' , [
            'companies' => $companies,
            'contact' => $contact

            
        ]);
        
    }
    function destroy($id) {
        
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('message' , 'COntact has been deleted succesfully');

    }
}
