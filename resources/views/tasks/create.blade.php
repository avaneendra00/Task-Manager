<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
</head>
<body>
    <h1>Create Task</h1>
    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nama">Task Name</label>
            <input type="text" name="nama" required>
            @error('nama')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="deskirpsi">Description</label>
            <textarea name="deskripsi"></textarea>
            @error('deskripsi')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="image">Upload Gambar (JPEG,JPG,PNG only)</label>
            <input type="file" name="image" accept="image/jpeg, image/png, image/jpg">
            @error('image')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Create Task</button>
        </div>
    </form>
</body>
</html>