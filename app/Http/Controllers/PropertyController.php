<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function allProperties()
{
    $properties = Property::all(); // Get all properties
    return view('properties.all', compact('properties')); // Return the view with data
}
    public function index(Request $request)
    {
        // Initialize the query
        $query = Property::query();
    
        // Apply filters only if provided
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }
    
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        // Fetch all properties or filtered results
        $properties = $query->get();
    
        return view('properties.index', compact('properties'));
    }
    //Details of a single property shown----------------------------------------------------------------
    public function show($id)
{
    // Find the property by ID or throw a 404 error if not found
    $property = Property::findOrFail($id);

    // Return the property details view
    return view('show', compact('property'));
}

    

}
