<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $menu = Menu::findOrFail($request->menu);

        $validate = Validator::make(request()->all(), [
            'sub_menu' => "required|unique:services,sub_menu|max:255",
            'title' => "required|max:255",
            'image' => "required|image",
            'content' => 'required'
        ]);

        $validate->after(function ($validate) {
            if (!$this->validateSubMenuSlug(request()->sub_menu)) {
                $validate->errors()->add('sub_menu', 'Sub menu already exist');
            }
        });

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/images/services', $fileNameToStore);
            // if(auth()->user()->photo !== NULL){
            //     unlink(public_path() . '/storage/images/services/' . auth()->user()->photo);
            // }
        }

        $service = Service::create([
            'menu_id' => $request->menu,
            'sub_menu' => $request->sub_menu,
            'title' => $request->title,
            'content' => $request->content,
            'sub_menu_slug' => strToSlug($request->sub_menu),
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $fileNameToStore
        ]);

        flash('Sub Service was created successfully');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $service = Service::findOrFail($id);

        $menu = Menu::findOrFail($request->menu);

        $validate = $this->validate($request, [
            'sub_menu' => "required|unique:services,sub_menu,$id|max:255",
            'title' => "required|max:255",
            'content' => 'required'
        ]);

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/images/services', $fileNameToStore);
            if($service->image !== NULL){
                unlink(public_path() . '/storage/images/services/' . $service->image);
            }

            $service->update([
                'image' => $fileNameToStore
            ]);
        }

        $service->update([
            'menu_id' => $request->menu,
            'sub_menu' => $request->sub_menu,
            'title' => $request->title,
            'content' => $request->content,
            'sub_menu_slug' => strToSlug($request->sub_menu),
            'button_text' => $request->button_text,
            'button_link' => $request->button_link
        ]);

        flash('Sub Service was updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $service = Service::findOrFail($id);
        $service->delete();
        
        flash('Sub Service was deleted successfully!');
        
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $services = Service::onlyTrashed();
        $service = $services->findOrFail($id);

        if($service->deleted_at != NULL){
            $service->restore();
        }

        flash('Sub Service was restored successfully!');

        return back();
        
    }

    private function validateSubMenuSlug($str)
    {
        $service = Service::where('sub_menu_slug', \strToSlug($str))->first();
        if($service){
            return false;
        }
        return true;
    }
}
