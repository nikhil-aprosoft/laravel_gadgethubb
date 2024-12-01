<?php

namespace App\Http\Controllers\Admin;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    // Index method to show the list of deliveries
    public function index()
    {
        $deliveries = Delivery::all(); 
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
        ]);

        Delivery::create([
            'to' => $request->to,
            'from' => $request->from,
        ]);

        return redirect()->back()->with('success', 'Delivery created successfully!');
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id); 
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'to' => 'required|integer',
            'from' => 'required|integer',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update([
            'to' => $request->to,
            'from' => $request->from,
        ]);

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery updated successfully!');
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id); 
        $delivery->delete(); 

        return redirect()->back()->with('success', 'Delivery deleted successfully!');
    }
}
