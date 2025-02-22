<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    // Index method to show the list of deliveries
    public function index()
    {
        $deliveries = Shipping::all(); 
        return view('admin.delivery.index', compact('deliveries'));
    }

    public function create()
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'to' => 'required|integer',
            'from' => 'required|integer',
            'cost'=>'required|integer'
        ]);

        Shipping::create([
            'from' => $request->from,
            'to' => $request->to,
            'cost'=>$request->cost,
        ]);

        return redirect()->back()->with('success', 'Delivery created successfully!');
    }

    public function edit($id)
    {
        $delivery = Shipping::findOrFail($id); 
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'to' => 'required|integer',
        //     'from' => 'required|integer',
        // ]);

        $delivery = Shipping::findOrFail($id);
        $delivery->update([
            'from' => $request->from,
            'to' => $request->to,
            'cost'=>$request->cost,
        ]);

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery updated successfully!');
    }

    public function destroy($id)
    {
        $delivery = Shipping::findOrFail($id); 
        $delivery->delete(); 

        return redirect()->back()->with('success', 'Delivery deleted successfully!');
    }
}
