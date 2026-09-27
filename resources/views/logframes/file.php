<div class="nk-block-head nk-block-head-lg wide-sm">
    <div class="nk-block-head-content">
        <div class="nk-block-head-sub"><a class="back-to" href="html/components.html"><em class="icon ni ni-arrow-left"></em><span>Components</span></a></div>
        <!-- <h2 class="nk-block-title fw-normal"></h2> -->
        <h6 class="title"><B>LOGFRAME</B> <span class="badge bg-success">{{$logshow->logframe_name}}</span></h6>
        <div class="nk-block-des">
        </div>
    </div>
</div>

<li class="preview-item">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalZoom">Add Goal</button>
</li>


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
    </div>
    <div class="card card-preview">
        <table class="table table-tranx">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class=""></span></th>
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>BaseLine</span>
                        </span>
                        <span class="tb-tnx-date d-md-inline-block d-none">
                            <!-- <span class="d-md-none">Date</span> -->
                            <span class="d-none d-md-block">
                                <span>Target</span>
                                <span>Frequency</span>
                            </span>
                        </span>
                    </th>
                    <th class="tb-tnx-amount is-alt">
                        <span class="tb-tnx-total">Type</span>
                        <!-- <span class="tb-tnx-status d-none d-md-inline-block">Status</span> -->
                    </th>
                    <th class="tb-tnx-action">
                        <span>&nbsp;</span>
                    </th>
                </tr>
            </thead>
            <tbody>


                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id">
                        <a href="#"><span>
                             <!-- <span class="badge bg-gray"></span> -->

                             <h6 class="title"><span class="badge bg-gray">GOAL</span>   {{$goals->goal_code}} - {{$goals->goal_name}}</h6>

                        </span></a>
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#outcome"></em>Outcome</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#activity"></em>Activity</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator"></em>Indicator</button>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </td>

                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title"></span>
                        </div>
                        <div class="tb-tnx-date">
                            <span class="date"></span>
                            <span class="date">#</span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-total">
                            <span class="amount">#</span>
                        </div>
                        <!-- <div class="tb-tnx-status"><span class="badge badge-dot bg-danger">Cancel</span></div> -->
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="#">View Comments</a></li>
                                    <!-- <li><a href="#">View Charts</a></li> -->
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
               
                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id">
                        <a href="#"><span>
                            <!-- <h6 class="title"><h6 class="title"><B>Outcome</B> <span class="badge bg-success"></span></h6> -->

                            <h6 class="title"><span class="badge bg-success">OUTCOME</span>   {{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}</h6>
                        </span></a>
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#output"></em>Output</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#activity1"></em>Activity</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator1"></em>Indicator</button>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title"></span>
                        </div>
                        <div class="tb-tnx-date">
                            <span class="date"></span>
                            <span class="date"></span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-total">
                            <span class="amount">$99.00</span>
                        </div>
                        <!-- <div class="tb-tnx-status"><span class="badge badge-dot bg-danger">Cancel</span></div> -->
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="#">View Comments</a></li>
                                    <!-- <li><a href="#">View Charts</a></li> -->
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>


                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id">
                        <a href="#"><span>
                            <!-- <h6 class="title"><B>Output</B> <span class="badge bg-danger">{{$logshow->output_code}} - {{$logshow->output_name}}</span></h6> -->

                            <h6 class="title"><span class="badge bg-success">OUTPUT</span>   {{$logshow->output_code}} - {{$logshow->output_name}}</h6>
                        </span></a>
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#activity2"></em>Activity</button>
                                    </li> 
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator2"></em>Indicator</button>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title"></span>
                        </div>
                        <div class="tb-tnx-date">
                            <span class="date"></span>
                            <span class="date">Monthly</span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-total">
                            <span class="amount">$99.00</span>
                        </div>
                        <!-- <div class="tb-tnx-status"><span class="badge badge-dot bg-danger">Cancel</span></div> -->
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="#">View Comments</a></li>
                                    <!-- <li><a href="#">View Charts</a></li> -->
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id">
                        <a href="#"><span>
                            <!-- <h6 class="title"><B>Activity</B> <span class="badge bg-warning">{{$logshow->activity_code}} - {{$logshow->activity_name}}</span></h6> -->

                            <h6 class="title"><span class="badge bg-success">ACTIVITY</span>  {{$logshow->activity_code}} - {{$logshow->activity_name}}</h6>
                        </span></a>
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-success icon ni ni-plus" data-bs-toggle="modal" data-bs-target="#indicator3"></em>Indicator</button>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title"></span>
                        </div>
                        <div class="tb-tnx-date">
                            <span class="date"></span>
                            <span class="date"></span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-total">
                            <span class="amount">$99.00</span>
                        </div>
                        <!-- <div class="tb-tnx-status"><span class="badge badge-dot bg-danger">Cancel</span></div> -->
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="#">View Comments</a></li>
                                    <!-- <li><a href="#">View Charts</a></li> -->
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div><!-- .card -->
</div><!-- nk-block -->

<!-- Goal -->
<div class="modal fade zoom" tabindex="-1" id="modalZoom">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('goals.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_name" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" >
                        <input type="hidden" name="status" class="form-control" value="01">
                        <input type="hidden" name="logframe_id" class="form-control" value="{{$logshow->id}}">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="goal_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Goal Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="goal_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!--Goal Outcome -->

<div class="modal fade zoom" tabindex="-1" id="outcome">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Outcome</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('outcomes.store')}}">
                    @csrf
                    <div class="row gy-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal Name</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_goal" class="form-control" id="default-01" placeholder=""
                                value="{{$goals->goal_code}} - {{$goals->goal_name}}" readonly="">
                            </div>
                        </div>
                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="logframe_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goals->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">


                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_title" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-01">OutCome code</label>
                            <div class="form-control-wrap">
                                <input type="text" name="outcome_code" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="default-textarea">Outcome Description(Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="outcome_description" id="default-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Goal Outcome</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Goal Activity -->

<div class="modal fade zoom" tabindex="-1" id="activity">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('activities.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="logframe_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        <input type="hidden" name="goal_id" class="form-control" value="{{$goals->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Goal</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$goals->goal_code}} - {{$goals->goal_name}}" readonly="">
                            </div>
                        </div>

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
            </div>
        </div>
    </div>
</div>

<!-- Goal Indicator -->

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
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="#">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="#" readonly="">
                            </div>
                        </div>


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
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="Type" id="Type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="label">
                            <label class="form-label" for="default-01">Label</label>
                            <div class="form-control-wrap">
                                <input type="text" name="label_none" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group" id="baseline">
                            <label class="form-label" for="default-01">Baseline</label>
                            <div class="form-control-wrap">
                                <input type="text" name="baseline_none" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        <div class="form-group" id="target">
                            <label class="form-label" for="default-01">Target</label>
                            <div class="form-control-wrap">
                                <input type="text" name="target_none" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        
                        <h1>Disaggregation</h1>
                        <div class="wrapper" id="Disaggregation">
                            <div id="survey_options">
                              <label class="form-label" for="default-01">Value</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Name">
                              <label class="form-label" for="default-01">Target</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Email">
                              <label class="form-label" for="default-01">Baseline</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Another Field">
                          </div>
                          <div class="controls">

                              <button type="button" class="btn btn-primary" id='remove_fields'>- Delete</button>
                              <button type="button" class="btn btn-primary" id='add_more_fields'>+ Add More</button>
                          </div>
                      </div>

                      <script type="text/javascript">
                          var survey_options = document.getElementById('survey_options');
                          var add_more_fields = document.getElementById('add_more_fields');
                          var remove_fields = document.getElementById('remove_fields');

                          add_more_fields.onclick = function(){
                              var newField = document.createElement('input');
                              newField.setAttribute('type','text');
                              newField.setAttribute('name','survey_options[]');
                              newField.setAttribute('class','form-control');
                              newField.setAttribute('size',50);
                              newField.setAttribute('placeholder','Another Field');
                              survey_options.appendChild(newField);
                          }

                          remove_fields.onclick = function(){
                              var input_tags = survey_options.getElementsByTagName('input');
                              if(input_tags.length > 3) {
                                survey_options.removeChild(input_tags[(input_tags.length) - 3]);
                            }
                        }
                    </script>

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
        </div>
    </div>
</div>
</div>

<!--- Outcome Output -->

<div class="modal fade zoom" tabindex="-1" id="output">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Outcome Output</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('outputs.store')}}">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Output Title</label>
                            <div class="form-control-wrap">
                                <input type="text" name="output_title" class="form-control" id="default-01" placeholder=""
                                value="{{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}" readonly="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="logframe_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" value="{{$outcomes->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

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
            </div>
        </div>
    </div>
</div>


<!--- Outcome Activity -->
<div class="modal fade zoom" tabindex="-1" id="activity1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Outcome Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('addoutcomeactivity')}}">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Outcome</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$outcomes->outcome_code}} - {{$outcomes->outcome_title}}" readonly="">
                            </div>
                        </div>

                        <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}" readonly="">
                        <input type="hidden" name="organization_id" class="form-control" value="{{Auth::user()->organization_id}}" readonly="">
                        <input type="hidden" name="logframe_id" class="form-control" value="{{$logshow->id}}" readonly="">
                        <input type="hidden" name="outcome_id" class="form-control" value="{{$outcomes->id}}" readonly="">
                        <input type="hidden" name="status" class="form-control" value="01" readonly="">

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
            </div>
        </div>
    </div>
</div>

<!-- Outcome Indicator -->

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
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
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
                <h5 class="modal-title">Add Outcome Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem similique earum necessitatibus nesciunt! Quia id expedita asperiores voluptatem odit quis fugit sapiente assumenda sunt voluptatibus atque facere autem, omnis explicabo.</p> -->

                <form method="POST" action="#">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="#" readonly="">
                            </div>
                        </div>


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
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="Type" id="Type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="label">
                            <label class="form-label" for="default-01">Label</label>
                            <div class="form-control-wrap">
                                <input type="text" name="label" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group" id="baseline">
                            <label class="form-label" for="default-01">Baseline</label>
                            <div class="form-control-wrap">
                                <input type="text" name="baseline" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        <div class="form-group" id="target">
                            <label class="form-label" for="default-01">Target</label>
                            <div class="form-control-wrap">
                                <input type="text" name="target" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        
                        <h1>Disaggregation</h1>
                        <div class="wrapper" id="Disaggregation">
                            <div id="survey_options">
                              <label class="form-label" for="default-01">Value</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Name">
                              <label class="form-label" for="default-01">Target</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Email">
                              <label class="form-label" for="default-01">Baseline</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Another Field">
                          </div>
                          <div class="controls">

                              <button type="button" class="btn btn-primary" id='remove_fields'>- Delete</button>
                              <button type="button" class="btn btn-primary" id='add_more_fields'>+ Add More</button>
                          </div>
                      </div>

                      <script type="text/javascript">
                          var survey_options = document.getElementById('survey_options');
                          var add_more_fields = document.getElementById('add_more_fields');
                          var remove_fields = document.getElementById('remove_fields');

                          add_more_fields.onclick = function(){
                              var newField = document.createElement('input');
                              newField.setAttribute('type','text');
                              newField.setAttribute('name','survey_options[]');
                              newField.setAttribute('class','form-control');
                              newField.setAttribute('size',50);
                              newField.setAttribute('placeholder','Another Field');
                              survey_options.appendChild(newField);
                          }

                          remove_fields.onclick = function(){
                              var input_tags = survey_options.getElementsByTagName('input');
                              if(input_tags.length > 3) {
                                survey_options.removeChild(input_tags[(input_tags.length) - 3]);
                            }
                        }
                    </script>

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
        </div>
    </div>
