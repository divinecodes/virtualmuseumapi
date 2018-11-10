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
        <div class="col-md-8">
            <div class="row justify-content-center bg-info">
                    <h3 class="title text-white"><b>ALL LOCATION</b></h3>
            </div>
            
            <div class="row py-4">
                @if($locations && count($locations) > 0)
                    @foreach($locations as $location)
                <div class="col-md-4 col-sm-12 " style="margin-bottom: 10px;">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>{{$location->location}}</h5>
                        </div>

                        <div class="card-body" style="background-image: url('{{$location->image}}'); height: 200px; width: 100%; 
                        background-repeat: no-repeat; background-size: cover;" >

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <label class="col-sm-4 text-md-right">Location: </label>
                                <h6 class="col-md-6 title"> {{$location->about}}</h6>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-md-center">
                                    <a href="{{route('delete.location',['id'=>$location->id])}}" 
                                        class="btn btn-danger">Delete Location</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <!-- The Modal -->
                    <div class="modal fade" id="update-{{$location->id}}">
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
                                            <input id="title" type="text" class="form-control" name="title" required autofocus value="{{$location->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location" class="col-sm-3 col-form-label text-md-right">{{ __('Location') }}</label>
                    
                                        <div class="col-md-7">
                                            <select name="location" class="form-control" id="location" required autofocus>
                                                <option value="agric-in" @if($location->location == 'agric-in') selected @endif>Agric In</option>
                                                <option value="agric-out" @if($location->location == 'agric-out') selected @endif>Agric Out</option>
                                                <option value="greathall-in" @if($location->location == 'greathall-in') selected @endif>GreatHall In</option>
                                                <option value="greathall-out" @if($location->location == 'greathall-out') selected @endif>Greathall Out</option>
                                                <option value="greathall-outside" @if($location->location == 'greathall-outside') selected @endif>Greathall Outside</option>
                                                <option value="halls" @if($location->location == 'halls') selected @endif>Halls</option>
                                                <option value="library-out" @if($location->location == 'library-out') selected @endif>Library Out</option>
                                                <option value="library-in" @if($location->location == 'library-in') selected @endif>Library In</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="type" type="text" class="form-control" name="type" required autofocus value="{{$location->type}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="order" class="col-sm-3 col-form-label text-md-right">{{ __('Order') }}</label>
                
                                        <div class="col-md-7">
                                            <input id="order" type="number" class="form-control" name="order" required autofocus value="{{$location->order}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-md-9">
                                            <img src="{{$location->url}}" height="150px" width="150px" id="image-preview"> 
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
                    </div> --}}
                </div>
                @endforeach 
                @else 
                <div class="text-center">
                        <div class="content">
                                <div class="title m-b-md">
                                    <h4>No Location Added</h4>
                                </div>
                
                            </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">ADD LOCATION</div>

                <div class="card-body">
                    <form method="POST" action="{{route('add.location')}}" enctype="multipart/form-data"> 
                        @csrf()
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label text-md-right">{{ __('Location') }}</label>
    
                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control" name="location" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label text-md-right">{{ __('About') }}</label>
    
                            <div class="col-md-7">
                                <textarea id="type" rows="4" type="text" class="form-control" name="about" required autofocus></textarea>
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
