<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        if (!$user->role) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'No tienes un rol asignado.');
        }
    
        // Validar que el rol tiene una ruta definida
        $dashboardRoutes = [
            'admin' => 'admin.dashboard',
            'vendedor' => 'vendedor.dashboard',
        ];
    
        if (!isset($dashboardRoutes[$user->role->nombre])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Rol no válido.');
        }
    
        return redirect()->route($dashboardRoutes[$user->role->nombre]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
