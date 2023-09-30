<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="container">
            <div class="text-center display-6">Daftar Menu</div>
                @foreach($menus as $item)
                    @if($item->foto)
                        <img src="{{ asset('storage/foto-menu/'.$item->foto) }}" style="width: 200px; height: 300px;">
                    @endif
                    <div class="p-2">
                        <h6> Nama: {{$item->nama}}</h6>
                        <h6> Jenis: {{$item->jenis}}</h6>
                        <h6> Harga: {{$item->harga}}</h6>
                        <h6> Deskripsi: {{$item->deskripsi}}</h6>
                    </div>
                    <div class="text-center">==================================================</div>
                @endforeach
            </div>
            <div class="container">
                <div class="d-flex my-2 justify-content-end">
                    <a href="/menu/create" class="btn btn-primary" style="max-width: 18rem;">+Tambah Menu</a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>
