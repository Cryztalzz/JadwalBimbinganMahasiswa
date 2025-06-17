@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Frequently Asked Questions (FAQ)</h4>
        </div>
        <div class="card-body">
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Bagaimana cara membuat jadwal bimbingan?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk membuat jadwal bimbingan, ikuti langkah berikut:
                            <ol>
                                <li>Login ke akun Anda</li>
                                <li>Klik tombol "Buat Jadwal Baru"</li>
                                <li>Atau buka menu "Lihat Semua Jadwal" dan klik tombol "Buat Jadwal Baru"</li>
                                <li>Isi form jadwal dengan lengkap</li>
                                <li>Klik "Simpan" untuk menyimpan jadwal</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana cara membatalkan jadwal bimbingan?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk membatalkan jadwal bimbingan:
                            <ol>
                                <li>Buka menu "Lihat Semua Jadwal"</li>
                                <li>Cari jadwal yang ingin dibatalkan</li>
                                <li>Klik tombol "Batalkan" pada jadwal tersebut</li>
                                <li>Konfirmasi pembatalan</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bagaimana jika saya lupa password?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Jika Anda lupa password:
                            <ol>
                                <li>Hubungi admin untuk mengubah password :)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 