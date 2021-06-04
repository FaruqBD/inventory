<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products =  DB::table('products')
                    ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                    ->join('categories', 'products.category_id', '=', 'categories.id' )
                    ->join('godowns', 'products.godown_id', '=', 'godowns.id' )
                    ->orderBy('products.created_at', 'desc')
                    ->get(array('product_names.name as product_name_id', 'products.quantity as quantity', 'godowns.name as godown_id', 'categories.name as category_id', 'products.remarks as remarks' ));

        return  $products;
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Quantity',
            'Godown',
            'Category',
            'Remarks',
        ];
    }
}
