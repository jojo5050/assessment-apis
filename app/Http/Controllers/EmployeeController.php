<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Get all employees
    public function index()
    {
        return response()->json(Employee::all(), 200);
    }

    // Create a new employee
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'phone' =>  'required|string|max:18',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    // Get a single employee by ID
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee, 200);
    }

    // Update an employee
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'position' => 'sometimes|required|string|max:255',
            'gender' => 'required|string|max:10',
            'phone' =>  'required|string|max:18',
        ]);

        $employee->update($validated);

        return response()->json($employee, 200);
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted'], 200);
    }
}
