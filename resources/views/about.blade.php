@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

    <style>
        body {
            background: #fdf8f0;
        }

        .about-hero {
            background: linear-gradient(135deg, #ece4dd 0%, #f4ece4 100%);
            border-radius: 12px;
            padding: 3rem 2rem;
            margin-top: 2rem;
            text-align: center;
        }

        .about-hero h1 {
            color: #4a3f35;
            font-weight: 800;
            font-size: 2.2rem;
        }

        .about-hero p {
            color: #8a7d72;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0.8rem auto 0;
        }

        .about-section {
            margin-top: 2.5rem;
        }

        .about-section h2 {
            color: #4a3f35;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .about-section p {
            color: #6b5f54;
            line-height: 1.7;
        }

        .about-photo {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(74, 63, 53, 0.08);
            margin-bottom: 0;
            object-fit: cover;
            max-height: 380px;
        }

        .value-card {
            border: 1px solid #e5dcd3;
            border-radius: 8px;
            box-shadow: 0 4px 14px rgba(74, 63, 53, 0.05);
            background-color: #ffffff;
            padding: 1.5rem;
            height: 100%;
            text-align: center;
        }

        .value-card .icon {
            font-size: 2rem;
            color: #b98a8f;
            margin-bottom: 0.8rem;
        }

        .value-card h5 {
            color: #4a3f35;
            font-weight: 700;
        }

        .value-card p {
            color: #8a7d72;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .contact-box {
            background-color: #ece4dd;
            border-radius: 8px;
            padding: 2rem;
            margin-top: 2.5rem;
            text-align: center;
        }

        .contact-box h3 {
            color: #4a3f35;
            font-weight: 700;
        }

        .contact-box p {
            color: #6b5f54;
        }

        .contact-box .contact-icon {
            margin-right: 6px;
        }
    </style>

    <div class="container">

        <div class="about-hero">
            <h1>Resta Thrift</h1>
            <p>
                Baju bekas layak pakai, dipilih satu-satu biar kamu gak nemu barang KW atau cacat pas dibuka.
            </p>
        </div>

        <div class="about-section">
            <h2>Awal Mulanya</h2>

            <div class="row align-items-center g-4">
                <div class="col-md-5">
                    <img src="{{ asset('images/tokoresta.png') }}" alt="Suasana toko Resta Thrift" class="about-photo">
                </div>
                <div class="col-md-7">
                    <p class="mb-0">
                        Resta Thrift awalnya cuma iseng jualan baju-baju bekas yang udah jarang dipakai. Ternyata
                        responnya lumayan, banyak yang suka sama modelnya, jadi lama-lama mulai serius cari
                        barang dari berbagai sumber buat dijual lagi. Sampai sekarang kami masih pegang prinsip
                        yang sama dari awal barang yang dijual harus barang yang kami sendiri mau pakai.
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section">
            <h2>Kenapa Belanja di Sini</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon">✓</div>
                        <h5>Dicek Dulu</h5>
                        <p>Tiap baju dicek satu-satu, kalau ada noda atau sobek gak bakal masuk stok.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon">♻</div>
                        <h5>Lebih Hemat, Lebih Bijak</h5>
                        <p>Baju masih bagus tapi jarang kepake orang lain, daripada numpuk jadi sampah tekstil.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon">💰</div>
                        <h5>Harga Bersahabat</h5>
                        <p>Model kekinian, harga gak bikin mikir dua kali.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-box">
            <h3>Mau Tanya-tanya?</h3>
            <p>
                Chat aja langsung, biasanya fast response kok.
            </p>
            <p class="mb-0"><strong>WhatsApp:</strong> 085624509522</p>
            <p><strong>Instagram:</strong> @restathrift</p>
            <p class="mb-0"><strong>Alamat:</strong></p>
            <p>Jl. Golempang Rt01/Rw07, Kelurahan Sukajaya, Kecamatan Purbaratu, Kota Tasikmalaya, </p>
        </div>

    </div>

@endsection