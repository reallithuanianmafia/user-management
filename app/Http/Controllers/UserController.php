<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;


use Tinify\Tinify;

class UserController extends Controller
{
    public function __construct()
    {
        // Tinify API key initialization
        Tinify::setKey(env('TINIFY_API_KEY'));
    }

    /**
     * Display a paginated list of users.
     */
    public function index(Request $request)
    {
        $users = User::paginate(6); // Fetch 6 users per page
        return response()->json($users);
    }

    /**
     * Store a newly created user in storage with image handling.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Create the user with the validated data
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
        // Check if a profile image was uploaded
        if ($request->hasFile('profile_image')) {
            // Get the uploaded image
            $image = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('images/' . $filename);
    
            // Initialize the Intervention Image Manager with the GD driver
            $manager = new ImageManager(['driver' => 'gd']);
    
            // Resize the image and save it to the specified path
            $manager->make($image->getRealPath())
                    ->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio(); // Maintain aspect ratio
                        $constraint->upsize();      // Prevent upsizing
                    })
                    ->save($path);
    
            // Save the image path in the user's profile
            $user->update(['profile_image' => 'images/' . $filename]);
        }
    
        // Redirect back with a success message
        return back()->with('success', 'User created successfully.');
    }

    
    

}
