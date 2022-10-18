<?php

namespace App\Http\Middleware;

use App\Models\M_EntryProgress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class entry_progress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $countSemsester = M_EntryProgress::where('nim', Auth::user()->nim_nip)->count();
        if (M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)
            ->where('is_irs', 0)->exists()
        ) {
            return redirect()->route('irs.index');
        } else if (M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)
            ->where('is_khs', 0)->exists()
        ) {
            return redirect()->route('khs.index');
        } else if (M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)
            ->where('is_pkl', 0)->exists()
        ) {
            return redirect()->route('pkl.index');
        } else if (M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)
            ->where('is_skripsi', 0)->exists()
        ) {
            return redirect()->route('skripsi.index');
        } else {
            return $next($request);
        }
    }
}