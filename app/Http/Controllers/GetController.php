<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetController extends Controller
{
	public function __invoke()
	{
		 return response(['Title' => 'All ok']);
		//  return 'ALLOK';
	}
}
