<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddressCreateRequest;
use App\Http\Requests\Frontend\AddressUpdateRequest;
use App\Models\Address;
use App\Models\DeliveryArea;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() : View
    {
        $deliveryAreas = DeliveryArea::where('status', 1)->get();
        $userAddresses = Address::where('user_id', auth()->user()->id)->get();
        return view('frontend.dashboard.index', compact('deliveryAreas', 'userAddresses'));
    }

    function createAddress(AddressCreateRequest $request)
    {
        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Created Successfully!');

        return to_route('admin.dashboard');
    }

    function updateAddress(string $id, AddressUpdateRequest $request)
    {
        $address = Address::findOrFail($id);
        $address->user_id = auth()->user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Updated Successfully!');

        return to_route('admin.dashboard');
    }

    function destroyAddress(string $id)
    {
        $address = Address::findOrFail($id);
        if ($address && $address->user_id === auth()->user()->id) {
            $address->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }
        return response(['status' => 'error', 'message' => 'Something went wrong!']);
    }
}
