@extends('layouts.app')
@section('title', 'Contact')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">Contact Page</div>
            <form method="POST" action="/cropimage" enctype="multipart/form-data">

                {!! csrf_field() !!}

                <input type="hidden" id="cropped-image" name="cropped-image" value="">

                <span class="btn btn-info btn-file">
                    Choose an image
                <input id="uploaded-image" class="upload" type="file" name="uploaded-image" onchange="PreviewImage();"/>
                </span>

                <button type="submit" class="btn btn-default ladda-button" data-style="expand-left" data-size="s" data-color="purple">
                    Upload</button>

            </form>
            <button type="button" id="crop-btn" class="btn btn-primary">
                Crop Image
            </button>
            <div class="image-data"></div>
            <div class="img-container">
                <img id="image" src="/images/testimage.png">
            </div>
        </div>
    </div>
@endsection