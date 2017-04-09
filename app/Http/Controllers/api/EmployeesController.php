<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;  
use App\Employees;
use App\EmployeesMarking;

class EmployeesController extends Controller
{
	public function listEmployee(){
        try {
        	$result = array("code" => 200, "state" => true, "data" => array());
	       	$employees = Employees::get();

	       	if ($employees) {
	       		$result = array("code" => 200, "state" => true, "data" => $employees);
	       	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }

	public function getEmployee($id){
        try {
        	$result = array("code" => 200, "state" => true, "data" => "The search did not find results");
	       	$employee = Employees::find($id);

	       	if ($employee) {
		       	$result = array("code" => 200, "state" => true, "data" => $employee);
	       	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }

	public function createEmployee(Request $request){
        try {
        	$employee = Employees::create($request->all());
		    $result = array("code" => 200, "state" => true, "data" => "The employee was registered successfully");
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }

	public function updateEmployeeMarkingIn(Request $request, $id){
        try {
        	$current_date = date("Y-m-d");
        	$result = array("code" => 200, "state" => true, "data" => "The search did not find results");
        	$employee_marking = EmployeesMarking::where("employee_id", $id)
        								->where("marking_in", null)
        								->where("marking_date", $current_date)
        								->first();

        	$current_date = date("Y-m-d H:i:s");

        	if ($employee_marking) {
        		$employee_marking->marking_in = $current_date;
        		$employee_marking->save();

		    	$result = array("code" => 200, "state" => true, "data" => "The employee's marking in was updated successfully");
        	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }

	public function updateEmployeeMarkingOut(Request $request, $id){
        try {
        	$current_date = date("Y-m-d");
        	$result = array("code" => 200, "state" => true, "data" => "The search did not find results");
        	$employee_marking = EmployeesMarking::where("employee_id", $id)
        								->where("marking_out", null)
        								->where("marking_date", $current_date)
        								->first();

        	$current_date = date("Y-m-d H:i:s");

        	if ($employee_marking) {
        		$employee_marking->marking_out = $current_date;
        		$employee_marking->save();

		    	$result = array("code" => 200, "state" => true, "data" => "The employee's marking out was updated successfully");
        	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }

	public function deleteEmployee($id){
        try {
        	$result = array("code" => 200, "state" => true, "data" => "The search did not find results");
	       	$employee = Employees::find($id);

	       	if ($employee) {
	       		$employee->delete();
		       	$result = array("code" => 200, "state" => true, "data" => "The employee was deleted successfully");
	       	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }
}