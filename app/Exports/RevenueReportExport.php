<?php

namespace App\Exports;

use App\Exports\Sheets\DailySheet;
use App\Exports\Sheets\DriverSheet;
use App\Exports\Sheets\RouteSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RevenueReportExport implements WithMultipleSheets
{
    public function __construct(
        protected string $from,
        protected string $to
    ) {}

    public function sheets(): array
    {
        return [
            new DailySheet($this->from, $this->to),
            new DriverSheet($this->from, $this->to),
            new RouteSheet($this->from, $this->to),
        ];
    }
}