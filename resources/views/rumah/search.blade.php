<div class="table-responsive fs-14">
    <table class="table table-sm gy-5 align-middle">
        <thead class="text-muted">
            <tr>
                <th></th>
                <th>Blok</th>
                <th>Gambar</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>Jumlah Kamar</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rumahs as $item)
                <tr>
                    <td>
                        <input class="form-check-input form-select-lg m-0" type="radio" name="rumah" id="rumah"
                            value="{{ $item->blok }}">
                    </td>
                    <td>{{ $item->blok }}</td>
                    <td>
                        <img src="{{  Cloudinary::getUrl($item->gambar) }}" width="250"
                                        alt="">
                    </td>
                    <td>{{ $item->luas_tanah }}m<sup>2</sup></td>
                    <td>{{ $item->luas_bangunan }}m<sup>2</sup></td>
                    <td>{{ $item->jumlah_kamar }}</td>
                    <td>{{ format_uang($item->harga) }}</td>
                    <td class="d-none">{{ $item->luas_tanah }}</td>
                    <td class="d-none">{{ $item->luas_bangunan }}</td>
                    <td class="d-none">{{ $item->harga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="pagination row gy-2 justify-content-between align-items-center">
    <div class="col-sm-6 text-center text-sm-start">
        Page {{ $rumahs->currentPage() }} of {{ $rumahs->lastPage() }}
    </div>
    <div class="col-sm-6 text-center text-sm-end">
        <a href="{{ $rumahs->previousPageUrl() }}" class="btn btn-sm btn-primary">Previous</a>
        <a href="{{ $rumahs->nextPageUrl() }}" class="btn btn-sm btn-primary">Next</a>
    </div>
</div>
