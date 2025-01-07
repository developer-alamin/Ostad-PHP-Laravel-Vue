<?php 
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ExcelImport implements ToArray
{
    public $validRows = [];
    public $failedRows = [];
    public $errors = [];

    public function array(array $array)
    {
        // Ensure first row contains the column headers
        $headers = array_shift($array);

        // Normalize headers to lowercase to avoid case-sensitivity issues
        $headers = array_map('strtolower', $headers);

        foreach ($array as $index => $row) {
            $rowErrors = $this->validateRow($row, $headers, $index);

            if (empty($rowErrors)) {
                $this->validRows[] = $row;
            } else {
                $this->failedRows[] = [
                    'row' => $index + 1, // Store 1-based index
                    'errors' => $rowErrors,
                    'data' => $row,
                ];
            }
        }
    }

    public function validateRow($row, $headers, $rowIndex)
    {
        $requiredColumns = [
            'name',
            'email',
            'phone',
        ];

        $rowErrors = [];

        foreach ($requiredColumns as $column) {
            // Get the column index dynamically by converting column name to lowercase
            $columnIndex = array_search(strtolower($column), $headers);

            // If the column doesn't exist in the uploaded data, skip and add error
            if ($columnIndex === false) {
                $rowErrors[] = "The $column column is missing in the data.";
                continue; // Skip this column if it's missing
            }

            // Safely access the column value and set default if empty
            $columnValue = isset($row[$columnIndex]) ? trim($row[$columnIndex]) : ''; // Default to empty string if not set

            // Check if the column value is empty
            if (empty($columnValue)) {
                $rowErrors[] = "The $column field is required.";
            }

            // Validate email
            if ($column === 'email' && !filter_var($columnValue, FILTER_VALIDATE_EMAIL)) {
                $rowErrors[] = "The $column field is not a valid email address.";
            }

            // Validate phone (Bangladesh phone number)
            if ($column === 'phone' && ! preg_match('/^1[3-9]\d{8}$/', $columnValue)) {
                $rowErrors[] = "The $column field must be a valid 11-digit Bangladesh phone number starting with 01 or 8801.";
            }
        }

        return $rowErrors;
    }

    public function getValidRows()
    {
        return $this->validRows;
    }

    public function getFailedRows()
    {
        return $this->failedRows;
    }
}