<?php

namespace App\Http\Controllers;

use App\Tour;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Pamagite implements FromView
{
    public function view(): View
    {
        return view('admin.tours.toursspisoc', ['tours' => tour::where('LogicalDelete',0)->get()]);
    }
}
