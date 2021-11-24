<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function update(UpdateProfileRequest $request, User $user): RedirectResponse
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

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if ( ! Hash::check($value, $user->password)) {
                    return $fail('كلمة المرور الحالية غير صحيحة');
                }
            }],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect("user/{$user->id}/edit#profile-edit-password")
                ->withErrors($validator);
        }

        $user->update([
            "password" => Hash::make($request->password)
        ]);

        return redirect()->route('profile.edit', $user)->with('success', 'تم تعديل الحساب بنجاح.');
    }


    public function updatePicture(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'profile_image'     => "required|image|mimes:jpeg,jpg,png|max:40000",
        ]);

        if ($validator->fails()) {
            return redirect("user/{$user->id}/edit#profile-edit-picture")
                ->withErrors($validator);
        }

        $user->update([
            "profile_image" => $request->profile_image->store('profiles', 's3')
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