</div>
</div>

<!--- Output Activity --->

<div class="modal fade zoom" tabindex="-1" id="activity2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Output Activity</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="#">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Ouput Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="{{$outputs->output_code}} - {{$outputs->output_name}}" readonly="">
                            </div>
                        </div>

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
            </div>
        </div>
    </div>
</div>


<!---- Output Indicator -->

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
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
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
                <h5 class="modal-title">Add Output Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem similique earum necessitatibus nesciunt! Quia id expedita asperiores voluptatem odit quis fugit sapiente assumenda sunt voluptatibus atque facere autem, omnis explicabo.</p> -->

                <form method="POST" action="#">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="#" readonly="">
                            </div>
                        </div>


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
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="Type" id="Type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="label">
                            <label class="form-label" for="default-01">Label</label>
                            <div class="form-control-wrap">
                                <input type="text" name="label" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group" id="baseline">
                            <label class="form-label" for="default-01">Baseline</label>
                            <div class="form-control-wrap">
                                <input type="text" name="baseline" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        <div class="form-group" id="target">
                            <label class="form-label" for="default-01">Target</label>
                            <div class="form-control-wrap">
                                <input type="text" name="target" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        
                        <h1>Disaggregation</h1>
                        <div class="wrapper" id="Disaggregation">
                            <div id="survey_options">
                              <label class="form-label" for="default-01">Value</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Name">
                              <label class="form-label" for="default-01">Target</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Email">
                              <label class="form-label" for="default-01">Baseline</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Another Field">
                          </div>
                          <div class="controls">

                              <button type="button" class="btn btn-primary" id='remove_fields'>- Delete</button>
                              <button type="button" class="btn btn-primary" id='add_more_fields'>+ Add More</button>
                          </div>
                      </div>

                      <script type="text/javascript">
                          var survey_options = document.getElementById('survey_options');
                          var add_more_fields = document.getElementById('add_more_fields');
                          var remove_fields = document.getElementById('remove_fields');

                          add_more_fields.onclick = function(){
                              var newField = document.createElement('input');
                              newField.setAttribute('type','text');
                              newField.setAttribute('name','survey_options[]');
                              newField.setAttribute('class','form-control');
                              newField.setAttribute('size',50);
                              newField.setAttribute('placeholder','Another Field');
                              survey_options.appendChild(newField);
                          }

                          remove_fields.onclick = function(){
                              var input_tags = survey_options.getElementsByTagName('input');
                              if(input_tags.length > 3) {
                                survey_options.removeChild(input_tags[(input_tags.length) - 3]);
                            }
                        }
                    </script>

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
        </div>
    </div>
