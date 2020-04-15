<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Quotation;

class ChangeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica cada dia si ya la cotizacion llego a su fecha de vencimiento';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
    }
}
