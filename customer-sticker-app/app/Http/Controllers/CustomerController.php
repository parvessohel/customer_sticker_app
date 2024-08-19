<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }

    public function printSticker($id)
{
    // Retrieve the customer details
    $customer = Customer::findOrFail($id);

    try {
        // Connect to the printer
        $connector = new WindowsPrintConnector("Xprinter XP-350BM"); // Replace with your printer's name
        $printer = new Printer($connector);

        // Format the sticker content
        $printer->setTextSize(2, 2); // Adjust text size if needed
        $printer->text("Name: " . $customer->name . "\n");
        $printer->text("Phone: " . $customer->phone_number . "\n");
        $printer->text("Address: " . $customer->address . "\n");

        // Print and cut the paper
        $printer->cut();
        $printer->close();
    } catch (\Exception $e) {
        // Handle errors, such as issues connecting to the printer
        return back()->withErrors(['error' => 'Could not print sticker: ' . $e->getMessage()]);
    }

    // Redirect back with a success message
    return back()->with('success', 'Sticker printed successfully!');
}
}
