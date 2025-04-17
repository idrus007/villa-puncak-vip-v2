@extends('layouts.app')

@section('content')
    @include('components.hero')
    
    <div class="bg-white">
        <div class="mx-auto w-full max-w-7xl">
            <div class="flex flex-col gap-4 bg-white p-8">
                <div class="mx-auto flex w-full max-w-lg flex-col items-center justify-center text-center">
                    <h2 class="text-4xl font-semibold text-black">Kenapa Pilih Kami?</h2>
                    <p class="pt-3 text-lg text-gray-600">
                        Kami menawarkan pengalaman menginap yang nyaman dan eksklusif dengan pelayanan terbaik serta fasilitas mewah di Villa Puncak VIP
                    </p>
                </div>
    
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                    <div class="flex flex-col items-center justify-center p-6 text-center">
                        <img src="/images/img.png" alt="Payment Icon" class="mb-4 h-28" />
                        <h2 class="text-xl font-semibold text-gray-800">Metode Pembayaran</h2>
                        <p class="mt-2 text-gray-600">Kami menyediakan metode pembayaran DP dan lunas yang mudah digunakan</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 text-center">
                        <img src="/images/img2.png" alt="Simple search Icon" class="mb-4 h-28" />
                        <h2 class="text-xl font-semibold text-gray-800">Simpel & Mudah</h2>
                        <p class="mt-2 text-gray-600">
                            Proses booking cepat dan praktis. Pilih tanggal, konfirmasi, dan selesaikan pemesanan dalam beberapa langkah saja
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 text-center">
                        <img src="/images/img3.png" alt="Support Icon" class="mb-4 h-28" />
                        <h2 class="text-xl font-semibold text-gray-800">Dukungan 24/7</h2>
                        <p class="mt-2 text-gray-600">
                            Butuh bantuan? Kami siap membantu kapan saja! Hubungi kami melalui nomor yang tertera di bagian kontak
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 text-center">
                        <img src="/images/img4.png" alt="Friendly Icon" class="mb-4 h-28" />
                        <h2 class="text-xl font-semibold text-gray-800">Ramah & Profesional</h2>
                        <p class="mt-2 text-gray-600">
                            Bukan sekadar janji, kami memberikan pengalaman terbaik dengan layanan yang benar-benar meyakinkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white">
        <div class="mx-auto w-full max-w-5xl">
            <div class="flex flex-col gap-4 bg-white p-8">
                <div class="mx-auto flex w-full max-w-lg flex-col items-center justify-center text-center">
                    <h2 class="text-4xl font-semibold text-black">Tujuan Kami</h2>
                    <p class="pt-3 text-lg text-gray-600">
                        Memberikan pengalaman menginap yang nyaman dan eksklusif dengan pelayanan terbaik serta fasilitas lengkap di Villa VIP Puncak
                    </p>
                </div>
    
                <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2">
                    <div class="space-y-4 rounded-md border border-gray-300 bg-white p-8">
                        <h2 class="text-xl font-semibold">Misi Kami</h2>
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Memberikan Kenyamanan Terbaik</h2>
                                    <p class="text-sm text-gray-500">
                                        Menyediakan fasilitas dan layanan terbaik agar setiap tamu merasa nyaman seperti di rumah sendiri.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Mengutamakan Kebersihan dan Keamanan</h2>
                                    <p class="text-sm text-gray-500">
                                        Menjaga kebersihan dan keamanan villa dengan standar tinggi untuk memastikan pengalaman menginap yang menyenangkan.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Menyediakan Pelayanan Ramah dan Profesional</h2>
                                    <p class="text-sm text-gray-500">
                                        Selalu memberikan pelayanan terbaik dengan sikap yang ramah dan profesional kepada setiap tamu.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Mewujudkan Pengalaman Menginap yang Tak Terlupakan</h2>
                                    <p class="text-sm text-gray-500">
                                        Menyediakan suasana yang tenang dan fasilitas premium untuk menciptakan pengalaman menginap yang berkesan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 rounded-md border border-gray-300 bg-white p-8">
                        <h2 class="text-xl font-semibold">Keunggulan Kami</h2>
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Lokasi Strategis</h2>
                                    <p class="text-sm text-gray-500">
                                        Dekat dengan berbagai destinasi wisata terbaik di Puncak untuk pengalaman liburan yang sempurna.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Fasilitas Lengkap</h2>
                                    <p class="text-sm text-gray-500">
                                        Kolam renang, taman bermain, area BBQ, dan fasilitas premium lainnya untuk kenyamanan tamu.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Lingkungan Asri</h2>
                                    <p class="text-sm text-gray-500">
                                        Suasana alam yang sejuk dan hijau, ideal untuk melepas penat dan menikmati ketenangan.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-md font-medium">Pelayanan 24 Jam</h2>
                                    <p class="text-sm text-gray-500">
                                        Tim kami siap membantu kebutuhan tamu kapan saja untuk memastikan kenyamanan maksimal.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white">
        <div class="mx-auto w-full max-w-6xl">
            <div class="flex items-center justify-center bg-white p-4">
                <div class="flex flex-col items-center justify-center gap-4 text-center">
                    <div class="mx-auto flex w-full max-w-lg flex-col items-center justify-center text-center">
                        <h2 class="text-4xl font-semibold text-black">Bagaimana cara kerja layanan kami</h2>
                        <p class="pt-3 text-lg text-gray-600">Kami Memberikan Langkah Kerja Yang Mudah</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                        <div class="flex flex-col items-center justify-center rounded-xl border border-gray-300 p-6 text-center">
                            <h2 class="mb-4 text-5xl font-bold text-yellow-500">01</h2>
                            <h2 class="text-xl font-semibold text-gray-800">Isi Identitas</h2>
                            <p class="mt-2 text-gray-600">Isi data pribadi seperti nama, nomor telepon, dan alamat email.</p>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded-xl border border-gray-300 p-6 text-center">
                            <h2 class="mb-4 text-5xl font-bold text-yellow-500">02</h2>
                            <h2 class="text-xl font-semibold text-gray-800">Pilih Tanggal</h2>
                            <p class="mt-2 text-gray-600">Tentukan tanggal check-in dan check-out sesuai rencana Anda.</p>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded-xl border border-gray-300 p-6 text-center">
                            <h2 class="mb-4 text-5xl font-bold text-yellow-500">03</h2>
                            <h2 class="text-xl font-semibold text-gray-800">Lakukan Pembayaran</h2>
                            <p class="mt-2 text-gray-600">Pilih metode pembayaran dan selesaikan transaksi dengan aman.</p>
                        </div>
                        <div class="flex flex-col items-center justify-center rounded-xl border border-gray-300 p-6 text-center">
                            <h2 class="mb-4 text-5xl font-bold text-yellow-500">04</h2>
                            <h2 class="text-xl font-semibold text-gray-800">Nikmati Penginapan</h2>
                            <p class="mt-2 text-gray-600">Check-in dan nikmati pengalaman menginap yang nyaman dan eksklusif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
