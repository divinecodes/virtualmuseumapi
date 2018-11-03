@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-7">
            <div class="row justify-content-center bg-info">
                    <h3 class="title text-white"><b>ALL IMAGES</b></h3>
            </div>
            
            <div class="row py-4">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Image Title</h5>
                        </div>

                        <div class="card-body" style="background-image: url('svg/503.svg'); height: 200px; width: 100%; 
                        background-repeat: no-repeat; background-size: cover;" >

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <label class="col-sm-4 text-md-right">Location: </label>
                                <h6 class="col-md-6 title"> Agric</h6>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 text-md-right">Order: </label>
                                <h6 class="col-md-6 title"> 1</h6>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 text-md-right">Type: </label>
                                <h6 class="col-md-6 title"> Type</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-6 py-2">
                                    <button type="button" class="btn btn-success btn-md"  data-toggle="modal" data-target="#update-1">UPDATE</button>
                                </div>
                                <div class="col-md-6 py-2">
                                    <a href="javascript:void(0);" type="button" class="btn btn-danger btn-md">DELETE</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="update-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update Modal</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="{{route('update.image')}}" enctype="multipart/form-data"> 
                                    @csrf()
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-3 col-form-label text-md-right">{{ __('Title') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="title" type="text" class="form-control" name="title" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location" class="col-sm-3 col-form-label text-md-right">{{ __('Location') }}</label>
                    
                                        <div class="col-md-7">
                                            <select name="location" class="form-control" id="location" required autofocus>
                                                <option value="">Agric</option>
                                                <option value="">Some</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="type" type="text" class="form-control" name="type" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="order" class="col-sm-3 col-form-label text-md-right">{{ __('Order') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="order" type="number" class="form-control" name="order" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-md-9">
                                            <img src="svg/404.svg" height="150px" width="150px" id="image-preview"> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 col-form-label text-md-right">{{ __('Image') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="image" type="file" name="image" required autofocus onchange="readURL(this);">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <input type="submit" class="btn btn-primary btn-md" value="UPDATE">
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white">Upload Image</div>

                <div class="card-body">
                    <form method="POST" action="{{route('add.image')}}" enctype="multipart/form-data"> 
                        @csrf()
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label text-md-right">{{ __('Title') }}</label>
    
                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-3 col-form-label text-md-right">{{ __('Location') }}</label>
        
                            <div class="col-md-7">
                                <select name="location" class="form-control" id="location" required autofocus>
                                    <option value="">Agric</option>
                                    <option value="">Some</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}</label>
    
                            <div class="col-md-7">
                                <input id="type" type="text" class="form-control" name="type" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order" class="col-sm-3 col-form-label text-md-right">{{ __('Order') }}</label>
    
                            <div class="col-md-7">
                                <input id="order" type="number" class="form-control" name="order" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-9">
                                <img src="svg/404.svg" height="150px" width="150px" id="image-preview"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label text-md-right">{{ __('Image') }}</label>
    
                            <div class="col-md-7">
                                <input id="image" type="file" name="image" required autofocus onchange="readURL(this);">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <input type="submit" class="btn btn-primary btn-md" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
