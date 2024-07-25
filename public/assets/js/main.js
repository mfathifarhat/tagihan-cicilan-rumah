$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function formatCurrency(amount) {
    return amount.toLocaleString('id-ID');
}

$('#rumahModal .search form').on('submit', function (e) {
    e.preventDefault()
    console.log("halo")

    let dataForm = $(this).serialize()
    $.ajax({
        type: 'get',
        url: '/rumah/search',
        data: dataForm,
        beforeSend: function () {
            $('#rumahModal .result').html('<div class="loader"></div>')
        },
        success: function (res) {
            $('#rumahModal .result').html(res)
        }
    })
})

// $(window).on('load', function () {
//     if($('#rumahModal .result')){

//     }
// })

$(document).on('click', '.result .pagination a', function (e) {
    e.preventDefault()
    let caller = $(e.target)
    let url = $(e.target).prop('href')
    let container
    if ($(caller).closest('.modal').length > 0) {
        container = caller.closest('.modal').find('.result')
    } else {
        container = caller.closest('.result')
    }
    $.ajax({
        type: 'get',
        url: url,
        beforeSend: function () {
            container.html('<div class="loader"></div>')
        },
        success: function (res) {
            container.html(res)
        }
    })
})

$('#rumahModal .save').on('click', function () {
    let selected = $(this).closest('.modal').find('input[type="radio"]:checked')
    let data = selected.closest('tr').find('td')

    console.log(data)

    $('#data-rumah #rumah_id').val($(data[0]).find('input').val())
    $('#data-rumah #blok_rumah').val(data[1].innerHTML)
    $('#data-rumah #luas_tanah').val(data[8].innerHTML)
    $('#data-rumah #luas_bangunan').val(data[9].innerHTML)
    $('#data-rumah #jumlah_kamar').val(data[6].innerHTML)
    $('#data-rumah #harga').val(data[10].innerHTML)

    let totalHarga = parseInt(data[10].innerHTML) + (parseInt(data[10].innerHTML) * 15 / 100)

    $('#harga_properti').val(totalHarga)
    $('#harga_properti').closest('.form-group').find('span').html(`(${formatCurrency(totalHarga)})`)
    $('#dp').val((totalHarga) * 20 / 100)
    $('#dp').closest('.form-group').find('span').html(`(${formatCurrency(parseInt(data[10].innerHTML) * 10 / 100)})`)

    $(this).closest('#rumahModal').modal('hide')

})

$('#rumahModal').on('show.bs.modal', function () {
    $.ajax({
        type: 'get',
        url: '/rumah/search',
        data: { keyword: '' },
        beforeSend: function () {
            $('#rumahModal .result').html('<div class="loader"></div>')
        },
        success: function (res) {
            $('#rumahModal .result').html(res)
        }
    })
})

$('#jangka_waktu').on('input', function () {
    if ($(this).val() > 20) {
        $(this).val(20)
    } else if ($(this).val() < 1) {
        $(this).val(1)
    }


    let cicilan = Math.ceil((parseInt($('#harga_properti').val()) - parseInt($('#dp').val())) / (parseInt($('#jangka_waktu').val()) * 12))
    $('#cicilan').val(cicilan)
    $('#cicilan').closest('.form-group').find('span').html(`(${formatCurrency(cicilan)})`)

})

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("gambar").files[0]);

    oFReader.onload = function (oFREvent) {
        // document.getElementById("uploadPreview").src = oFREvent.target.result;
        $('#preview').html(`
            <img class="w-100" src="${oFREvent.target.result}" alt="">
        `)
    };
};

$(document).ready(function() {
    $("#printBtn").on("click", function() {
        window.print();
    });
});