<?php

namespace App\Plugins\SalesOrder\Export;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class SalesOrderExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    private $sales_order_list;
    private $senderData;

    public function __construct($sales_order_list, $senderData)
    {        
        $this->sales_order_list = $sales_order_list;
        $this->senderData = $senderData;
    }

    public function view(): View
    {
        return view("sales_order::admin.sales_order.export", [
            'sales_order_list' => $this->sales_order_list,
            'senderData' => $this->senderData,
        ]);

    }

    public function bindValue(Cell $cell, $value)
    {
        $column = $cell->getColumn();
        if (in_array($column, ['A', 'B', 'C', 'D', 'E'])) {
            $cell->setValueExplicit($value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
