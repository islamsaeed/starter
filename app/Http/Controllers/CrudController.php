<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CrudController extends Controller
{


      public function getOffers() {

       return  Offer::select('name', 'id')->get();
      }



      public function create() {

        return  view('offers.create');
      }

      public function store(Request $request) {


         $rules = [


            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
         ];

         $masseges = [

            'name.required' => trans('messages.offer name required'),
            'name.unique' => __('messages.offername  mast be unique'),
            'price.numeric' =>'لازمتا  السعر رقم',
            'details.required' => 'التفاصيل يا علق'
         ];


        $validator =
        Validator::make($request->all(),$rules,$masseges);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }



        Offer::create([
            'details' => $request->details,
            'name' => $request->name,
            'price' => $request->price


        ]);


         return redirect()->back()->with('sucess' , 'تم اضافه العرض بنجاح');
      }

    }


