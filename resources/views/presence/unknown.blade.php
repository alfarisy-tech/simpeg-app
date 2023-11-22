@extends('layouts.index')
@section('content')
    @push('css')
        <style>
            .absen-button {
                display: inline-flex;
                /* Menggunakan display: flex untuk mengatur pusat vertikal */
                align-items: center;
                /* Mengatur pusat vertikal */
                justify-content: center;
                /* Mengatur pusat horizontal */
                padding: 20px;
                font-size: 16px;
                text-align: center;
                text-decoration: none;
                border-radius: 50%;
                background-color: #4CAF50;
                color: #fff;
                height: 35vh;
                width: 35vh;
                cursor: pointer;
            }

            .absen-button:hover {
                background-color: #45a049;
                list-style: none;
                text-decoration: none;
                color: #fff
                    /* Warna latar belakang tombol saat dihover */
            }
        </style>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    @endpush
    <div class="container-xl px-4 mt-4">
        <div class="row mb-5">
            <div class="col-12">
                <video hidden style="width: 50%" id="preview"></video>
            </div>
            <div class="col-12 text-center">
                <a href="#" class="absen-button fw-bold text-lg">ABSEN MASUK</a>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan Absen

                    </h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            @php
                                $date = date('Y-m-d');
                                $time = date('H:i:s');
                            @endphp
                            <input type="text" class="form-control" id="content">
                            <input type="text" class="form-control" value="{{ $date }}">
                            <input type="text" class="form-control" value="{{ $time }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Absen</button>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=geometry">
        </script>
        <script>
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });

            scanner.addListener('scan', function(content) {
                // Pilih elemen modal
                const modal = document.querySelector('#exampleModal');

                // Perbarui konten modal dengan konten yang dipindai
                modal.querySelector('#content').value = content;

                // Tampilkan modal
                const bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();

            });

            Instascan.Camera.getCameras().then(function(cameras) {

                if (cameras.length > 0) {

                    scanner.start(cameras[0]);

                } else {

                    console.error('No cameras found.');

                }

            }).catch(function(e) {

                console.error(e);

            });

            function cekRadius(targetLatitude, targetLongitude, radius) {
                if ("geolocation" in navigator) {
                    // Mendapatkan posisi perangkat
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Mendapatkan koordinat latitude dan longitude perangkat
                        var userLatitude = position.coords.latitude;
                        var userLongitude = position.coords.longitude;

                        // Membuat objek LatLng untuk kedua titik
                        var userLatLng = new google.maps.LatLng(userLatitude, userLongitude);
                        var targetLatLng = new google.maps.LatLng(targetLatitude, targetLongitude);

                        // Menggunakan fungsi geometry library untuk menghitung jarak
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng,
                            targetLatLng);
                        const absenButton = document.querySelector('.absen-button');
                        const scan = document.querySelector('#preview');
                        console.log(userLatitude + "," + userLongitude)
                        console.log(distance);
                        // Mengecek apakah jarak dalam radius yang ditentukan
                        if (distance <= radius) {
                            console.log("Perangkat berada dalam radius " + radius + " meter.");
                            scan.hidden = false;
                        } else {
                            console.log("Perangkat berada di luar radius " + radius + " meter.");
                            // ubah tulisan absenButton
                            absenButton.innerHTML = 'Anda Berada di luar radius';
                            absenButton.classList.add('bg-danger');
                            scan.hidden = true;
                        }
                    });
                } else {
                    console.log("Geolocation tidak didukung di browser ini.");
                }
            }
            // Contoh pemanggilan fungsi cekRadius
            cekRadius(-2.9467624532241725, 104.78537325579182, 50);
        </script>
    @endpush
@endsection
