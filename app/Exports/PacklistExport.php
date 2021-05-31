<?php

namespace App\Exports;
use App\Models\Packlist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PacklistExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $packlists =  DB::table('packlists')
                    ->orderBy('created_at', 'desc')
                    ->get(['product_name', 'godown', 'available_qty', 'required_qty']);

        return  $packlists;
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Godown',
            'Available Quantity',
            'Required Quantity',
        ];
    }
}
