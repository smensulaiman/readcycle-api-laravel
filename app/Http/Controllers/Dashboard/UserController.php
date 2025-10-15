<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function profile()
    {
        $user = Auth::user();
        $user->load(['books.category']);
        
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle password hashing
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                $data['profile_picture'] = $this->fileUploadService->updateProfilePicture(
                    $request->file('profile_picture'),
                    $user->profile_picture
                );
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['profile_picture' => 'Profile picture upload failed: ' . $e->getMessage()])
                    ->withInput();
            }
        }

        $user->update($data);

        return redirect()->route('dashboard.profile')
            ->with('success', 'Profile updated successfully!');
    }
}
