@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #2c3e50;">Customer List</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3" style="text:white background-color: #4e647c; border-color: #0056b3; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);">Add New Customer</a>
    
    @if ($customers->count())
    <table class="table table-striped" style="border-radius: 8px; overflow: hidden; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <thead>
            <tr style="background-color: #007bff; color: #ffffff;">
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->address }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning" style="background-color: #ffc107; border-color: #e0a800; color: #212529; box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);">Edit</a>
                    <a href="{{ route('customers.print', $customer->id) }}" class="btn btn-info" style="background-color: #17a2b8; border-color: #117a8b; color: #ffffff; box-shadow: 0 4px 8px rgba(23, 162, 184, 0.2);">Print</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="background-color: #dc3545; border-color: #c82333; color: #ffffff; box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #6c757d;">No customers found. Please add some customers.</p>
    @endif
</div>
@endsection
