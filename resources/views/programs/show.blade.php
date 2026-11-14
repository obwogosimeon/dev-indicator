@extends('layouts.apps')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
        var logframeDialogs = [
            '#goalcreate', '#editgoal_modal', '#practice_modal', '#activity_modal',
            '#activity1', '#activity2', '#output_model', '#indicator_modal',
            '#indicator1', '#indicator2'
        ].join(', ')
        $(logframeDialogs).find('.modal-content').addClass('logframe-form-modal')
    });
</script>


<main class="container-fluid admin-page program-detail-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">Portfolio management</p>
            <h1 class="admin-page__title">{{ $programshow->program_name }}</h1>
            <p class="admin-page__description">
                {{ optional($programshow->basecurrency)->currency_name ?: 'Base currency not set' }}
                @if ($programshow->start_date || $programshow->end_date)
                    <span class="program-detail__divider">·</span>
                    {{ $programshow->start_date ? \Carbon\Carbon::parse($programshow->start_date)->format('M j, Y') : 'Start date not set' }} – {{ $programshow->end_date ? \Carbon\Carbon::parse($programshow->end_date)->format('M j, Y') : 'End date not set' }}
                @endif
            </p>
        </div>
        <div class="admin-page__actions program-detail__header-actions">
            <a href="{{ route('programs.index') }}" class="admin-page__button-secondary">
                <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
                All programmes
            </a>
            <a href="{{ route('programs.edit', $programshow->id) }}" class="admin-page__button">
                <em class="icon ni ni-edit" aria-hidden="true"></em>
                Edit programme
            </a>
        </div>
    </header>

    <section class="program-detail__summary" aria-label="Programme overview">
        <div class="program-detail__metric">
            <span class="program-detail__metric-icon"><em class="icon ni ni-view-col" aria-hidden="true"></em></span>
            <div>
                <span>Results framework</span>
                <strong>{{ optional($programshow->logframe)->logframe_name ?: 'Not linked' }}</strong>
            </div>
        </div>
        <div class="program-detail__metric">
            <span class="program-detail__metric-icon program-detail__metric-icon--blue"><em class="icon ni ni-calendar-fill" aria-hidden="true"></em></span>
            <div>
                <span>Financial years</span>
                <strong>{{ $years->count() }}</strong>
            </div>
        </div>
        <div class="program-detail__metric">
            <span class="program-detail__metric-icon program-detail__metric-icon--green"><em class="icon ni ni-wallet-out" aria-hidden="true"></em></span>
            <div>
                <span>Funding streams</span>
                <strong>{{ $fundings->count() }}</strong>
            </div>
        </div>
        <div class="program-detail__metric">
            <span class="program-detail__metric-icon program-detail__metric-icon--violet"><em class="icon ni ni-file" aria-hidden="true"></em></span>
            <div>
                <span>Documents</span>
                <strong>{{ $documents->count() }}</strong>
            </div>
        </div>
    </section>

    <div class="card card-bordered card-preview program-detail__workspace">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3 program-detail__tabs" id="tabMenu" aria-label="Programme management sections" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="program-reports-tab" role="tab" aria-controls="tabItem1" aria-selected="true" data-bs-toggle="tab" href="#tabItem1">
                        <em class="icon ni ni-chart-up" aria-hidden="true"></em><span>Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="program-logframe-tab" role="tab" aria-controls="tabItem6" aria-selected="false" data-bs-toggle="tab" href="#tabItem6">
                        <em class="icon ni ni-view-col" aria-hidden="true"></em><span>Results framework</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="program-funding-tab" role="tab" aria-controls="tabItem8" aria-selected="false" data-bs-toggle="tab" href="#tabItem8">
                        <em class="icon ni ni-wallet-out" aria-hidden="true"></em><span>Funding</span><span class="program-detail__tab-count">{{ $fundings->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="program-years-tab" role="tab" aria-controls="tabItem9" aria-selected="false" data-bs-toggle="tab" href="#tabItem9">
                        <em class="icon ni ni-calendar-fill" aria-hidden="true"></em><span>Financial years</span><span class="program-detail__tab-count">{{ $years->count() }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="program-documents-tab" role="tab" aria-controls="tabItem11" aria-selected="false" data-bs-toggle="tab" href="#tabItem11">
                        <em class="icon ni ni-file" aria-hidden="true"></em><span>Documents</span><span class="program-detail__tab-count">{{ $documents->count() }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                
                @include('programs.reports.reports')
                @include('programs.logframe.logframe')
                @include('programs.funding.funding')
                @include('programs.financial.financial')
                @include('programs.documents.document')
                
                <div class="tab-pane" id="tabItem10">
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

                                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="organization_id" value="{{Auth::user()->organization_id}}">
                                        <input type="hidden" name="status" value="01">
                                        <input type="hidden" name="program_id" value="{{$programshow->id}}">


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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
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
                                                        <span class="input-group-text">1 {{$programshow->basecurrency->currency_code}} =</span>
                                                    </div>
                                                    <input type="text" name="euro" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">EURO</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Create Exchange Period</button>

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


<!-- Create Program Goal Indicator---->
<script>
    $(document).ready(function(){
        $('#baseline').hide();
        $('#target').hide();
        $('#label').hide();
        $('#baseline1').hide();
        $('#target1').hide();
        $('#Disaggregation').hide();

        $('#disaggregation').change(function(){
            if($(this).val() == 'none'){
                $('#baseline').show();
                $('#target').show();
                $('#label').show();
                $('#Disaggregation').hide();
            }else if($(this).val() == 'Disaggregation'){
                $('#Disaggregation').show();
                $('#baseline').hide();
                $('#target').hide();
                $('#label').hide();
            }else if($(this).val() == 'ALIENID'){
                $('#document_number').show();
            }
            else{
                $('#null').show('');
            }
        });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addgoalindicator')}}" id="programgoalindicator">
                    @csrf
                    <div class="row gy-4">
                        @if($goalframe != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>
                        @endif


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        @if($goalframe != null)
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">
                        @endif
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="label">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="baseline">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="target">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>



                        <div role="tabpanel" class="tab-pane" id="Disaggregation">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore").on('click',function(){
                          count=$('#nextkin tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>


              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#programgoalindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addgoalindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<!-- Add Program Goal Outcome -->

<div class="modal fade zoom" tabindex="-1" id="practice_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Goal Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programgoaloutcome">
                    @csrf
                    <div class="row gy-4">
                        @if($goalframe != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_goal" class="form-control" id="default-01" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>
                        @endif

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        @if($goalframe != null)
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">
                        @endif
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome Title<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_title" class="form-control" id="outcome_title" placeholder="Enter Outcome Title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_code" class="form-control" id="default-01" placeholder="Enter Outcome Code">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="outcome_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal Outcome</button>
                    </div>
                </form>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#programgoaloutcome').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outcomes.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>

                <script>
            $(document).ready(function() {
                $("#programgoaloutcome").validate({
                    rules: {
                        outcome_title: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        outcome_title: {
                            required: "Please enter Outcome Title",
                            minlength: "Your Outcome Title must consist of at least 5 characters and above"
                        }

                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        </script>
            </div>
        </div>
    </div>
</div>


<!-- Add Program Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programgoalactivity">
                    @csrf

                    <div class="row gy-4">



                        @if($goalframe != null)
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goalframe->goal_code}} - {{$goalframe->goal_name}}" readonly="">
                            </div>
                        </div>
                        @endif
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        @if($goalframe != null)
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goalframe->id}}" readonly="">
                        @endif
                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Activity Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Activity</button>
                    </div>

                </form>

                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#programgoalactivity').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('activities.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#practice_modal, #activity_modal, #indicator_modal').on('show.bs.modal', function (event) {
            var trigger = $(event.relatedTarget);
            var form = $(this).find('form');
            var labelField = this.id === 'practice_modal'
                ? 'outcome_goal'
                : (this.id === 'activity_modal' ? 'activity_name' : 'goal_name');

            form.find('[name="goal_id"]').val(trigger.data('goal-id'));
            form.find('[name="' + labelField + '"]').val(trigger.data('goal-label'));
        });
    });
</script>


<!-- Add Program Outcome Output -->

<div class="modal fade zoom" tabindex="-1" id="output_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Outcome Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programoutcomeoutput">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_title" id="output_title" class="form-control" id="default-01" placeholder="" readonly="">
                            </div>
                        </div>



                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">
                        <input type="hidden" name="outcome_id" id="outcome_id" class="form-control" readonly="">
                        

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_name" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Output Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="output_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Outcome Output</button>
                    </div>

                </form>
                <script>
                    $(document).ready(function() {
                        var activeTab = localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#tabMenu').removeClass('active');
                            $(activeTab).addClass('active');
                            $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                        }

                        // Save the active tab to local storage
                        $('#tabMenu a').on('shown.bs.tab', function (e) {
                            localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });

                        $('#programoutcomeoutput').on('submit', function(e) {
                            e.preventDefault();
                            // location.reload();
                            $.ajax({
                                url: "{{ route('outputs.store')}}",
                                type: "POST",
                                data: $(this).serialize(),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.success) {
                                        location.reload();
                                        // alert('Output Added Successfully!.');
                                    } else {
                                        alert('An error occurred while saving.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('An error occurred: ' + error);
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!---- Add Program Outcome Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutcomeactivity')}}" id="programoutcomeactivity">
                    @csrf

                    <div class="row gy-4">
                      <div class="form-group">
                        <label class="form-label" for="default-01">Outcome</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_name" id="activity_name2" class="form-control" id="default-01" placeholder=""
                            readonly="">
                        </div>
                    </div>


                    <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                    <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                    <input type="hidden" name="outcome_id" id="outcome_id1" class="form-control" readonly="">
                    <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">


                    <div class="form-group">
                        <label class="form-label" for="default-01">Outcome Activity Title</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Outcome Activity code</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="default-textarea">Outcome Activity Description(Optional)</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Outcome Activity</button>
                </div>

            </form>
            <script>
                $(document).ready(function() {
                    var activeTab = localStorage.getItem('activeTab');
                    if (activeTab) {
                        $('#tabMenu').removeClass('active');
                        $(activeTab).addClass('active');
                        $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                    }

                        // Save the active tab to local storage
                    $('#tabMenu a').on('shown.bs.tab', function (e) {
                        localStorage.setItem('activeTab', $(e.target).attr('href'));
                    });

                    $('#programoutcomeactivity').on('submit', function(e) {
                        e.preventDefault();
                            // location.reload();
                        $.ajax({
                            url: "{{ route('addoutcomeactivity')}}",
                            type: "POST",
                            data: $(this).serialize(),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    location.reload();
                                        // alert('Output Added Successfully!.');
                                } else {
                                    alert('An error occurred while saving.');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('An error occurred: ' + error);
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>
</div>


<!----   Add Program Output Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programoutputactivity">
                    @csrf

                    <div class="row gy-4">
                     <div class="form-group">
                        <label class="form-label" for="default-01">Ouput Title</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_name" id="output_title7" class="form-control" placeholder=""
                            readonly="">
                        </div>
                    </div>


                    <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                    <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                    <input type="hidden" name="output_id" id="output_id5" class="form-control" readonly="">
                    <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">


                    <div class="form-group">
                        <label class="form-label" for="default-01">Output Activity Title</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_title" class="form-control" id="default-01" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Output Activity code</label>
                        <div class="form-control-wrap">
                            <input type="text" name="activity_code" class="form-control" id="default-01" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="default-textarea">Output Activity Description(Optional)</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" name="activity_description" id="default-textarea"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Output Activity</button>
                </div>

            </form>
            <script>
                $(document).ready(function() {
                    var activeTab = localStorage.getItem('activeTab');
                    if (activeTab) {
                        $('#tabMenu').removeClass('active');
                        $(activeTab).addClass('active');
                        $('#tabMenu a[href="' + activeTab + '"]').tab('show');
                    }

                        // Save the active tab to local storage
                    $('#tabMenu a').on('shown.bs.tab', function (e) {
                        localStorage.setItem('activeTab', $(e.target).attr('href'));
                    });

                    $('#programoutputactivity').on('submit', function(e) {
                        e.preventDefault();
                            // location.reload();
                        $.ajax({
                            url: "{{ route('addoutputactivity')}}",
                            type: "POST",
                            data: $(this).serialize(),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    location.reload();
                                        // alert('Output Added Successfully!.');
                                } else {
                                    alert('An error occurred while saving.');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('An error occurred: ' + error);
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>
</div>


<!---- Add Program Output Indicator --->
<script>
    $(document).ready(function(){
        $('#output11').hide();
        $('#output21').hide();
        $('#output31').hide();
        $('#Disaggregation2').hide();

        $('#disaggregation2').change(function(){
            if($(this).val() == 'none'){
                $('#output11').show();
                $('#output21').show();
                $('#output31').show();
                $('#Disaggregation2').hide();
            }else if($(this).val() == 'Disaggregation2'){
                $('#Disaggregation2').show();
                $('#output31').hide();
                $('#output21').hide();
                $('#output11').hide();
            }else if($(this).val() == 'ALIENID'){
                $('#document_number').show();
            }
            else{
                $('#null').show('');
            }
        });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Output Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programoutputindicator">
                    @csrf
                    <div class="row gy-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Output</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" id="output_indicator7" class="form-control" id="default-01" placeholder=""
                                readonly="">
                            </div>
                        </div>


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="output_id" id="output_indicator5" class="form-control" readonly="">
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation2">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation2">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output11">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default-01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output21">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="output31">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default-01" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation2">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin2" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin2 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin2 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin2').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin2 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>






              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Output Indicator</button>
        </div>

    </form>
    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#programoutputindicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutputindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>
<div>



<!---- Add Program Outcome Indicator --->

<script>
    $(document).ready(function(){
        $('#default01').hide();
        $('#default02').hide();
        $('#default03').hide();
        $('#baseline1').hide();
        $('#target1').hide();
        $('#Disaggregation1').hide();

        $('#disaggregation1').change(function(){
            if($(this).val() == 'none'){
                $('#default01').show();
                $('#default02').show();
                $('#default03').show();
                $('#Disaggregation1').hide();
            }else if($(this).val() == 'Disaggregation1'){
                $('#Disaggregation1').show();
                $('#default01').hide();
                $('#default02').hide();
                $('#default03').hide();
            }else if($(this).val() == 'ALIENID'){
                $('#document_number').show();
            }
            else{
                $('#null').show('');
            }
        });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Program Outcome Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="programOutcomeIndicator">
                    @csrf
                    <div class="row gy-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" id="outcome_indicator" class="form-control" id="default-01" placeholder=""
                                readonly="">
                            </div>
                        </div>


                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="program_id" class="form-control" value="{{$programshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" id="outcome_id3" class="form-control" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">



                        <div class="form-group">
                            <label class="form-label" for="default-01">Indicator Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="indicator_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Reporting Frequency</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="reporting_frequency" id="default-06">
                                        <option value="#">-------Select Reporting Frequency-------</option>
                                        <option></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Semi-Annual">Semi-Annual</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="type" id="type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation1">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <!-- <option value="none">None</option> -->
                                        <option value="Disaggregation1">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default01">
                                <label class="form-label" for="default-01">Label</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="label_none" class="form-control" id="default01" placeholder="Input Label">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default02">
                                <label class="form-label" for="default-01">Baseline</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="baseline_none" class="form-control" id="default02" placeholder="Input Baselime">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group" id="default03">
                                <label class="form-label" for="default-01">Target</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="target_none" class="form-control" id="default03" placeholder="Input Target">
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="Disaggregation1">

                            <!-- <h4 align="center"><strong>Disaggregation</strong></h4> -->
                            <div id='ncontainer'>

                              <table id="nextkin1" border="1" cellspacing="0">
                                <tr>
                                  <th><input class='ncheck_all' type='checkbox' onclick="select_all()"/></th>
                                  <th>#</th>
                                  <th>Label</th>
                                  <th>Baseline</th>
                                  <th>Target</th>
                              </tr>
                              <tr>
                                  <td><input type='checkbox' class='ncase'/></td>
                                  <td><span id='nsnum'>1.</span></td>
                                  <td><input class="form-control" type='text' id='dvalue' name='dvalue[0]' value="{{{ Input::old('dvalue[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dbaseline' name='dbaseline[0]' value="{{{ Input::old('dbaseline[0]') }}}"/></td>
                                  <td><input class="form-control" type='text' id='dtarget' name='dtarget[0]' value="{{{ Input::old('dtarget[0]') }}}"/></td>

                              </tr>
                          </table>

                          <button type="button" class='ndelete'>- Delete</button>
                          <button type="button" class='naddmore1'>+ Add More</button>
                      </div>
                      <script>
                        $(".ndelete").on('click', function() {
                          if($('.ncase:checkbox:checked').length > 0){
                            if (window.confirm("Are you sure you want to delete this Disaggregation detail(s)?"))
                            {
                              $('.ncase:checkbox:checked').parents("#nextkin1 tr").remove();
                              $('.ncheck_all').prop("checked", false);
                              check();
                          }else{
                              $('.ncheck_all').prop("checked", false);
                              $('.ncase').prop("checked", false);
                          }
                      }
                  });
                        var i=2;
                        $(".naddmore1").on('click',function(){
                          count=$('#nextkin1 tr').length;
                          var data="<tr><td><input type='checkbox' class='ncase'/></td><td><span id='nsnum"+i+"'>"+count+".</span></td>";

                          data +="<td><input class='form-control' type='text' id='dvalue"+i+"' name='dvalue["+(i-1)+"]' value='{{{ Input::old('dvalue["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dbaseline"+i+"' name='dbaseline["+(i-1)+"]' value='{{{ Input::old('dbaseline["+(i-1)+"]') }}}'/></td><td><input class='form-control' type='text' id='dtarget"+i+"' name='dtarget["+(i-1)+"]' value='{{{ Input::old('dtarget["+(i-1)+"]') }}}'/></td>";
                          $('#nextkin1').append(data);
                          i++;
                      });

                        function select_all() {
                          $('input[class=ncase]:checkbox').each(function(){
                            if($('input[class=ncheck_all]:checkbox:checked').length == 0){
                              $(this).prop("checked", false);
                          } else {
                              $(this).prop("checked", true);
                          }
                      });
                      }

                      function check(){
                          obj=$('#nextkin1 tr').find('span');
                          $.each( obj, function( key, value ) {
                            id=value.id;
                            $('#'+id).html(key+1);
                        });
                      }

                  </script>
              </div>




              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label" for="default-textarea">Indicator Description(Optional)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control no-resize" name="indicator_description" id="default-textarea"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Output Indicator</button>
        </div>

    </form>

    <script>
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabMenu').removeClass('active');
                $(activeTab).addClass('active');
                $('#tabMenu a[href="' + activeTab + '"]').tab('show');
            }

                        // Save the active tab to local storage
            $('#tabMenu a').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            $('#programOutcomeIndicator').on('submit', function(e) {
                e.preventDefault();
                            // location.reload();
                $.ajax({
                    url: "{{ route('addoutcomeindicator')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                                        // alert('Output Added Successfully!.');
                        } else {
                            alert('An error occurred while saving.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</div>
</div>
</div>
</div>


<div class="modal fade zoom" tabindex="-1" id="modal23456" aria-labelledby="add-fiscal-year-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered project-detail__modal-dialog" role="document">
        <div class="modal-content project-detail__modal">
            <div class="modal-header">
                <div class="project-detail__modal-heading">
                    <span class="project-detail__modal-icon"><em class="icon ni ni-calendar-fill" aria-hidden="true"></em></span>
                    <div>
                        <h5 class="modal-title" id="add-fiscal-year-title">Add Fiscal Year</h5>
                        <p>Set the name and date range for this programme’s reporting period.</p>
                    </div>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('years.store') }}" class="project-detail__modal-form">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="status" value="01">
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                    <input type="hidden" name="program_id" value="{{ $programshow->id }}">

                    <div class="project-detail__form-grid">
                        <div class="project-detail__form-field project-detail__form-field--full">
                            <label class="form-label" for="fiscal-year-name">Fiscal year name <span aria-hidden="true">*</span></label>
                            <input type="text" name="year_name" class="form-control" id="fiscal-year-name" placeholder="e.g. FY 2026" required>
                            <small>Choose a clear name that your team will recognize.</small>
                        </div>
                        <div class="project-detail__form-field">
                            <label class="form-label" for="fiscal-year-start-date">Start date <span aria-hidden="true">*</span></label>
                            <input type="date" name="start_date" class="form-control" id="fiscal-year-start-date" required>
                        </div>
                        <div class="project-detail__form-field">
                            <label class="form-label" for="fiscal-year-end-date">End date <span aria-hidden="true">*</span></label>
                            <input type="date" name="end_date" class="form-control" id="fiscal-year-end-date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="admin-page__button">
                        <em class="icon ni ni-check" aria-hidden="true"></em>
                        Save fiscal year
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade zoom" tabindex="-1" id="modal234567">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <p class="admin-page__eyebrow mb-1">Programme resources</p>
                    <h5 class="modal-title">Add funding stream</h5>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross" aria-hidden="true"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('fundingstore') }}" class="program-funding-form">
                @csrf
                <input type="hidden" name="tab" value="tabItem8">
                <input type="hidden" name="status" value="01">
                <input type="hidden" name="created_by" value="{{ Auth::id() }}">
                <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                <input type="hidden" name="program_id" value="{{ $programshow->id }}">
                <input type="hidden" name="type" value="Global">

                <div class="modal-body">
                    <p class="program-funding-form__intro">Add a funding source and choose how it should be categorized for this programme.</p>
                    @if ($errors->any() && old('tab') === 'tabItem8')
                        <div class="alert alert-danger" role="alert">
                            <strong>Please review the funding details.</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class="admin-page__form-grid">
                        <div class="admin-page__field admin-page__field--full">
                            <label for="program-funding-name">Funding name <span class="text-danger">*</span></label>
                            <input type="text" name="funding_name" class="form-control" id="program-funding-name" value="{{ old('funding_name') }}" placeholder="e.g. Ministry of Health" required>
                        </div>
                        <div class="admin-page__field">
                            <label for="program-funding-type">Funding type <span class="text-danger">*</span></label>
                            <select class="form-control" name="funding_type" id="program-funding-type" required>
                                <option value="">Select a funding type</option>
                                @foreach (['Budgeting', 'Expenditure'] as $type)
                                    <option value="{{ $type }}"{{ old('funding_type') === $type ? ' selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="admin-page__field">
                            <label for="program-funding-expenditure">Used for expenditure? <span class="text-danger">*</span></label>
                            <select class="form-control" name="expenditure" id="program-funding-expenditure" required>
                                <option value="">Select an option</option>
                                @foreach (['Yes', 'No'] as $option)
                                    <option value="{{ $option }}"{{ old('expenditure') === $option ? ' selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="admin-page__field admin-page__field--full">
                            <label for="program-funding-variable">Variable name <span class="text-danger">*</span></label>
                            <input type="text" name="variable_name" class="form-control" id="program-funding-variable" value="{{ old('variable_name') }}" placeholder="e.g. donor_contribution" required>
                            <span class="admin-page__field-hint">Use a short identifier for this value in reports and data exports.</span>
                        </div>
                        <div class="admin-page__field admin-page__field--full">
                            <label for="program-funding-description">Description <span class="program-form-page__optional">(Optional)</span></label>
                            <textarea class="form-control" name="description" id="program-funding-description" rows="3" placeholder="Add any useful context about this funding stream.">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="admin-page__button-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="admin-page__button">
                        <em class="icon ni ni-save" aria-hidden="true"></em>
                        Save funding
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->any() && old('tab') === 'tabItem8')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fundingModal = document.getElementById('modal234567');
            if (fundingModal && window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(fundingModal).show();
            }
        });
    </script>
@endif


<!-- Add Program Goal Outcome -->

<div class="modal fade zoom" tabindex="-1" id="logframecreate" aria-labelledby="add-program-logframe-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered logframe-create__dialog" role="document">
        <div class="modal-content logframe-form-modal logframe-create__modal">
            <div class="modal-header">
                <div class="logframe-create__heading">
                    <span class="logframe-create__icon"><em class="icon ni ni-view-col" aria-hidden="true"></em></span>
                    <div>
                        <h5 class="modal-title" id="add-program-logframe-title">Add Logframe</h5>
                        <p>Create a programme results framework for this programme.</p>
                    </div>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </button>
            </div>
            <form method="POST" action="{{ route('logframes.store')}}" id="addLogrameProgram" class="logframe-create__form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="logframe_name">Logframe name <span aria-hidden="true">*</span></label>
                        <input type="text" name="logframe_name" class="form-control" id="logframe_name" placeholder="e.g. Programme results framework" required minlength="5" aria-describedby="logframe-name-help">
                        <small class="logframe-create__help" id="logframe-name-help">Use a clear name that helps your team identify this results framework.</small>
                    </div>

                    <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="logid" value="{{ $programshow->id }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <em class="icon ni ni-check" aria-hidden="true"></em>
                        Create Logframe
                    </button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $("#addLogrameProgram").validate({
                        rules: {
                            logframe_name: {
                                required: true,
                                minlength: 5
                            }
                        },
                        messages: {
                            logframe_name: {
                                required: "Please enter a logframe name",
                                minlength: "Your logframe name must consist of at least 5 characters"
                            }
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<!-- Edit Goal -->

<div class="modal fade zoom" tabindex="-1" id="editgoal_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="editGoalForm" name="editgoal" method="post">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="edit_goal_name" placeholder="Input Goal Name">
                            </div>
                        </div>

                        <input type="hidden" name="goal_id" id="goal_id">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_code" class="form-control" id="edit_goal_code" placeholder="Input Goal Code">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Description</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_description" class="form-control" id="edit_goal_description" placeholder="Input Department Name">
                            </div>
                        </div>

                        <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                        <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                        <input type="hidden" name="status" class="form-control" id="default-01" readonly="" value="01"> 

                        <input type="hidden" name="log_frame_id" class="form-control" id="default-01" readonly="" value="{{$programshow->log_frame_id}}">

                        <!-- <button type="submit" class="btn btn-primary">Create Log Frame</button> -->
                    </div>
                    <br>
                    <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Update Goal</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="goalcreate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Logframe Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('goals.store')}}" id="addprogramgoal">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name<span style="color:red">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="goal_name" placeholder="Input Goal Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Code<i><span style="color:grey">(Optional)</span></i></label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_code" class="form-control" id="goal_code" placeholder="Input Goal Code">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Goal Description<i><span style="color:grey">(Optional)</span></i></label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="goal_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="organization_id" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->organization_id }}">

                        <input type="hidden" name="created_by" class="form-control" id="default-01" readonly="" value="{{ Auth::user()->id }}"> 

                        <input type="hidden" name="status" class="form-control" id="default-01" readonly="" value="01"> 

                        <input type="hidden" name="log_frame_id" class="form-control" id="default-01" readonly="" value="{{$programshow->log_frame_id}}">

                        <!-- <button type="submit" class="btn btn-primary">Create Log Frame</button> -->
                    </div>
                    <br>
                    <button style="margin-left: 40%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Create Goal</button>
                </form>
                <script>
                    $(document).ready(function() {
                        $("#addprogramgoal").validate({
                            rules: {
                                goal_name: {
                                    required: true,
                                    minlength: 5
                                }
                            },
                            messages: {
                                goal_name: {
                                    required: "Please enter goal name",
                                    minlength: "Your goal name must consist of at least 5 characters and above"
                                }

                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/getname')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('username');
                    $('#username').val(data);
                });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#userid').change(function(){
            $.get("{{ url('api/inviteuser')}}",
                { option: $(this).val() },
                function(data) {
                    console.log('inviteuser');
                    $('#inviteuser').val(data);
                });
        });
    });
</script>

<div class="modal fade zoom" tabindex="-1" id="addusers">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User to the Program</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5232"><em class="icon ni ni-edit"></em><span>Add User</span></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem5232">
                                    <form method="POST" action="{{ route('inviteuserprogram')}}">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Program</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" value="{{$programshow->program_name}}" id="default-01" name="program_name" readonly>
                                                </div>
                                            </div>

                                            
                                            <input type="hidden" class="form-control" value="{{$programshow->id}}" id="default-01" name="program_id" readonly>

                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Role</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="role" name="role" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                   
                                                            @foreach($roles as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group" id="program">
                                                <label class="form-label" for="default-06">Users</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select class="form-control" id="userid" name="user_id" >
                                                            <option value="#">Nothing Selected</option>
                                                            <option></option>                                                   
                                                            @foreach($programusers as $object)
                                                            <option value="{{$object->id}}">{{$object->name}}  {{$object->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" value="" id="username" name="name" readonly>

                                            <input type="hidden" class="form-control" value="" id="inviteuser" name="email" readonly>

                                        </div> 
                                    </div>
                                    <br>
                                    <button style="margin-left: 30%;" type="submit" class="btn btn-round btn-primary"><em class="icon ni ni-navigate-fill"></em>&nbsp Invite User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// Add Output
    $(document).ready(function () {
        $('body').on('click', '#addoutput', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#output_model').modal('show');
               $('#outcome_id').val(data.id);
               $('#output_title').val(data.outcome_code + '-' + data.outcome_title)
           })
        });
    }); 
</script>


<script>
// Add addoutcomeactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeactivity', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#activity1').modal('show');
               $('#outcome_id1').val(data.id);
               $('#activity_name2').val(data.outcome_code + '-' + data.outcome_title)
           })
        });
    }); 
</script>


<script>
// Add addoutcomeindicator
    $(document).ready(function () {
        $('body').on('click', '#addoutcomeindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outcomes.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#indicator1').modal('show');
               $('#outcome_id3').val(data.id);
               $('#outcome_indicator').val(data.outcome_code + '-' + data.outcome_title)
           })
        });
    }); 
</script>

<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputactivity1', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#activity2').modal('show');
               $('#output_id5').val(data.id);
               $('#output_title7').val(data.output_code + '-' + data.output_name)
           })
        });
    }); 
</script>


<script>
// Add addoutputactivity
    $(document).ready(function () {
        $('body').on('click', '#addoutputindicator', function (event) {
            event.preventDefault();
            var url = "{{ route('outputs.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#indicator2').modal('show');
               $('#output_indicator5').val(data.id);
               $('#output_indicator7').val(data.output_code + '-' + data.output_name)
           })
        });
    });
</script>


<script>
// Add editgoal
    $(document).ready(function () {
        $('body').on('click', '#editgoal', function (event) {
            event.preventDefault();
            var url = "{{ route('goals.index')}}";
            var id = $(this).data('id');
            $.get(url + '/' + id + '/edit', function (data) {
        // console.log(id);
               $('#userCrudModal').html("Output category");
               $('#submit').val("Output category");
               $('#editgoal_modal').modal('show');
               $('#edit_goal_code').val(data.goal_code);
               $('#edit_goal_name').val(data.goal_name);
               $('#edit_goal_description').val(data.goal_description)
           })
        });
    });
</script>


<script type="text/javascript">

    // deletegoal

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deletegoal', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete goal !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('goals.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Goal Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutcome

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcome', function () {

            var id = $(this).data('id');
            confirm("Are You sure want to delete Outcome!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outcomes.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // deleteoutput

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutput', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Output!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('outputs.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete goal activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete goal indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>



<script type="text/javascript">
    // delete outcome activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

<script type="text/javascript">
    // delete outcome indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutcomeindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Outcome Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Outcome Indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output activity

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputactivity', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Activity!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('activities.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output Activity Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>


<script type="text/javascript">
    // delete output indicator

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready(function () {
        $('body').on('click', '#deleteoutputindicator', function () {

            var id = $(this).data('id');
            confirm("Are You sure you want to delete this Output Indicator!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('indicators.store') }}"+'/'+id,
                success: function (data) {
                    confirm("Output indicator Has been Deleted!");
                    window.location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });

</script>

</main>
@endsection