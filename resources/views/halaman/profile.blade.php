@extends('layout/aplikasi')

@section('konten')
<style>
    /* Container utama untuk profile */
    .profile-container {
        width: 60%;
        max-width: 800px;
        margin: 30px auto; /* Margin auto untuk membuat konten berada di tengah */
        padding: 20px;
        border-radius: 10px;
        background-color: #1a1a1a;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
    }

    /* Header Profil */
    .profile-header {
        text-align: center;
        color: yellowgreen;
    }

    .profile-header h2 {
        font-size: 2.2em;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .profile-header p {
        font-size: 1.2em;
        color: #ddd;
        margin-bottom: 20px;
    }

    /* Styling untuk detail profile menggunakan grid layout */
    .profile-details {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 15px;
        margin-top: 20px;
        font-size: 1.1em;
    }

    .profile-details div {
        margin-bottom: 20px;
    }

    .profile-details div label {
        font-weight: bold;
        color: yellowgreen;
    }

    .profile-details div span {
        color: #f0f0f0;
    }

    /* Styling untuk tombol edit profil */
    .profile-button {
        display: block;
        width: 200px;
        margin: 30px auto 0;
        padding: 12px;
        background-color: yellowgreen;
        color: white;
        text-align: center;
        border-radius: 5px;
        font-size: 1.2em;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .profile-button:hover {
        background-color: #2e8b57;
    }

    /* Responsive Styles untuk tampilan di perangkat mobile */
    @media (max-width: 768px) {
        .profile-container {
            width: 90%;
        }

        .profile-details {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h2>Profil Pengguna</h2>
        <p>Informasi akun Anda</p>
    </div>

    <div class="profile-details">
        <div>
            <label>Nama:</label>
            <span>{{ $user->name }}</span>
        </div>
        <div>
            <label>Email:</label>
            <span>{{ $user->email }}</span>
        </div>
        <div>
            <label>Username:</label>
            <span>{{ $user->username ?? 'Belum diatur' }}</span>
        </div>
        <div>
            <label>Alamat:</label>
            <span>{{ $user->alamat ?? 'Alamat belum diisi' }}</span>
        </div>
    </div>

    {{-- <a href="{{ route('edit.profile') }}" class="profile-button">Edit Profil</a> --}}
</div>

@endsection
