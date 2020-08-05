<?php

namespace App\Http\Controllers;

use App\fooditem;
use Illuminate\Http\Request;

class FooditemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productlist=fooditem::all();
        return response()->json(
            $productlist,
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $ProductPic="";
            if ($request->file('ProductPhoto')!=null) {
                $destinationPath = 'uploads';
                $file = $request->file('ProductPhoto');
                $ProductPic = $file->store($file->getClientOriginalName());
                $ProductPic=$destinationPath.'/'.$file->getClientOriginalName();
                $file->move($destinationPath, $file->getClientOriginalName());
            }
            $fooditem=new fooditem([
                        'proname'=> $request->proname,
                        'descrpation'=> $request->descrpation,
                        'imagepath'=> $ProductPic,
                        'price' =>$request->price,
                        'menuitemnid'=>$request->menuitemnid
                    ]);
            $fooditem->save();
            return response()->json([
         'message' => 'Successfully Product Created'
     ], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fooditem  $fooditem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $food=fooditem::find($request->id);
        return response()->json([
         $food
     ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fooditem  $fooditem
     * @return \Illuminate\Http\Response
     */
    public function edit(fooditem $fooditem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fooditem  $fooditem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fooditem $fooditem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fooditem  $fooditem
     * @return \Illuminate\Http\Response
     */
    public function destro(Request $request)
    {
        $food=fooditem::find($request->id)->delete();
        return response()->json([
            $food,
         'message' => 'Successfully deleted'
     ], 200);
    }
}
