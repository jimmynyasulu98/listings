<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(Request $request){
      
        return view('listings.index' , ['listings' => Listing::latest()->filter(request(['tag','search']))->paginate(6)
        
        ]);
    }
    public function show(Listing $listing ){
        
        return view('listings.show' , ['listing' => $listing]);
        } 
    public function create(){
        return view('listings.create');
        } 
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required' , Rule::unique('listings', 'company')],
            'location'=> 'required',
            'website'=> 'required',
            'email' => ['required', 'email'],  # Validate and format email 
            'tags' => 'required',
            'description' => 'required'
                            
         ]);
        
        if($request->hasFile('logo')){

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
         }
     
         Listing::create($formFields);

         return redirect('/')->with('message','Listing created successfully');
    }    

    public function edit(Listing $listing){

        return view('listings.edit' , ['listing'=> $listing]);
    
    }
    # Update Listing
    public function update(Request $request, Listing $listing){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=>  'required', /**['required' ,  Rule::unique('listings', 'company')]**/ 
            'location'=> 'required',
            'website'=> 'required',
            'email' => ['required', 'email'],  # Validate and format email 
            'tags' => 'required',
            'description' => 'required'
                            
         ]);
        
        if($request->hasFile('logo')){

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
         }
     
        $listing->update($formFields);

        return back()->with('message','Action successfully');
    }  
    # Delete listing
    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message','Item deleted successiffully');
    }
}

