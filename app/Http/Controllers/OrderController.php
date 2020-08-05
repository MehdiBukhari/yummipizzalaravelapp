<?php

namespace App\Http\Controllers;

use App\order;
use App\orderline;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =order::with(['orderline'])->get();
        return response()->json(
            $orders,
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
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderline=$request->orderline;
        try {
            $ordernew=new order([
                'userid'=>$request->user()->id,
                'totalPrice'=>$request->totalPrice,
                'adress' => $request->adress,
                'mobileNumber' =>$request->mobileNumber
             ]);
            $ordernew->save();
            $orderid=$ordernew->id;
            foreach ($orderline as $ord) {
                $orderitem=new orderline([
                        'foodid'=>$ord['foodid'],
                        'orderid'=>$orderid,
                        'Qunty'=>$ord['Qunty'],
                    ]);
                $orderitem->save();
            }

            return response()->json([
         'message' => 'Successfully Order Placed'
     ], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
    public function getUserOrders(Request $request)
    {
        $id=$request->userid;
        $orders =order::with(['orderline'])->where('userid', '=', $id)->get();
        return response()->json(
            $orders,
            200
        );
    }
    public function getUserOwnOrders(Request $request)
    {
        $id=$request->user()->id;
        $orders =order::with(['orderline'])->where('userid', '=', $id)->get();
        return response()->json(
            $orders,
            200
        );
    }
}
