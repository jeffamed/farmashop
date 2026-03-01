<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query()->search($request)
            ->latest('id')
            ->paginate($request->integer('pagination', 10));

        return CustomerResource::collection($customers);
    }

    public function store(CustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->validated()));
    }

    public function show(Customer $customer, Request $request)
    {
        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}
