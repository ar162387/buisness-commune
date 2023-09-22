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
        //DB::enableQueryLog();
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

        //dump(DB::getQueryLog());

        

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

    

    public function show(Contact $contact) {
        
        

    

        
        return view("contacts.show" )->with('contact' , $contact);
        
    }
    public function store(NewContactRequest $request) {

       

        Contact::create($request->all());

        
         return redirect()->route('contacts.index')->with('message' , 'Contact has been added successfully');
    }

    public function update(NewContactRequest  $request , Contact $contact) {

        
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message' , 'COntact has been updated succesfully');
        
    }

    function edit(Contact $contact) {
        $companies = Company::orderBy('name')->pluck('name' , 'id');
        

        return view('contacts.edit' , [
            'companies' => $companies,
            'contact' => $contact

            
        ]);
        
    }
    function destroy($id) {
        
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')
        ->with('message' , 'Contact has been moved to trash');

    }
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return back()
            ->with('message', 'Contact has been restored from trash.')
            ->with('undoRoute', route('contacts.restore', $contact->id));
    }

    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return back()
            ->with('message', 'Contact has been removed permanently.');
    }
}
