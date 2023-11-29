console.log('File JS terhubung')
function onChangeSelect(url, id, name) {
    $.ajax({
        url: url,
        type: 'GET',
        data: { id: id },
        success: function(data) {
            if (data && $.isArray(data) && data.length > 0) {
                var select = $('#' + name);
                select.empty();
                select.append('<option>==Pilih Salah Satu==</option>');
                $.each(data, function(key, value) {
                    select.append('<option value="' + key + '">' + value + '</option>');
                });
            } else {
                console.error('No data received from the server.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error when fetching data: ' + textStatus);
        }
    });
}

$(function() {
    $('#provinsi').on('change', function() {
        onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
    });
    $('#kota').on('change', function() {
        onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
    });
    $('#kecamatan').on('change', function() {
        onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
    });
});
