<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'company_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'company_name' => $request->company_name,
            'role' => 'user',
        ]);

        // Kullanıcıya özel veritabanı oluştur
        $this->createDatabaseForUser($user);

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    private function createDatabaseForUser(User $user)
    {
        $databaseName = 'company_' . $user->id;

        \DB::statement("CREATE DATABASE `$databaseName`");

        // .env içine ekleme (dynamic DB connection için)
        $this->updateEnvFile($databaseName);
    }

    private function updateEnvFile($databaseName)
    {
        $envPath = base_path('.env');
        $env = file_get_contents($envPath);

        // Yeni DB bağlantısını ekle
        $newEnv = $env . "\nDB_DATABASE_$databaseName=$databaseName\n";

        file_put_contents($envPath, $newEnv);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Kullanıcıya özel veritabanı oluştur
        $this->createUserDatabase($user->id);

        return response()->json(['message' => 'Kullanıcı oluşturuldu.'], 201);
    }

    private function createUserDatabase($userId)
    {
        $databaseName = "user_db_{$userId}";
        \DB::statement("CREATE DATABASE {$databaseName}");
    }
}
