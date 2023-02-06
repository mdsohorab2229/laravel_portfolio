@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Slide Page</h4>
                            <form action="{{ route('update.slider') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $homeslide->id }}">
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" placeholder="Name"
                                               value="{{ $homeslide->title }}" id="title">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="short_title"
                                               placeholder="User Name" value="{{ $homeslide->short_title }}"
                                               id="short_title">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video URL</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="video_url"
                                               placeholder="Video url " value="{{ $homeslide->video_url }}"
                                               id="video_url">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="home_slide" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="home_slide"
                                               placeholder="User Email" value="{{ $homeslide->home_slide }}"
                                               id="home_slide">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" id="showImage"
                                             src="{{ (!empty($homeslide->home_slide)) ? url($homeslide->home_slide) : url('upload/no_image.jpg') }}"
                                             alt="Card image cap">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#home_slide').change(function (e) {
                    var reader =new FileReader();
                    reader.onload=function (e) {
                        $('#showImage').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
@endsection
