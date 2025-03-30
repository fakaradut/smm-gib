@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Yeni Kullanıcı Oluştur</h2>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>İsim</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Şirket Adı</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Kullanıcı Oluştur</button>
        </form>
    </div>
@endsection
