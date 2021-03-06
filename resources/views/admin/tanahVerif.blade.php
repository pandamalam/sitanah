@extends('layouts.appAuth')
@section('content')
<h3>Data Tanah Terverivikasi</h3>
<table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Luas</th>
            <th>Kota</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTanah as $tanah)
        <tr class="uk-text-capitalize">
            <td><a class="uk-button uk-button-text uk-text-primary uk-text-capitalize" href="#modal-center-{{$tanah->id}}" uk-toggle>{{$tanah->title}}</a></td>
            <div id="modal-center-{{$tanah->id}}" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-capitalize uk-border-rounded">
                    <button class="uk-modal-close-default" type="button" uk-close></button>
                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: pull">

                        <ul class="uk-slideshow-items">
                            @foreach ($tanah->tanah_has_foto as $foto)
                            <li>
                                <img class="foto-tanah" src="{{url('img/tanah',$foto->foto)}}" alt="">
                            </li>
                            @endforeach
                        </ul>
            
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            
                    </div>
                    <p>
                        <span class="uk-text-bold">Alamat: </span>{{$tanah->alamat}}, {{$tanah->kota}}, {{$tanah->kecamatan}}<br>
                        <span class="uk-text-bold">Harga: </span>Rp {{$tanah->harga}}<br>
                        <span class="uk-text-bold">Jenis: </span> {{$tanah->jenis}}<br>
                        <span class="uk-text-bold">Sertifikat: </span> {{$tanah->sertifikat}}<br>
                        <span class="uk-text-bold">Pemilik: </span>{{$tanah->tanah_has_penjual->penjual_has_user->name}}<br>
                        <span class="uk-text-bold">Telepon: </span>{{$tanah->tanah_has_penjual->no_telp}}<br>
                    </p>

                </div>
            </div>
            <td class="uk-text-capitalize">{{$tanah->luas}}m<sup>2</sup></td>
            <td>{{$tanah->kota}}</td>
            <td>{{$tanah->harga}}</td>
            <td>{{$tanah->jenis}}</td>
            <td>
                <a class="uk-button uk-button-text uk-text-warning" href="#modal-banned-{{$tanah->id}}" uk-toggle>Banned</a><br>
                <div id="modal-banned-{{$tanah->id}}" class="uk-flex-top" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-capitalize uk-border-rounded">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <form action="{{ route('statusTanah', $tanah) }}" method="post">
                            @csrf
                                {{ method_field('PUT') }}
                            <label for="">MESSAGE</label>
                            <textarea name="message" class="uk-textarea" id="" cols="30" rows="10"></textarea>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                <input class="uk-button uk-button-text uk-text-warning" type="submit" onclick="alert('Are you sure to banned {{$tanah->title}}?')" value="BANNED">
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Title</th>
            <th>Luas</th>
            <th>Kota</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection