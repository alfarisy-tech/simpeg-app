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
            <div id="container" class="col-12">
                <div hidden id="alert-masuk" class="alert alert-danger" role="alert">
                    Pastikan Anda berada di dalam radius 50 meter dari lokasi absen untuk melakukan absen atau <a
                        href="">refresh</a> kembali. Terimakasih
                </div>
                <video hidden style="width: 100%" id="preview"></video>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=geometry"></script>
        <script>
            function cekRadius(targetLatitude, targetLongitude, radius) {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var userLatitude = position.coords.latitude;
                        var userLongitude = position.coords.longitude;

                        var userLatLng = new google.maps.LatLng(userLatitude, userLongitude);
                        var targetLatLng = new google.maps.LatLng(targetLatitude, targetLongitude);

                        var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, targetLatLng);
                        let scan = document.querySelector('#preview');
                        let alert = document.querySelector('#alert-masuk');
                        if (distance <= radius) {
                            console.log("Perangkat berada dalam radius " + radius + " meter.");
                            let scanner = new Instascan.Scanner({
                                video: document.getElementById('preview')
                            });
                            scanner.addListener('scan', function(content) {
                                const modal = document.querySelector('#exampleModal');
                                modal.querySelector('#content').value = content;
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
                            scan.hidden = false;
                            alert.setAttribute('hidden', false);
                        } else {
                            console.log("Perangkat berada di luar radius " + radius + " meter.");
                            scan.hidden = true;
                            alert.removeAttribute('hidden'); // Show the alert
                        }
                    });
                } else {
                    console.log("Geolocation tidak didukung di browser ini.");
                }
            }

            // Contoh pemanggilan fungsi cekRadius
            // cekRadius(-2.9467237158338055, 104.78538308154498, 50); // profecta perdana
            cekRadius(-2.9925124094195366, 104.70672476016057, 50); // antapura asri
        </script>
    @endpush
@endsection
