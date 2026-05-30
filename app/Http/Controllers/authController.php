<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\File; 
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    public function index()
    {
        return view('auth.index'); 
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');
        
        // Memanggil stateless aman dari warning Intelephense & mencegah InvalidStateException
        $user = $driver->stateless()->user();
        
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $avatar = $user->avatar; 

        // Proses mengunduh dan menyimpan avatar secara lokal
        $avatar_file = $id . ".jpg";
        $fileContent = file_get_contents($avatar);
        
        // Pastikan folder tujuan ada sebelum menyimpan file
        $destinationPath = public_path("admin/images/faces");
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }
        
        // Menyimpan file foto ke folder public/admin/images/faces/
        File::put($destinationPath . "/" . $avatar_file, $fileContent);

        // UPDATE: Langsung gunakan updateOrCreate tanpa pengecekan count().
        // Jika data email Anda hilang akibat migrate:fresh, Laravel otomatis membuatkannya kembali (Auto-Register).
        $userModel = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'google_id' => $id,
                'avatar' => $avatar_file 
            ]
        );

        // Daftarkan session login user resmi di Laravel
        Auth::login($userModel);

        return redirect()->to('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->to('auth');
    }
}