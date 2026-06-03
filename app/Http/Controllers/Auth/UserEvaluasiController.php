<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluasiUser;
use App\Models\ref_pegawais;

class UserEvaluasiController extends Controller
{
    public function index()
    {
        return view('MenuUmum.EvaluasiPasca.homepage');
    }

    public function showRegisterForm()
    {
        return view('MenuUmum.EvaluasiPasca.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'email' => 'required|email',
            'nama' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'tanggal_lahir' => 'required|date',
        ]);

        // Check if user already exists with this NIP
        $exists = EvaluasiUser::where('nip', $request->nip)->exists();

        if ($exists) {
            return back()->with('error', 'User dengan NIP ini sudah terdaftar. Silakan login.');
        }

        EvaluasiUser::create([
            'nip' => $request->nip,
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('EvaluasiPasca.homepage')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showForgotPasswordForm()
    {
        return view('MenuUmum.EvaluasiPasca.forgot_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = EvaluasiUser::where('nip', $request->nip)
                            ->where('email', $request->email)
                            ->where('tanggal_lahir', $request->tanggal_lahir)
                            ->first();

        if (!$user) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('EvaluasiPasca.homepage')->with('success', 'Password berhasil diubah. Silakan login.');
        }

        return back()->with('error', 'Silakan masukkan password baru.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        // Authentication is now solely based on NIP and Password
        if (Auth::guard('evaluasi')->attempt([
            'nip' => $request->nip,
            'password' => $request->password
        ])) {

            $user = Auth::guard('evaluasi')->user();

            // Populate Session
            session([
                'user_id'      => $user->id,
                'user_nip'     => $user->nip,
                'user_role'    => $request->role,
                'user_name'    => $user->nama,
            ]);

            // Redirect based on role
            $redirectUrl = match ($request->role) {
                'alumni' => route('dashboard.alumni'),
                'atasan' => route('dashboard.atasan'),
                'rekan'  => route('dashboard.rekan'),
                'rekan_kerja' => route('dashboard.rekan'),
                default  => route('EvaluasiPasca.homepage'),
            };

            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login gagal. Periksa NIP dan Password Anda.'
        ]);
    }

    public function logout()
    {
        Auth::guard('evaluasi')->logout();
        session()->flush();

        return redirect()->route('EvaluasiPasca.homepage');
    }

    public function alumni()
    {
        if (!session()->has('user_nip')) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session('user_nip');
        $userId = session('user_id');

        $ref_pegawai = ref_pegawais::where('nip', $nip)->first();
        $evaluasiUser = EvaluasiUser::find($userId);

        if (!$ref_pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Data alumni tidak ditemukan di database pegawai.');
        }

        return view(
            'MenuUmum.EvaluasiPasca.dashboard.alumni',
            compact('ref_pegawai', 'evaluasiUser')
        );
    }

    public function atasan()
    {
        if (!session()->has('user_nip')) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session('user_nip');
        $userId = session('user_id');

        $ref_pegawai = ref_pegawais::where('nip', $nip)->first();
        $evaluasiUser = EvaluasiUser::find($userId);

        if (!$ref_pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Data atasan tidak ditemukan di database pegawai.');
        }

        return view(
            'MenuUmum.EvaluasiPasca.dashboard.atasan',
            compact('ref_pegawai', 'evaluasiUser')
        );
    }

    public function rekan()
    {
        if (!session()->has('user_nip')) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $nip = session('user_nip');
        $userId = session('user_id');

        $ref_pegawai = ref_pegawais::where('nip', $nip)->first();
        $evaluasiUser = EvaluasiUser::find($userId);

        if (!$ref_pegawai) {
            return redirect()->route('EvaluasiPasca.homepage')
                ->with('error', 'Data rekan kerja tidak ditemukan di database pegawai.');
        }

        return view(
            'MenuUmum.EvaluasiPasca.dashboard.rekan',
            compact('ref_pegawai', 'evaluasiUser')
        );
    }
}
