<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);
        // $path = $request->file('excel_file')->store('temp');
        // $data = Excel::toArray(new ExcelImport, storage_path('app/' . $path));
        $data = Excel::toArray(new ExcelImport, $request->file('excel_file'));
        session(['excel_data' => $data[0]]);
        return redirect()->route('excel.data');
    }

    public function showData()
    {
        $data = session('excel_data', []);
        if (count($data) > 0) {
            $columns = $data[0];  // first row = header
            $rows = array_slice($data, 1);  // remaining rows
        } else {
            $columns = [];
            $rows = [];
        }
        // dd($columns);
        return view('excel-data', compact('data', 'columns'));
    }

    public function export(Request $request)
    {
        $columns = $request->input('columns', []);
        $data = session('excel_data', []);
        if (empty($columns) || empty($data)) {
            return redirect()->route('excel.show')->with('error', 'Select columns to export!');
        }
        return Excel::download(new ExcelExport($data, $columns), 'export.xlsx');
    }
}
