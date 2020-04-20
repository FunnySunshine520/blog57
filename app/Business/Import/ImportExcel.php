<?php
namespace App\Business\Import;
use Maatwebsite\Excel\Concerns\ToArray;

class ImportExcel implements ToArray
{
    protected $invoices;

    public function Array(Array $tables)
    {
        return $tables;
    }
}
