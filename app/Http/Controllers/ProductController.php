<?php

namespace App\Http\Controllers;

use App\Product;
use App\Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = Service::findOrFail($request->service);

        $validate = $this->validate($request, [
            'icon' => 'required|max:50',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'features' => 'required',
            'slashed_cost' => 'nullable',
            'actual_cost' => 'required|gt:slashed_cost'
        ]);

        $product = Product::create([
            'service_id' => $request->service,
            'icon' => $request->icon,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'features' => json_encode(explode(',', $request->features)),
            'slashed_cost' => $request->slashed_cost,
            'actual_cost' => $request->actual_cost,
        ]);

        flash('Product was created successfully');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $service = Service::findOrFail($request->service);
        $product = Product::findOrFail($id);

        $validate = $this->validate($request, [
            'icon' => 'required|max:50',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'features' => 'required',
            'slashed_cost' => 'nullable',
            'actual_cost' => 'required|gt:slashed_cost'
        ]);

        $product->update([
            'service_id' => $request->service,
            'icon' => $request->icon,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'features' => json_encode(explode(',', $request->features)),
            'slashed_cost' => $request->slashed_cost,
            'actual_cost' => $request->actual_cost,
        ]);

        flash('Product was updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $product = Product::findOrFail($id);
        $product->delete();
        
        flash('Product was deleted successfully!');
        
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $products = Product::onlyTrashed();
        $product = $products->findOrFail($id);

        if($product->deleted_at != NULL){
            $product->restore();
        }

        flash('Product was restored successfully!');

        return back();
        
    }
}
