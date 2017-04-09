<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeesMarking extends Model
{
	protected $fillable = ['employee_id', 'marking_date', 'marking_in', 'marking_out'];
}