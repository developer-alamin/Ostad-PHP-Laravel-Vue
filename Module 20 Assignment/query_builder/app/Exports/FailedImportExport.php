<?php

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FailedImportExport implements FromCollection, WithHeadings
{
    public $failedRows;

    public function __construct($failedRows)
    {
        $this->failedRows = $failedRows;
    }

    public function collection()
    {
        // Convert failed rows into a collection format
        $failedData = collect();

        foreach ($this->failedRows as $failedRow) {
            $failedData->push($failedRow['data']);
        }

        return $failedData;
    }

    public function headings(): array
    {
        // Define your headers for the Excel export
        return ['Name', 'Email', 'Phone'];
    }
}