<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class QueryModel extends Model
{
    use HasFactory;

    public function queryTest()
    {
//        get group_name for where group_id = 27
        $user = DB::table('groups')->join('employee','employee.group_id','=','groups.id')->where('employee.group_id',27)->get('groups.group_name');

        $receipt = DB::table('receipt')
            ->join('service','receipt.service_id','=','service.id')
            ->join('company','receipt.company_id','=','company.id')
            ->join('supplier','receipt.supplier_id','=','supplier.id')
            ->join('employee','receipt.employee_id','=','employee.id')
            ->select('employee.first_name','employee.last_name','service.service_name','company.company_name','supplier.supplier_name')
            ->get();

        return $receipt;
    }
    public function category(Request $id)
    {
        $selectCategory = DB::table('information')->where('id',$id)->get();
        dd($updateUserView);
    }

}
