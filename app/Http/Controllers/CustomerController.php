<?php

namespace App\Http\Controllers;

use App\Dtos\StandardFilter;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $service)
    {}

    public function index(Request $request)
    {
        $filter = new StandardFilter(
            search: (string) $request->input('search', ''),
            input: (string) $request->input('input', ''),
            pagination: $request->integer('pagination', 10),
            needPagination: $request->boolean('needPagination', true)
        );

        $customers = $this->service->querySearchMultiColumn($filter);

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
