<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $users = User::paginate(10);
        return view('admin.user.index', compact('users', 'auth'));
    }

    /**
     *
     * Display the user auth profile
     */
    public function profile()
    {
        $user = auth()->user();
        $user_id = $user->id;

        $profile = User::find($user_id);
        return view('admin.profile', compact('profile', 'auth'));
    }


    /**
     *
     * Update the user auth profile
     */

    public function update_profile(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email, $user->id",
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password') && $request->password !== null){
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('photo')){
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/users/', $image_new_name);
            $user->photo = '/storage/users/'.$image_new_name;
        }

        $user->save();
        Session::flash('success', 'Le profil a été modifié avec succès');

        return view('admin.profile');
    }

    public function update_profile_r(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email, $user->id",
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password') && $request->password !== null){
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('photo')){
            $photo = $request->photo;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/users/', $image_new_name);
            $user->photo = '/storage/users/'.$image_new_name;
        }

        $user->save();
        Session::flash('success', 'Le profil a été modifié avec succès');

        return view('resp.profile');
    }

    public function update_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nouveau_mot_de_passe' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('user.profile').'#settings')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = auth()->user();
        if(Hash::check($request->nouveau_mot_de_passe, $user->password)){
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            Session::flash('success', 'Le mot de passe a été mis à jour');
            return redirect()->to(route('user.profile').'#settings');
        } else{
            Session::flash('warning', 'L\'ancien mot de passe ne correspond pas');
            return redirect()->to(route('user.profile').'#settings');
        }
    }

    public function update_password_r(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nouveau_mot_de_passe' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('user.profile').'#settings')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = auth()->user();
        if(Hash::check($request->nouveau_mot_de_passe, $user->password)){
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            Session::flash('success', 'Le mot de passe a été mis à jour');
            return redirect()->to(route('resp.profile').'#settings');
        } else{
            Session::flash('warning', 'L\'ancien mot de passe ne correspond pas');
            return redirect()->to(route('resp.profile').'#settings');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = auth()->user();
        return view('admin.user.create', compact('auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'type' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        Session::flash('success', 'Un nouveau utilisateur a été crée avec succès');
        return redirect()->route('utilisateur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = auth()->user();
        $user = User::where('id',$id)->first();
        return view('admin.user.edit', compact('user', 'auth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
            'type' => 'required',
            'password' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', 'L\'utilisateur a été modifié avec succès');
        return redirect()->route('utilisateur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        if($user != null){
            $user->delete();
            Session::flash('success', 'L\'utilisateur a été supprimé avec succès');
            return redirect()->route('utilisateur.index');
        }
    }
}
