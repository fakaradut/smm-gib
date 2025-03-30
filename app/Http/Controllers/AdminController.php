<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    public function createUser(Request $request) {
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

    private function createUserDatabase($userId) {
        $databaseName = "user_db_{$userId}";
        \DB::statement("CREATE DATABASE {$databaseName}");
    }
}
