@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.tenant.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.tenant.management') }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7 pull-right">
                    @include('backend.auth.tenant.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('labels.backend.tenant.table.tenant') }}</th>
                                <th>{{ __('labels.backend.tenant.table.users') }}</th>
                                <th>{{ __('labels.backend.tenant.table.active') }}</th>
                                <th>{{ __('labels.backend.tenant.table.end_subscription') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td>{{ ucfirst($tenant->tenant_name) }}</td>
                                    <td>{{ $tenant->users->count() }} / {{ $tenant->max_users }}</td>
                                    <td>{!! $tenant->active_label !!}</td>
                                    <td>{{ \Carbon\Carbon::parse($tenant->end_subscription)->toFormattedDateString() }}</td>
                                    <td>{!! $tenant->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $tenants->total() !!} {{ trans_choice('labels.backend.tenant.table.total', $tenants->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $tenants->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
