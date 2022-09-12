<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function __construct()
    {
       // $this->middleware('my');
        $this->middleware("auth:sanctum");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkContactAvailibale($id){
        $contact = Contact::find($id);

        if(is_null($contact)){
            return response(["message"=>"Not Contact with this id","status"=>404],404);
        }

        return $contact;
    }

    public function index()
    {
        $contact = Contact::latest("id")->where("user_id",Auth::id())->get();
        return response()->json($contact,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact-> user_id = Auth::user()->id;
        $contact->save();
        return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->checkContactAvailibale($id);

        if(Gate::denies("view",$contact))
        {
            return response()->json([
                "message" => "forbidden",
            ],403);
        }
        return response()->json($contact);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        if($request->has('name')){
            $contact->name = $request->name;
        }

        if($request->has('phone')){
            $contact->phone = $request->phone;
        }

        if(Gate::denies("update",$contact))
        {
            return response([
                "message" => "forbidden",
            ],403);
        }
        $contact->update();
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = $this->checkContactAvailibale($id);
        if(Gate::denies("delete",$contact))
        {
            return response()->json([
                "message" => "forbidden"
            ],403);
        }
        $contact->delete();
        return response()->json("",204);
    }
}
