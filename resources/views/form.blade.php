<!DOCTYPE html>
<html lang="en">

<head>
    <title>Input Menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle bg-warning bg-gradient rounded">
            <form method="POST" action="/form" class="p-3" enctype="multipart/form-data">
                @csrf
                <div class="text-center display-6">Tambah Menu</div>
                <br/>
                <div class="form-group">
                    <label for="Image">Image</label>
                    <input type="file" class="form-control-file" id="Image" name="Image" accept="image/">
                    @error('Image')
                    <div class="alert alert-danger text">{{ $message }}</div>
                    @enderror
                </div>
                <br/>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="" name="nama">
                </div>
                <br/>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="jenis">Jenis</label>
                    <select class="form-select" id="jenis">
                        <option selected>Choose...</option>
                        <option value="1">Mie</option>
                        <option value="2">Nasi</option>
                        <option value="3">Teh</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" placeholder="12000" name="harga">
                </div>
                <br/>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="5"></textarea>
                </div>
                <div type="submit" class="btn btn-primary">Submit</div>
            </form>            
        </div>
    </div>
</body>
</html>