<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // إذا المستخدم غير مسجّل الدخول
            return redirect('/login');
        }

        $user = Auth::user();

        // تحقق إذا دور المستخدم موجود ضمن الأدوار المسموح بها
        if (!in_array($user->role, $roles)) {
            abort(403, 'ليس لديك صلاحية الدخول لهذه الصفحة');
        }

        return $next($request);
    }
}
