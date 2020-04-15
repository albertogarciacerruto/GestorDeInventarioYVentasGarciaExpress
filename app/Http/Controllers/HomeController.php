<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quotation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = \Carbon\Carbon::now();
        $now->toDateTimeString();
        $now = strtotime ($now) ;
        $now = date ( 'Y-m-d' , $now );
            $quotation = Quotation::where('date_finish', '=', $now)->where('status', '=', 'Por Confirmar')->get();
            $cont = count($quotation);
            for ($i = 0; $i < $cont; $i++){
                if($quotation[$i]->date_finish >= $now){
                    
                $list = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation[$i]->id)->get();
                $conta = count($list);
                for ($j = 0; $j < $conta; $j++){
                $inventory =  \DB::table('inventories')->where('id', $list[$j]->inventory_id)->first();
                $product =  \DB::table('products')->where('id', $inventory->product_id)->first();
                $update_inventory = \DB::table('inventories')->where('id', $list[$j]->inventory_id)->update(['quantity' => $inventory->quantity + $list[$j]->quantity]);
                }
                $update_status = \DB::table('quotations')->where('id', $quotation[$i]->id)->update(['status' => 'Cancelado']);
            }
        }
        return view('home');
    }
}
