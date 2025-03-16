<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ElectricCarsTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class ElectricCarController extends Controller
{
    public function exportTemplate()
    {
        return Excel::download(new ElectricCarsTemplateExport, 'electric-cars-template.xlsx');
    }
}
