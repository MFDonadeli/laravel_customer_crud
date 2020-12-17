<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return json_encode($customers);
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
        Customer::create(json_decode($request->all()["item"],true));

        return json_encode($request->all()["item"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return json_encode($customer);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return "PUT";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update(json_decode($request->all()["item"],true));
        return json_encode($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return json_encode("Customer Deleted");
    }


    public function search(Request $request)
    {
        $cpf_regex = "([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})";

        $ref = $request->all();
        $valueToSearch = array_shift($ref);

        if (preg_match("([0-9]{11})", $valueToSearch)) {
            $valueToSearch = substr($valueToSearch, 0, 3) . '.' .
                                substr($valueToSearch, 3, 3) . '.' .
                                substr($valueToSearch, 6, 3) . '-' .
                                substr($valueToSearch, 9, 2);
        }

              
        //Check if it has CPF format
        if (preg_match($cpf_regex, $valueToSearch) || preg_match("([0-9]{11})", $valueToSearch)) {
            $customers = Customer::where('cpf', $valueToSearch)->get();
        }
        else {
            $customers = Customer::where('name', 'like', "%$valueToSearch%")->get();
        }

        return json_encode($customers);
    }
}
