<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller {

    public function show(User $user): View
    {

        $user->load('tutorials', 'articles', 'manuals');

        return view("profile.show", compact("user"));
    }


    public function edit(User $user): View
    {

        $this->authorize('update', $user);

        return view("profile.edit", compact("user"));
    }


    public function update(UpdateProfileRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'name'             => $request->name,
            'email'            => $request->email,
            'date_of_birth'    => $request->date_of_birth,
            'personal_website' => $request->personal_website,
            'bio'              => $request->bio,
        ]);

        return redirect()->route('profile.edit', $user)->with('success', 'تم تعديل الحساب بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
