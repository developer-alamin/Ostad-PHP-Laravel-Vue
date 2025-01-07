<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Exports\FailedImportExport;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate if the file is an excel file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // max 10MB file
        ]);

        $file = $request->file('file');

        try {
            // Initialize the import class and import the file
            $import = new ExcelImport();
            Excel::import($import, $file);

            // Get valid and failed rows from the import class
            $validRows = $import->getValidRows();
            $failedRows = $import->getFailedRows();

            // If there are failed rows, generate a downloadable Excel file for them
            if (count($failedRows) > 0) {
             //   return Excel::download(new FailedImportExport($failedRows), 'failed_rows.xlsx');
            }

            // Return the view with valid and failed rows
            return view('import_summary', compact('validRows', 'failedRows'));

        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
