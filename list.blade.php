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
    <div class="container-fluid bg-primary">
        <div class="text-center display-6">Daftar Menu</div>
        <br/>
            @foreach($menus as $menu)
                <div class="container bg-success-subtle">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/image/'.$menu->foto) }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <p>Nama : {{$menu->nama}}</p>
                            <p>Jenis : {{$menu->jenis}}</p>
                            <p>Harga : Rp {{$menu->harga}}</p>
                            <p>Deskripsi : {{$menu->deskripsi}}</p>
                        </div>
                    </div>             
                    <hr style="border: 2px solid black; margin: 20px 0;">
                    <br/>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

