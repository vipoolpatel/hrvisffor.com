<?php

namespace App\Imports;


// use App\Admin\ShopModel;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        dd($row);
        
        // $save = new ShopModel;
        // $save->fname = $row['0'];
        // $save->lname = $row['1'];
        // $save->save();
        // return true;
        
    }
}
