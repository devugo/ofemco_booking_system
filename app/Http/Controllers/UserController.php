<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a user photo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return back to the previous page
    */
    public function add_photo(Request $request)
    {
        $validate = $this->validate($request, [
            'photo' => 'image|required'
        ]);
        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('photo')->storeAs('public/images/photos', $fileNameToStore);
            if(auth()->user()->photo !== NULL){
                unlink(public_path() . '/storage/images/photos/' . auth()->user()->photo);
            }
            auth()->user()->update([
                "photo" => $fileNameToStore
            ]);
        }

        flash('Profile image was added successfully');
        return back();
    }

    public function create(Request $request)
    {
        $validate = $this->validate($request, [
            'email' => "bail|required|unique:users|max:100",
            'username' => "bail|required|unique:users|max:100",
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'othernames' => 'nullable|max:150',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|max:20',
        ]);
        User::create([
            'email' => $validate['email'],
            'username' => $validate['username'],
            'firstname' => $validate['firstname'],
            'lastname' => $validate['lastname'],
            'othernames' => $validate['othernames'],
            'date_of_birth' => $validate['date_of_birth'],
            'phone' => $validate['phone'],
            'password' => Hash::make($request->input('password')),
            'role_id' => 2
        ]);

        flash('User was created successfully');

        return back();
    }

     /**
     * @param Request $request
     * @return back to the previous page
     */
    public function update($id = null, Request $request)
    {
        $userId;
        if(!$id){
            $userId = auth()->user()->id;
        }else if(auth()->user()->role_id === 1){
            $userId = $id;
        }else{
            return back();
        }

        // return $userId;
        
        $validate = $this->validate($request, [
            'username' => "bail|required|unique:users,username,$userId|max:100",
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'othernames' => 'nullable|max:150',
            'phone' => 'nullable|max:20',
        ]);
        
        if(!$id){
            auth()->user()->update($validate);
        }else{
            $user = User::findOrFail($userId);
            $user->update($validate);
        }
        
        flash('Profile details was updated successfully');
        return back();
    }

    public function change_password(Request $request)
    {
        $vlidate = $this->validate($request, [
            'password' => 'required',
            'old_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if(!password_verify($request->input('old_password'), auth()->user()->password)){
            flash('Invalid old password', 'danger');
        }else if($request->input('password') != $request->input('confirm_password')){
            flash('Confirm password does not match new password', 'danger');
        }else{
            auth()->user()->update([
                'password' => Hash::make($request->input('password')),
            ]);
            flash('Password was changed successfully', 'success');
        }

        return back();
    }

    public function destroy($id)
    {
        // return $id;
        $user = User::findOrFail($id);
        $user->delete();
        
        flash('User was deleted successfully!');
        
        return back();
    }

    public function restore($id)
    {
        // return $id;
        $users = User::onlyTrashed();
        $user = $users->findOrFail($id);

        if($user->deleted_at != NULL){
            $user->restore();
        }

        flash('User was restored successfully!');

        return back();
        
    }

    public function verify_now($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'email_verified_at' => new \DateTimeImmutable()
        ]);

        flash('User was verified successfully!');

        return back();
    }

    public function resend_verify_email($id)
    {
        $user = User::findOrFail($id);

        $user->sendEmailVerificationNotification();

        flash('Verification email was sent successfully!');

        return back();
    }
}
