@extends('layouts.master')
@section('title') @lang('translation.pages') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('routeUrl') {{ url('/') }} @endslot
        @slot('li_1') Dashboard @endslot
        @slot('title') Pages @endslot
    @endcomponent

    @php
        $page = $data['editPage'] ?? null;
    @endphp

    <form action="{{route('admin.pages.store')}}" method="POST" enctype="multipart/form-data" id="PagesForm">
        @csrf

        <div class="row">
            <!-- Page Info -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0">{{ $page ? 'Edit Page' : 'Create Page' }}</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $page['id'] ?? 0 }}">

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Page Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="Enter title" required
                                   value="{{ $page['title'] ?? '' }}">
                        </div>

                        <!-- Page Type -->
                        <div class="mb-3">
                            <label for="page_type" class="form-label">Page Type</label>
                            <select class="form-select" name="page_type" id="page_type" required>
                                <option value="">-- Select Type --</option>
                                <option value="about" {{ isset($page) && $page['page_type']=='about' ? 'selected' : '' }}>About Us</option>
                                <option value="gallery" {{ isset($page) && $page['page_type']=='gallery' ? 'selected' : '' }}>Gallery</option>
                                <option value="blog" {{ isset($page) && $page['page_type']=='blog' ? 'selected' : '' }}>Blogs</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control ckeditor-classic"
                                      rows="6">{{ $page['description'] ?? '' }}</textarea>
                        </div>

                        <!-- Upload New Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            <small class="text-muted">You can select multiple images at once.</small>
                        </div>

                        <!-- Existing Images -->
                        @if(isset($page) && !empty($page['pageMedia']))
                            <div id="existing-images" class="row g-3 mb-3">
                                @foreach($page['pageMedia'] as $media)
                                    <div class="col-md-3" id="image-{{ $media['id'] }}">
                                        <div class="card shadow-sm border">
                                            <img src="{{ asset('storage/uploads/'.$media['file_path']) }}" class="card-img-top"
                                                 style="height:150px;object-fit:cover;">
                                            <div class="card-body p-2 text-center">
                                                <button type="button" class="btn btn-sm btn-danger remove-existing btn-delete"  data-id="{{ $media['id'] }}">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Preview New Images -->
                        <div id="preview-container" class="row g-3"></div>

                        <!-- Submit -->
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary btn-submit">
                                {{ $page ? 'Update Page' : 'Save Page' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <script src="{{ URL::asset('build/js/custom-js/pages/pages.js') }}"></script>
    <script>
        // CKEditor Init
        ClassicEditor.create(document.querySelector('.ckeditor-classic'))
            .catch(error => { console.error(error); });

        // ===== New Images Preview with Remove =====
        let input = document.getElementById('images');
        let previewContainer = document.getElementById('preview-container');

        input.addEventListener('change', function () {
            previewContainer.innerHTML = "";
            Array.from(this.files).forEach((file, index) => {
                if (!file.type.startsWith('image/')) return;
                let reader = new FileReader();
                reader.onload = function (e) {
                    let col = document.createElement('div');
                    col.classList.add('col-md-3');
                    col.innerHTML = `
                        <div class="card shadow-sm border">
                            <img src="${e.target.result}" class="card-img-top" style="height:150px;object-fit:cover;">
                            <div class="card-body p-2 text-center">
                                <button type="button" class="btn btn-sm btn-danger remove-image" data-index="${index}">Remove</button>
                            </div>
                        </div>
                    `;
                    previewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        });

        // Remove new image from preview & input
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-image')) {
                let index = e.target.getAttribute('data-index');
                let dt = new DataTransfer();
                let { files } = input;
                Array.from(files).forEach((file, i) => {
                    if (i != index) dt.items.add(file);
                });
                input.files = dt.files;
                e.target.closest('.col-md-3').remove();
            }
        });


    </script>
@endsection
