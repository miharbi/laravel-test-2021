<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Interfaces\IShippingService;
use App\Http\Requests\ShippingPostRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $shipmentSuccess = ($request->session()->has('shipmentSuccess')) ? $request->session()->get('shipmentSuccess') : false;
        return view('shipping/shipping-form', ['shipmentSuccess' => $shipmentSuccess]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingPostRequest $request, IShippingService $shippingService)
    {
        if ($request->input('destination') == 2) {
            $user = Auth::user();
            $user->shippings()->create([
                'name' => $request->input('name'),
                'height' => $request->input('height'),
                'width' => $request->input('width'),
                'weight' => $request->input('weight'),
                'destination' => $request->input('destination')
            ]);
        }

        $shipment = $shippingService->store(
            $request->input('name'),
            $request->input('height'),
            $request->input('width'),
            $request->input('weight'),
            $request->input('destination')
        );
        return redirect()->route('shippings.create')->with('shipmentSuccess', $shipment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}
