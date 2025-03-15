<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Email untuk Registrasi Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #3e8e41;
        }

        .footer {
            background-color: #f9f9f9;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
@php
    $url = url("/register/verify/{$user->email}/" . md5($user->email));
@endphp

<body>
    <div class="container">
        <div class="header">
            <h2>Konfirmasi Email untuk Registrasi Akun</h2>
        </div>
        <div class="content">
            <p>Selamat Datang di {{ env('MAIL_FROM_NAME') }}!</p>
            <p>Kami senang Anda telah memilih untuk bergabung dengan kami. Untuk memastikan bahwa Anda dapat menggunakan
                akun Anda dengan lancar, kami perlu Anda untuk mengkonfirmasi alamat email Anda.</p>
            <p><a href="{{ $url }}" class="button">Konfirmasi Email
                    Sekarang</a></p>
            <p>Informasi Akun Anda:</p>
            <ul>
                <li>Nama Pengguna: {{ $user->name }}</li>
                <li>Alamat Email: {{ $user->email }}</li>
            </ul>
            <p>Apa yang Terjadi Setelah Konfirmasi?</p>
            <p>Setelah Anda mengkonfirmasi alamat email Anda, Anda akan dapat menggunakan akun Anda untuk mengakses
                semua fitur dan layanan kami.</p>
        </div>
        <div class="footer">
            <p>Bantuan dan Pertanyaan</p>
            <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi kami di [Alamat Email Bantuan]
                atau kunjungi halaman bantuan kami di [URL Halaman Bantuan].</p>
            <p>Terima kasih telah bergabung dengan kami!</p>
            <p>Tim {{ env('MAIL_FROM_NAME') }}</p>
        </div>
    </div>
</body>

</html>