</div>
</div>


<!--- Activity Indicator --> 

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
            $('#Disaggregation').hide();
        }else if($(this).val() == 'Disaggregation'){
            $('#Disaggregation').show();
            $('#baseline').hide();
            $('#target').hide();
        }else if($(this).val() == 'ALIENID'){
            $('#document_number').show();
        }
        else{
           $('#null').show('');
       }
   });
    });

</script>

<div class="modal fade zoom" tabindex="-1" id="indicator3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Activity Indicator</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form method="POST" action="#">
                    @csrf

                    <div class="row gy-4">

                        <div class="form-group">
                            <label class="form-label" for="default-01">Activity</label>
                            <div class="form-control-wrap">
                                <input type="text" name="activity_name" class="form-control" id="default-01" placeholder=""
                                value="#" readonly="">
                            </div>
                        </div>


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
                            <label class="form-label" for="default-06">Disaggregation</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="disaggregation" id="disaggregation">
                                        <option value="#">-------Select Disaggregation-------</option>
                                        <option></option>
                                        <option value="none">None</option>
                                        <option value="Disaggregation">Disaggregation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="default-06">Type</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" name="Type" id="Type">
                                        <option value="#">-------Select Type-------</option>
                                        <option></option>
                                        <option value="Quantitative">Quantitative</option>
                                        <option value="Qualitative">Qualitative</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="label">
                            <label class="form-label" for="default-01">Label</label>
                            <div class="form-control-wrap">
                                <input type="text" name="label" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>

                        <div class="form-group" id="baseline">
                            <label class="form-label" for="default-01">Baseline</label>
                            <div class="form-control-wrap">
                                <input type="text" name="baseline" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        <div class="form-group" id="target">
                            <label class="form-label" for="default-01">Target</label>
                            <div class="form-control-wrap">
                                <input type="text" name="target" class="form-control" id="default-01" placeholder="">
                            </div>
                        </div>


                        
                        <h1>Disaggregation</h1>
                        <div class="wrapper" id="Disaggregation">
                            <div id="survey_options">
                              <label class="form-label" for="default-01">Value</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Name">
                              <label class="form-label" for="default-01">Target</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Email">
                              <label class="form-label" for="default-01">Baseline</label>
                              <input type="text" name="survey_options[]" class="form-control" size="50" placeholder="Another Field">
                          </div>
                          <div class="controls">

                              <button type="button" class="btn btn-primary" id='remove_fields'>- Delete</button>
                              <button type="button" class="btn btn-primary" id='add_more_fields'>+ Add More</button>
                          </div>
                      </div>

                      <script type="text/javascript">
                          var survey_options = document.getElementById('survey_options');
                          var add_more_fields = document.getElementById('add_more_fields');
                          var remove_fields = document.getElementById('remove_fields');

                          add_more_fields.onclick = function(){
                              var newField = document.createElement('input');
                              newField.setAttribute('type','text');
                              newField.setAttribute('name','survey_options[]');
                              newField.setAttribute('class','form-control');
                              newField.setAttribute('size',50);
                              newField.setAttribute('placeholder','Another Field');
                              survey_options.appendChild(newField);
                          }

                          remove_fields.onclick = function(){
                              var input_tags = survey_options.getElementsByTagName('input');
                              if(input_tags.length > 3) {
                                survey_options.removeChild(input_tags[(input_tags.length) - 3]);
                            }
                        }
                    </script>

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
        </div>
    </div>
</div>
</div>