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
         $packlists = DB::table('packlists')
                    ->join('products', 'packlists.product_id', '=', 'products.id' )
                    ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                    ->orderBy('packlists.product_id', 'desc')                            
                    ->get(['product_names.name', 'packlists.godown', 'packlists.available_qty', 'packlists.required_qty']);
       
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
