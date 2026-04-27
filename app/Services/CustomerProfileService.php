<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function find(Customer $customer): Customer
    {
        return $customer;
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(Customer $customer, array $data): Customer
    {
        $customer->update($data);
        return $customer->fresh();
    }

    public function delete(Customer $customer): void
    {
        $customer->delete();
    }
}