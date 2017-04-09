<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employees;
use App\EmployeesMarking;

class EmployeesMarkingController extends Controller
{
	public function createMarkingList(Request $request){
        try {
        	$result = array("code" => 200, "state" => true, "data" => "The marking list was already created");
        	$current_date = new \DateTime();
        	$current_date = $current_date->format("Y-m-d");
        	$exists = EmployeesMarking::where('marking_date', $current_date)->count();

        	if ($exists == 0) {
	        	$employees = Employees::get();

		        foreach ($employees as $key => $value) {
		        	$employees_marking = new EmployeesMarking();

		        	$employees_marking->employee_id = $value["id"];
		        	$employees_marking->marking_date = $current_date;
		        	$employees_marking->created_at = $current_date;

		        	$employees_marking->save();
		        }

		        $result = array("code" => 200, "state" => true, "data" => "The marking list was created successfully");
        	}
        } catch (\Exception $e) {
        	$result = array("code" => 500, "state" => false, "data" => $e->getMessage());
        }

		return response()->json($result);
    }
}