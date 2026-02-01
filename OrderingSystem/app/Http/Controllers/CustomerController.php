<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function destroy($customer_id)
    {
        DB::table('tbl_customer')->where('customer_id', $customer_id)->delete();
        return redirect()->back()->with('success', 'Customer removed successfully.');
    }
}
