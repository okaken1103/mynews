<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profiles;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    public function create(Request $request)
    {
        $this->validate($request, Profiles::$rules);
        
        $plofiles = new Profiles;
        $form = $request->all();
        
        unset($form['_token']);
         
        $plofiles->fill($form);
        $plofiles->save();
        
        return redirect('admin/profile/create');
    }
    public function edit(Request $request)
    {
        $profiles = Profiles::find($request->id);
        if (empty($profiles))
        {
            abort(404);
        }
        return view('admin.profile.edit', ['profiles_form' => $profiles]);
    }
     public function update(Request $request)
    {
        $this->validate($request, Profiles::$rules);
        $profiles = Profiles::find($request->id);
        $profiles_form = $request->all();

        unset($profiles_form['_token']);

        $profiles->fill($profiles_form)->save();

        return redirect('admin/profile/edit',);
    }
}
