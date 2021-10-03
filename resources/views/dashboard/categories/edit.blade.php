@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit category</h1>
</div>
<div class="col-md-12">
    <form method="post" action="/dashboard/categories/{{ $category->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf 
        <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    function priviewImage() {
        const image = document.querySelector('#image');
        const imgPriview = document.querySelector('.img-priview');

        imgPriview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPriview.src = oFREvent.target.result;
        }
    }
</script>

@endsection