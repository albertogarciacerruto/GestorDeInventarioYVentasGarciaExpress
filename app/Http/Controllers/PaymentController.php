<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function list_payments()
    {
        $list_payments = \DB::table('payments')->get();
        return view('principal/payments', compact('list_payments'));
    }
    public function register()
    {
        return view('principal/register_payment');
    }
    public function register_payment(PaymentRequest $request)
    {
        $name = $request->name;
        $payment= Payment::orderBy('id', 'desc')->first();

        if (is_null($payment)) {
        Payment::create([
        'name' => $request->name,
        'user' => \Auth::id(),
        ]);
        }
        elseif($name === $payment->name){
        return $this->list_payments();
        }
        else {
        Payment::create([
        'name' => $request->name,
        'user' => \Auth::id(),
        ]);
        }
        $list_payments = \DB::table('payments')->get();
        return redirect('payments');
        //return view('configuracion/payments', compact('list_payments'));
    }
    public function destroy($id_payment)
    {
        try{
        $payment = \DB::table('payments')->where('id', '=', decrypt($id_payment))->delete();

        $list_payments = \DB::table('payments')->get();
        return redirect('payments');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/payment');
        }
    }
    public function edit($id_payment)
    {
        $payment = \DB::table('payments')->where('id', '=', decrypt($id_payment))->first();

        return view('principal/edit_payment', compact('payment'));
    }
    public function update(PaymentRequest $request)
    {
        $name = $request->name;
        $id = $request->id;

        $update_name = \DB::table('payments')->where('id', $id)->update(['name' => $name, 'user' => \Auth::id()]);

        $list_payments = \DB::table('payments')->get();
        return redirect('payments');
        //return view('configuracion/payments', compact('list_payments'));
    }
}
