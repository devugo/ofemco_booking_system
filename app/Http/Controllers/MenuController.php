<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(request()->all(), [
            'main_menu' => "required|unique:menus,main_menu|max:255",
            'content' => "required",
            'icon' => "required"
        ]);

        $validate->after(function ($validate) {
            if (!$this->validateMainMenuSlug(request()->main_menu)) {
                $validate->errors()->add('main_menu', 'Main menu already exist');
            }
        });

        $menu = Menu::create([
            'main_menu' => $request->main_menu,
            'icon' => $request->icon,
            'content' => $request->content,
            'main_menu_slug' => strToSlug($request->main_menu)
        ]);

        flash('Service was created successfully');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $menu = Menu::findOrFail($id);
        $validate = Validator::make(request()->all(), [
            'main_menu' => "required|unique:menus,main_menu,$id|max:255",
            'content' => "required",
            'icon' => "required"
        ]);

        $menu->update([
            'main_menu' => $request->main_menu,
            'icon' => $request->icon,
            'content' => $request->content,
            'main_menu_slug' => strToSlug($request->main_menu)
        ]);

        flash('Service was updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        
        flash('Service was deleted successfully!');
        
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $menus = Menu::onlyTrashed();
        $menu = $menus->findOrFail($id);

        if($menu->deleted_at != NULL){
            $menu->restore();
        }

        flash('Service was restored successfully!');

        return back();
        
    }

    private function validateMainMenuSlug($str)
    {
        $menu = Menu::where('main_menu_slug', \strToSlug($str))->first();
        if($menu){
            return false;
        }
        return true;
    }
}
