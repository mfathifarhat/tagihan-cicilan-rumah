window.addEventListener("beforeunload", function () {
    let norp = $('#norp').html()
    $.ajax({
        type: 'get',
        url: '/produksi/leave',
        data: { norp: norp }
    })
});

{/* <tr>
    <td colspan="5">
        <div class="collapse">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input class="form-control form-control-sm" type="number" name="jumlah[]"
                                value="${parseInt(element[5])}">
                        </div>
                        <div class="form-group mt-2">
                            <label>Dimensi</label>
                            <input class="form-control form-control-sm" type="text" name="dimensi[]"
                                value="${element[4]}">
                        </div>
                        <div class="form-group mt-2">
                            <label>Keterangan</label>
                            <input class="form-control nullable form-control-sm" type="text" name="ket[]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kondisi</label>
                            <div>
                                <select class="js-example-basic-multiple w-100"
                                    name="kondisi[`+ (++rowCount).toString() + `][]" multiple="multiple">
                                    <option value="1">Lubang Vent Kurang</option>
                                    <option value="2">Lubang Drainase Kurang</option>
                                    <option value="3">Blacksteel Distorsi</option>
                                    <option value="4">Overlap</option>
                                    <option value="5">Lasan Tidak Difinishing</option>
                                    <option value="6">Potongan Material Kasar</option>
                                    <option value="7">Coating</option>
                                    <option value="8">Dimensi Melebihi Bak/Ketel</option>
                                    <option value="9">Oli/Minyak/Grease Tebal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label>Kondisi Lain</label>
                            <input type="text" name="kondisilain[]" value=""
                                class="nullable form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr> */}