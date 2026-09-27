@extends('layouts.apps')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <nav>
                        <ul class="breadcrumb breadcrumb-pipe">
                            <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="{{ route('accounts.index')}}">Account</a></li> -->
                            <li class="breadcrumb-item active">Currency Exchange</li>
                        </ul>
                    </nav>
                    <br>
                    <div class="nk-block nk-block-lg">

                       @if ($message = Session::get('success'))
                       <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="preview-block">
                                <span class="preview-title-lg overline-title">New Exchange Period</span>
                                <form method="POST" action="{{ route('currencies.store')}}">
                                    @csrf
                                    
                                    <div class="row gy-4">
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="default-01">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="currency_name" class="form-control" id="default-01" placeholder="Input Exchange Name">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-calendar-alt"></em>
                                                    </div>
                                                    <input type="text" name="start_date" class="form-control form-control-xl form-control-outlined date-picker" id="outlined-date-picker">
                                                    <label class="form-label-outlined" for="outlined-date-picker">Start Date</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="kes" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">KES</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="rwf" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">RWF</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="tzs" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">TZS</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="ugx" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">UGX</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="usd" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">USD</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="euro" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">EURO</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <button type="submit" class="btn btn-primary">Create Exchange Period</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>


                    @foreach ($currencies as $key => $object)
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div id="accordion-1" class="accordion accordion-s2">
                                <div class="accordion-item">
                                    <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1-1">
                                        <h6 class="title">{{$object->currency_name}}</h6>
                                        <span class="accordion-icon"></span>
                                    </a>
                                    <div class="accordion-body collapse" id="accordion-item-1-1" data-bs-parent="#accordion-1">
                                        <div class="accordion-inner">

                                         <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="kes" value="{{$object->kes}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">KES</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="rwf" value="{{$object->rwf}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">RWF</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="tzs" value="{{$object->tzs}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">TZS</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="ugx" value="{{$object->ugx}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">UGX</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="usd" value="{{$object->usd}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">USD</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">1 SEK =</span>
                                                    </div>
                                                    <input type="text" name="euro" value="{{$object->euro}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">EURO</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card-preview -->
                @endforeach


            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
