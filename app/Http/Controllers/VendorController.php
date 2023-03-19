<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $vendors
        ];
    }

    public function macaddress(Vendor $vendor)
    {
        return $vendor;
    }

    public function multipleMac(Request $request){
        if($request->isMethod('post')) {
            $userData = $request->input();
            //echo "<pre>"; print_r($userData); //die;
            $count = 0;
            $vendorsArray = array();
            foreach ($userData['macaddresses'] as $key => $value) {
                    if ($count == 0) {
                        $output = str_replace('-', '', $value['macaddress']);
                    }
                    // todo: strip away separators on d/b and search values to eliminate differing presentations of macaddress
                    $vendor = Vendor::where('macaddress', '=', $value['macaddress'])->first();
                    //$vendor = Vendor::where(str_replace('-', '', 'macaddress'), '=', str_replace('-', '', $value['macaddress']))->first();
                    if ($vendor !== null) {
                        array_push($vendorsArray, $vendor);
                        $count++;
                    }
            }
            return [
                "count" => $count,
                "data" => $vendorsArray,
                "output" => $output
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'macaddress' => 'required',          
        ]);
 
        $vendor = Vendor::create($request->all());
        return [
            "status" => 1,
            "data" => $vendor
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return [
            "status" => 1,
            "data" =>$vendor
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'macaddress' => 'required', 
        ]);
 
        $vendor->update($request->all());
 
        return [
            "status" => 1,
            "data" => $vendor,
            "msg" => "Vendor updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return [
            "status" => 1,
            "data" => $vendor,
            "msg" => "Vendor deleted successfully"
        ];
    }
}
