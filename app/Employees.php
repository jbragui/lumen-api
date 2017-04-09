<?php

namespace App;
  
use Illuminate\Database\Eloquent\Model;
  
class Employees extends Model
{
	protected $fillable = ['name', 'last_name', 'area', 'state'];
}