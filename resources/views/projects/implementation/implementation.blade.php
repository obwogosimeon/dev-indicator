<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="tab-pane active project-detail__tab-pane" id="tabItem1" role="tabpanel" aria-labelledby="project-implementation-tab">
    <div class="content d-flex flex-column flex-column-fluid">
        <div class="subheader py-2 py-lg-4 project-workspace__header">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="project-workspace__heading">
                    <p class="admin-page__eyebrow">Delivery tracking</p>
                    <h2>Implementation</h2>
                    <p>Review and manage implementation periods, reports, and approvals.</p>
                </div>
                <div class="project-workspace__header-actions">
                    <span class="project-workspace__count">{{ $impcontainers->count() }} {{ \Illuminate\Support\Str::plural('container', $impcontainers->count()) }}</span>
                    <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom877">
                        <em class="icon ni ni-plus" aria-hidden="true"></em>
                        Add implementation container
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview project-workspace__content">
            <div class="card-inner project-implementation__list" id="implementation-accordion">
                @if($impcontainers->isEmpty())
                    <div class="project-detail__empty-state">
                        <span class="project-detail__record-icon program-detail__record-icon--green"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
                        <h3>No implementation containers yet</h3>
                        <p>Create an implementation container to begin tracking delivery and reporting periods.</p>
                        <button type="button" class="admin-page__button" data-bs-toggle="modal" data-bs-target="#modalZoom877">
                            <em class="icon ni ni-plus" aria-hidden="true"></em>
                            Add implementation container
                        </button>
                    </div>
                @endif
                @foreach($impcontainers as $key1 => $imp)
                <article id="implementation-accordion-{{ $imp->id }}" class="accordion project-workspace__accordion project-intervention__container project-implementation__container">
                    <div class="accordion-item">
                        <div class="project-intervention__container-head">
                            <a href="#implementation-content-{{ $imp->id }}" class="accordion-head collapsed project-intervention__toggle" data-bs-toggle="collapse" data-bs-target="#implementation-content-{{ $imp->id }}" aria-expanded="false" aria-controls="implementation-content-{{ $imp->id }}">
                                <span class="project-intervention__container-icon"><em class="icon ni ni-check-circle" aria-hidden="true"></em></span>
                                <span class="project-intervention__container-heading">
                                    <span>Implementation period</span>
                                    <strong>{{ $imp->container_name }}</strong>
                                    <span class="project-implementation__workplan">{{ optional($imp->workplancontainer)->container_name ?: 'No linked work plan' }}</span>
                                </span>
                                @if($imp->status == '01')
                                    <span class="project-intervention__status project-intervention__status--draft">Draft</span>
                                @elseif($imp->status == '02')
                                    <span class="project-intervention__status project-intervention__status--submitted">Submitted</span>
                                @elseif($imp->status == '03')
                                    <span class="project-intervention__status project-intervention__status--forwarded">Forwarded</span>
                                @elseif($imp->status == '04')
                                    <span class="project-intervention__status project-intervention__status--approved">Approved</span>
                                @elseif($imp->status == '05')
                                    <span class="project-intervention__status project-intervention__status--reported">Reported</span>
                                @elseif($imp->status == '06')
                                    <span class="project-intervention__status project-intervention__status--forwarded">Report forwarded</span>
                                @elseif($imp->status == '07')
                                    <span class="project-intervention__status project-intervention__status--approved">Report approved</span>
                                @else
                                    <span class="admin-page__badge admin-page__badge--neutral">Status {{ $imp->status }}</span>
                                @endif
                                <span class="project-implementation__frequency">@include('projects.frequency.frequency')</span>
                                <span class="accordion-icon"></span>
                            </a>
                            <div class="dropdown project-intervention__actions">
                                <button type="button" class="project-intervention__actions-trigger" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Actions for {{ $imp->container_name }}">
                                    <span>Actions</span><em class="icon ni ni-chevron-down" aria-hidden="true"></em>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-plain">
                                    @if($imp->status == '01')
                                        <li class="preview-item">
                                            <button type="button" id="submitcontainer" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#submitcontainer"><em class="icon ni ni-send" aria-hidden="true"></em>Submit</button>
                                        </li>
                                        <li class="preview-item">
                                            <button type="button" id="impCancel" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#impCancel"><em class="icon ni ni-cross" aria-hidden="true"></em>Delete</button>
                                        </li>
                                    @elseif($imp->status == '02')
                                        <li class="preview-item">
                                            <button type="button" id="impTimeline" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#impTimeline"><em class="icon ni ni-setting" aria-hidden="true"></em>Timeline</button>
                                        </li>
                                        <li class="preview-item">
                                            <button type="button" id="impCancel" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#impCancel"><em class="icon ni ni-cross" aria-hidden="true"></em>Cancel</button>
                                        </li>
                                        @can('forward-imp')
                                            <li class="preview-item">
                                                <button type="button" id="forwardcontainer" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#forwardcontainer"><em class="icon ni ni-forward-arrow" aria-hidden="true"></em>Forward</button>
                                            </li>
                                        @endcan
                                        @can('approve-imp')
                                            <li class="preview-item">
                                                <button type="button" id="approvecontainer" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#approvecontainer"><em class="icon ni ni-done" aria-hidden="true"></em>Approve</button>
                                            </li>
                                        @endcan
                                        @can('reject-imp')
                                            <li class="preview-item">
                                                <button type="button" id="rejectcontainer" data-id="{{ $imp->id }}" data-bs-toggle="modal" data-bs-target="#rejectcontainer"><em class="icon ni ni-cross" aria-hidden="true"></em>Reject</button>
                                            </li>
                                        @endcan
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-body collapse" id="implementation-content-{{ $imp->id }}" data-bs-parent="#implementation-accordion">
                            <div class="accordion-inner">
                                <div class="card card-bordered card-preview">
                            @if(!$imp->workplancontainer)
                                <div class="alert alert-warning project-implementation__unlinked" role="alert">
                                    <em class="icon ni ni-alert-circle" aria-hidden="true"></em>
                                    <span>This implementation period is not linked to an available work plan. Link a work plan before recording results.</span>
                                </div>
                            @elseif($imp->workplancontainer->planning_type == 'Activity')
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <ul class="nav nav-tabs mt-n3">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1000">Total Funding</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabItem1000">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><B><I>WorkPlan</I></B></td>
                                                        <td><B><I>Budget-Annual</td>
                                                            <td><B><I>Budget-Current Period</td>
                                                                <td><B><I>Expense-Previous Period</td>
                                                                    <td><B><I>Expense-Current Period</td>
                                                                        <td><B><I>Expense-Total</td>
                                                                            <td><B><I>% Utilization</td>
                                                                            </tr>
                                                                        </thead>
                                                                        @foreach($budget as $key => $obj)
                                                                        <?php
                                                                        $amounta = $obj->annual_amounta;
                                                                        $amountb = $obj->annual_amountb;
                                                                        $total = $amounta + $amountb;
                                                                        ?>
                                                                        <tr>
                                                                            <td>{{$obj->workplan_name}}</td>
                                                                            <td>KES @convert($total)</td>
                                                                            <td>{{$obj->budget_current_period_yearly1 + $obj->budget_current_period_yearly2}}</td>
                                                                            <td>0</td>
                                                                            <td>{{$obj->expense_current_period_yearly1 + $obj->expense_current_period_yearly2}}</td>
                                                                            <td>{{$obj->expense_current_period_yearly1 + $obj->expense_current_period_yearly2}}</td>
                                                                            <td>{{ round(($obj->expense_current_period_yearly1 + $obj->expense_current_period_yearly2) * 100 / $total, 1)}} %</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>


                                                                <hr>
                                                                @if($projectshow->reporting_frequency == 'Annaul' && $imp->reporting_frequency == '1')
                                                                @foreach($accounts as $funding)
                                                                @if($loop->first)
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amounta)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_yearly1">{{$obj->budget_current_period_yearly1}}</td>
                                                                        <td>0</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_yearly1">{{$obj->expense_current_period_yearly1}}</td>
                                                                        <td>{{$obj->expense_current_period_yearly1}}</td>
                                                                        <td>{{ round($obj->expense_current_period_yearly1 * 100 / $obj->annual_amounta, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @if($loop->last)
                                                                <hr>
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amountb)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_yearly2">{{$obj->budget_current_period_yearly2}}</td>
                                                                        <td>0</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_yearly2">{{$obj->expense_current_period_yearly2}}</td>
                                                                        <td>{{$obj->expense_current_period_yearly2}}</td>
                                                                        <td>{{ round($obj->expense_current_period_yearly2 * 100 / $obj->annual_amountb, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @endforeach
                                                                @elseif($projectshow->reporting_frequency == 'SemiAnnual' && $imp->reporting_frequency == '1')
                                                                @foreach($accounts as $funding)
                                                                @if($loop->first)
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amounta)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_firstsemi1">{{$obj->budget_current_period_firstsemi1}}</td>
                                                                        <td>{{$obj->budget_current_period_firstsemi1}}</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_firstsemi1">{{$obj->expense_current_period_firstsemi1}}</td>
                                                                        <td>{{$obj->expense_current_period_firstsemi1}}</td>
                                                                        <td>{{ round($obj->expense_current_period_firstsemi1 * 100 / $obj->annual_amounta, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @if($loop->last)
                                                                <hr>
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amountb)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_firstsemi2">{{$obj->budget_current_period_firstsemi2}}</td>
                                                                        <td>{{$obj->budget_current_period_firstsemi2}}</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_firstsemi2">{{$obj->expense_current_period_firstsemi2}}</td>
                                                                        <td>{{$obj->expense_current_period_firstsemi2}}</td>
                                                                        <td>{{ round($obj->expense_current_period_firstsemi2 * 100 / $obj->annual_amountb, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @endforeach
                                                                @elseif($projectshow->reporting_frequency == 'SemiAnnual' && $imp->reporting_frequency == '2')
                                                                @foreach($accounts as $funding)
                                                                @if($loop->first)
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amounta)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_secondsemi1">{{$obj->budget_current_period_secondsemi1}}</td>
                                                                        <td>{{$obj->budget_current_period_secondsemi1}}</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_secondsemi1">{{$obj->expense_current_period_secondsemi1}}</td>
                                                                        <td>{{$obj->expense_current_period_secondsemi1}}</td>
                                                                        <td>{{ round($obj->expense_current_period_secondsemi1 * 100 / $obj->annual_amounta, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @if($loop->last)
                                                                <hr>
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#"><B>{{ $funding->funding_name }}</B></a>
                                                                </li>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><B><I>WorkPlan</I></B></td>
                                                                            <td>Budget-Annual</td>
                                                                            <td>Budget-Current Period</td>
                                                                            <td>Expense-Previous Period</td>
                                                                            <td>Expense-Current Period</td>
                                                                            <td>Expense-Total</td>
                                                                            <td>% Utilization</td>
                                                                            <td class="tb-tnx-action">Action</td>
                                                                        </tr>
                                                                    </thead>
                                                                    @foreach($budgets as $key => $obj)
                                                                    <tr data-id="{{ $obj->id }}">
                                                                        <td>{{$obj->workplan_name}}</td>
                                                                        <td>KES @convert($obj->annual_amountb)</td>
                                                                        <td contenteditable="true" class="editable" data-field="budget_current_period_secondsemi2">{{$obj->budget_current_period_secondsemi2}}</td>
                                                                        <td>{{$obj->budget_current_period_secondsemi2}}</td>
                                                                        <td contenteditable="true" class="editable" data-field="expense_current_period_secondsemi2">{{$obj->expense_current_period_secondsemi2}}</td>
                                                                        <td>{{$obj->expense_current_period_secondsemi2}}</td>
                                                                        <td>{{ round($obj->expense_current_period_secondsemi2 * 100 / $obj->annual_amountb, 1)}} %</td>
                                                                        <td><button class="save-btn">Save</button></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                       document.addEventListener('DOMContentLoaded', function() {
                                                        document.querySelectorAll('.save-btn').forEach(function(button) {
                                                            button.addEventListener('click', async function() {
                                                                const row = this.closest('tr');
                                                                const budgetExpenseID = row.getAttribute('data-id');
                                                                const updatedData = {};

                                                                row.querySelectorAll('.editable').forEach(function(cell) {
                                                                    const field = cell.getAttribute('data-field');
                                                                    const value = cell.textContent.trim();
                                                                    updatedData[field] = value;
                                                                });

                                                                try {

                                                                    const url = `{{ route('budget.update.expense', ['budgetExpenseID' => '__ID__']) }}`
                                                                    .replace('__ID__', budgetExpenseID);


                                                                    console.log('Sending to:', url);

                                                                    const response = await fetch(url, {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'Content-Type': 'application/json',
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                                                            'Accept': 'application/json'
                                                                        },
                                                                        body: JSON.stringify(updatedData)
                                                                    });

                                                                    const data = await response.json();

                                                                    if (!response.ok) {
                                                                        throw new Error(data.error || 'Update failed');
                                                                    }

                                                                    if (data.success) {
                                                                        alert('Updated successfully!');
                    
                                                                        location.reload();
                                                                    } else {
                                                                        alert('Update failed: ' + (data.message || 'Unknown error'));
                                                                    }
                                                                } catch (error) {
                                                                    console.error('Error:', error);
                                                                    alert('Error updating: ' + error.message);
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                                @elseif($imp->workplancontainer->planning_type == 'Indicator')
                                                <table class="table">
                                                    <thead> 
                                                        <tr>
                                                            <th>Indicator Name</th>
                                                            <th>Value</th>
                                                            <th>Annual Target</th>
                                                            <th>Target-Current Period</th>
                                                            <th>Achieved-Previous Period</th>
                                                            <th>Achieved-Current Period</th>
                                                            <th>Total Achieved</th>
                                                            <th>% Achievement</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @foreach($indicatortargets as $key => $obj)
                                                        <tr>
                                                            <td>{{$obj->indicator->indicator_title}}</td>
                                                            <td>{{$obj->label}}</td>
                                                            @if($obj->reporting == 'Monthly')
                                                            <?php
                                                            $jan = $obj->january;
                                                            $input1 = json_decode($jan, true);
                                                            $jsum = array_sum($input1);
                                                            $feb = $obj->february;
                                                            $input2 = json_decode($feb, true);
                                                            $fsum = array_sum($input2);
                                                            $march = $obj->march;
                                                            $input3 = json_decode($march, true);
                                                            $msum = array_sum($input3);
                                                            $april = $obj->april;
                                                            $input4 = json_decode($april, true);
                                                            $asum = array_sum($input4);
                                                            $may = $obj->may;
                                                            $input5 = json_decode($may, true);
                                                            $masum = array_sum($input5);
                                                            $june = $obj->june;
                                                            $input6 = json_decode($june, true);
                                                            $jusum = array_sum($input6);
                                                            $july = $obj->july;
                                                            $input7 = json_decode($july, true);
                                                            $julsum = array_sum($input7);
                                                            $august = $obj->august;
                                                            $input8 = json_decode($august, true);
                                                            $augsum = array_sum($input8);
                                                            $september = $obj->september;
                                                            $input9 = json_decode($september, true);
                                                            $sepsum = array_sum($input9);
                                                            $october = $obj->october;
                                                            $input10 = json_decode($october, true);
                                                            $octsum = array_sum($input10);
                                                            $november = $obj->november;
                                                            $input11 = json_decode($november, true);
                                                            $novsum = array_sum($input11);
                                                            $december = $obj->december;
                                                            $input12 = json_decode($december, true);
                                                            $decsum = array_sum($input12);
                                                            $sumArrayM = $jsum + $fsum + $msum + $asum + $masum + $jusum + $julsum + $augsum + $sepsum + $octsum + $novsum + $decsum;
                                                            ?>
                                                            <td>{{$sumArrayM}}</td>
                                                            @elseif($obj->reporting == 'Annual')
                                                            <?php
                                                            $jandec = $obj->jan_december;
                                                            $input1 = json_decode($jandec, true);
                                                            $jdsum = array_sum($input1);
                                                            ?>
                                                            <td>{{$jdsum}}</td>
                                                            @elseif($obj->reporting == 'Bi-Monthly')
                                                            <?php
                                                            $janfeb = $obj->jan_feb;
                                                            $input1 = json_decode($janfeb, true);
                                                            $jfsum = array_sum($input1);
                                                            $marapr = $obj->mar_apr;
                                                            $input2 = json_decode($marapr, true);
                                                            $masum = array_sum($input2);
                                                            $mayjun = $obj->may_june;
                                                            $input3 = json_decode($mayjun, true);
                                                            $mayjune = array_sum($input3);
                                                            $julaug = $obj->july_aug;
                                                            $input4 = json_decode($julaug, true);
                                                            $julaugs = array_sum($input4);
                                                            $sepo = $obj->sep_oct;
                                                            $input5 = json_decode($sepo, true);
                                                            $sepoct = array_sum($input5);
                                                            $nodec = $obj->nov_dec;
                                                            $input6 = json_decode($nodec, true);
                                                            $novdec = array_sum($input6);
                                                            $sumArrayBi = $jfsum + $masum + $mayjune + $julaugs + $sepoct + $novdec;
                                                            ?>
                                                            <td>{{$sumArrayBi}}</td>
                                                            @elseif($obj->reporting == 'Quaterly')
                                                            <?php 
                                                            $jan_march = $obj->jan_march;
                                                            $input1 = json_decode($jan_march, true);
                                                            $jmsum = array_sum($input1);
                                                            $april_june = $obj->april_june;
                                                            $input2 = json_decode($april_june, true);
                                                            $ajsum = array_sum($input2);
                                                            $july_september = $obj->july_september;
                                                            $input3 = json_decode($july_september, true);
                                                            $jssum = array_sum($input3);
                                                            $october_december = $obj->october_december;
                                                            $input4 = json_decode($october_december, true);
                                                            $odsum = array_sum($input4);
                                                            $sumArray = $jmsum + $ajsum + $jssum + $odsum;
                                                            ?>
                                                            <td>{{$sumArray}}</td>
                                                            @elseif($obj->reporting == 'Semi-Annual')
                                                            <?php
                                                            $jan_june = $obj->jan_june;
                                                            $input1 = json_decode($jan_june, true);
                                                            $janjunesum = array_sum($input1);
                                                            $july_december = $obj->july_december;
                                                            $input2 = json_decode($july_december, true);
                                                            $julyjunesum = array_sum($input2);
                                                            $sumArraySemi = $janjunesum + $julyjunesum;
                                                            ?>
                                                            <td>{{$sumArraySemi}}</td>
                                                            @endif
                                                            @if($obj->reporting == 'Monthly')
                                                            <td>{{$obj->january}}</td>
                                                            @elseif($obj->reporting == 'Annual')
                                                            <td>{{$obj->jan_december}}</td>
                                                            @elseif($obj->reporting == 'Bi-Monthly')
                                                            <td>{{$obj->jan_feb}}</td>
                                                            @elseif($obj->reporting == 'Semi-Annual')
                                                            <td>{{$obj->jan_june}}</td>
                                                            @endif
                                                            <td>0</td>
                                                            <td contenteditable="true">0</td>
                                                            <td>0</td>
                                                            <td>0%</td>
                                                            <td>
                                                                @if($imp->status == '01')
                                                                <li><a href="{{ url('indicatorupdate', $obj->id) }}">Update</a></li>
                                                                @endif 
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </thead>
                                                    <hr>
                                                </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </article>
                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>