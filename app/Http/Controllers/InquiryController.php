<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function create($id)
{
    $property = Property::findOrFail($id);

    return view('inquiries.create', compact('property'));
}
public function store(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'visit_date' => 'required|date|after_or_equal:today',
        'visit_time' => 'required',
        'message' => 'nullable|string|max:1000',
    ]);

    Inquiry::create([
        'property_id' => $id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'visit_date' => $request->visit_date,
        'visit_time' => $request->visit_time,
        'message' => $request->message,
    ]);

    return redirect()->route('properties.show', $id)->with('success', 'Your visit has been booked successfully!');
}

}
