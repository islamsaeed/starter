<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Validator;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




class CrudController extends Controller
{


    public function getOffers()
    {
        $offers = Offer::select(
            'id',
            'price',
            // 'name_' . LaravelLocalization::getCurrentLocale() . ' As name ',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'

        )->get(); // return collection


        return  view('offers.all', compact('offers'));
    }



    public function create()
    {

        return  view('offers.create');
    }

    public function store(OfferRequest $request)
    {


        //    $rules = $this->getRules();
        //    $masseges = $this->getMessages();


        // $validator =
        // Validator::make($request->all(),$rules,$masseges);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput($request->all());
        // }



        Offer::create([
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price


        ]);


        return redirect()->back()->with('sucess', 'تم اضافه العرض بنجاح');
    }


    //   protected function getMessages() {


    //     return $masseges = [

    //         'name.required' => trans('messages.offer name required'),
    //         'name.unique' => __('messages.offername  mast be unique'),
    //         'price.numeric' =>__('messages.offer must be number'),
    //         'price.required' => __('messages.price ya man'),
    //         'details.required' => __('messages.details required'),
    //      ];

    //   }

    //   protected function getRules() {

    //      return $rules = [


    //         'name' => 'required|max:100|unique:offers,name',
    //         'price' => 'required|numeric',
    //         'details' => 'required'
    //      ];

    //   }

}
