<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:farmer,buyer',
            'city'     => 'required|string|max:255',
            'state'    => 'required|string|max:255',
            'pincode'  => 'required|string|max:20',
            'address'  => 'required|string|max:500',
        ]);

        $email        = $request->email;
        $selectedRole = $request->role;

        // One registration per email+role combination
        $alreadyExists = User::where('email', $email)
                             ->where('role', $selectedRole)
                             ->exists();

        if ($alreadyExists) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => "An account already exists for this email as a {$selectedRole}. Please log in instead."
                ]);
        }

        // Create independent account for this role
        User::create([
            'name'     => $request->name,
            'email'    => $email,
            'password' => Hash::make($request->password),
            'role'     => $selectedRole,
            'city'     => $request->city,
            'state'    => $request->state,
            'pincode'  => $request->pincode,
            'address'  => $request->address,
        ]);

        // Redirect to login with a success message
        return redirect('/login')->with('success', "Registration successful! You are now registered as a {$selectedRole}. Please log in below.");
    }

    // ─── Login ────────────────────────────────────────────────────────────────

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required|string',
            'role'     => 'nullable|in:farmer,buyer',
        ]);

        $selectedRole = $request->role;

        // If no role is selected, attempt admin login
        if (empty($selectedRole)) {
            $user = User::where('email', $request->email)
                        ->where('role', 'admin')
                        ->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Invalid admin credentials. If you are a farmer or buyer, please select a role.']);
            }

            Auth::login($user, $request->boolean('remember'));
            return redirect('/dashboard/admin');
        }

        // Standard farmer/buyer login
        $user = User::where('email', $request->email)
                    ->where('role', $selectedRole)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('email', 'role'))
                ->withErrors(['email' => 'Invalid credentials for this role. Please check your email, role, and password.']);
        }

        // Check if account is suspended
        if ($user->is_suspended) {
            return back()
                ->withInput($request->only('email', 'role'))
                ->withErrors(['email' => 'Your account has been suspended by the platform administrator. Please contact support for assistance.']);
        }

        Auth::login($user, $request->boolean('remember'));

        return $selectedRole === 'farmer'
            ? redirect('/dashboard/farmer')
            : redirect('/dashboard/buyer');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}


