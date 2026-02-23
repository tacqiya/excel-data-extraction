<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromArray, WithHeadings
{
    protected $data;
    protected $columns;

    public function __construct(array $data, array $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function array(): array
    {
        // Filter columns
        $filtered = [];
        foreach ($this->data as $row) {
            $filtered[] = array_intersect_key($row, array_flip($this->columns));
        }
        return $filtered;
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
