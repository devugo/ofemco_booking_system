<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Product;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'product_id' => 'required'
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
            'reference_id' => '00000001'
        ]);

        // $request->session()->flash('devugo_status', 'Order for <strong>' . $product->title . '</strong> was placed successfully!');
        flash('Order for <strong>' . $product->title . '</strong> was placed successfully!');
        // session(['devugo_status' => 'Order has been created!']);

        // return \redirect
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $order = Order::findOrFail($id);

        // return $order->user;
        if(auth()->user()->id === $order->user_id || auth()->user()->role_id === 1){
            $order->delete();
            flash('Order was deleted successfully!');
        }
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $orders = Order::onlyTrashed();
        $order = $orders->findOrFail($id);

        if($order->deleted_at != NULL){
            $order->restore();
        }

        flash('Order was restored successfully!');

        return back();
        
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'confirmed_at' => new \DateTimeImmutable()
        ]);

        flash('Order was confirmed successfully');

        return back();
    }

    public function verify_payment(string $ref, int $order, int $amount_paid)
    {
        // $competition_applied = auth()->user()->competitions_applied->find($order);
        // if(!$competition_applied){
        //     return back();
        // }
        // $sKey = SiteSetting::find(1)->private_key;
        // return $sKey;
        $order = Order::findOrFail($order);



        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/' . $ref;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
        $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer sk_test_59517609926d5a73d3824dde742445407f06ae58']
            // 'Authorization: Bearer ' . $sKey]
        );
        $request = curl_exec($ch);
        curl_close($ch);

        if ($request) {
            $result = json_decode($request, true);
                // echo '<pre>';
                // print_r($result); die;
            if($result){
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){
                        $amount_paid = ($result['data']['amount'])/100;
                        $amount_to_be_paid = $order->product->actual_cost;

                        if($amount_to_be_paid !== $amount_paid){
                            $message = 'Failed paystack verification. Paid ' . currencyFormatter($amount_paid) . ' instead of ' . currencyFormatter($amount_to_be_paid) . '. Please contact support!';
                            $order->update([
                                'amount_paid' => $amount_paid,
                                'paid_at' => new \DateTimeImmutable(),
                                'verification_message' => $message,
                                'verification_response' => json_encode($result)
                            ]);
                            flash($message, 'warning');
                        }else{
                            $message = 'Transaction was successful';
                            $order->update([
                                'amount_paid' => $amount_paid,
                                'paid_at' => new \DateTimeImmutable(),
                                'verified_at' => new \DateTimeImmutable(),
                                'verification_message' => $message,
                                'verification_response' => \json_encode($result)
                            ]);
                            flash($message);
                        }
                        return back();
                    }else{
                    // the transaction was not successful, do not deliver value'
                    // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                    flash('Transaction was not successful', 'danger');
                    return back();
                    }
                }else{
                    flash('Error verifying payment, please contact admin', 'warning');
                    return back();
                }

            }else{
            //print_r($result);
            //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
            }
        }else{
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
        }
    }
}
