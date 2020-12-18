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

    /**
     * Display a listing of the resource.
     *
     *  @param  \Illuminate\Http\Request  $request
     */
    public function search(Request $request)
    {
        $cpf_regex = "([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})";

        //retrieve the search value to be find, from the request
        $ref = $request->all();
        $valueToSearch = array_shift($ref);

        //If the value is composed by 11 numbers, format it as a CPF
        if (preg_match("([0-9]{11})", $valueToSearch)) {
            $valueToSearch = substr($valueToSearch, 0, 3) . '.' .
                                substr($valueToSearch, 3, 3) . '.' .
                                substr($valueToSearch, 6, 3) . '-' .
                                substr($valueToSearch, 9, 2);
        }

        //Check if it has CPF format and if is not search by name
        if (preg_match($cpf_regex, $valueToSearch)) {
            $customers = Customer::where('cpf', $valueToSearch)->get();
        }
        else {
            $customers = Customer::where('name', 'like', "%$valueToSearch%")->get();
        }

        return json_encode($customers);
    }
}
