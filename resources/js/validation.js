import Pristine from "pristinejs";
import Toastify from "toastify-js";
import $ from "jquery"; // Pastikan jQuery sudah diimpor

(function () {
    "use strict";

    function onSubmit(pristine) {
        let valid = pristine.validate();

        if (valid) {
            // Data formulir yang akan dikirim ke server
            let formData = {
                name: $("#name").val(),
                username: $("#username").val(),
                email: $("#email").val(),
                nohp: $("#nohp").val(),
                password: $("#password").val(),
                _token: $('meta[name="csrf-token"]').attr("content"), // Token CSRF Laravel
            };

            // Kirim permintaan AJAX POST ke endpoint server Anda
            $.ajax({
                type: "POST",
                url: "{{ route('storeregister') }}", // Ganti dengan URL endpoint Anda
                data: formData,
                success: function (response) {
                    // Tanggapan dari server berhasil
                    Toastify({
                        node: $("#success-notification-content")
                            .clone()
                            .removeClass("hidden")[0],
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                    }).showToast();
                },
                error: function (error) {
                    // Tanggapan dari server gagal
                    Toastify({
                        node: $("#failed-notification-content")
                            .clone()
                            .removeClass("hidden")[0],
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                    }).showToast();
                },
            });
        } else {
            Toastify({
                node: $("#failed-notification-content")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
            }).showToast();
        }
    }

    $(".validate-form").each(function () {
        let pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-danger mt-2",
        });

        $(this).on("submit", function (e) {
            e.preventDefault();
            onSubmit(pristine);
        });
    });


    // $(function () {
    //     function populateDropdown(element, url, placeholder) {
    //         $.get(url, function (data) {
    //             element.empty();
    //             element.append(`<option value="">${placeholder}</option>`);
    //             $.each(data, function (key, value) {
    //                 element.append(`<option value="${key}">${value}</option>`);
    //             });
    //         });
    //     }

    //     $('#provinsi').on('change', function () {
    //         const selectedProvinsi = $(this).val();
    //         if (selectedProvinsi) {
    //             const citiesUrl = '/cities?id=' + selectedProvinsi;
    //             populateDropdown($('#kota'), citiesUrl, 'Pilih Kota / Kabupaten');
    //         } else {
    //             $('#kota').empty().append('<option value="">Pilih Kota / Kabupaten</option>');
    //             $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
    //             $('#desa').empty().append('<option value="">Pilih Desa / Kelurahan</option>');
    //         }
    //     });

    //     $('#kota').on('change', function () {
    //         const selectedKota = $(this).val();
    //         if (selectedKota) {
    //             const districtsUrl = '/districts?id=' + selectedKota;
    //             populateDropdown($('#kecamatan'), districtsUrl, 'Pilih Kecamatan');
    //         } else {
    //             $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
    //             $('#desa').empty().append('<option value="">Pilih Desa / Kelurahan</option>');
    //         }
    //     });

    //     $('#kecamatan').on('change', function () {
    //         const selectedKecamatan = $(this).val();
    //         if (selectedKecamatan) {
    //             const villagesUrl = '/villages?id=' + selectedKecamatan;
    //             populateDropdown($('#desa'), villagesUrl, 'Pilih Desa / Kelurahan');
    //         } else {
    //             $('#desa').empty().append('<option value="">Pilih Desa / Kelurahan</option>');
    //         }
    //     });
    // });


})();
