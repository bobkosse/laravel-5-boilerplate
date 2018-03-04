@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.tenant.management'))

@section('content')
    {{ html()->modelForm($tenant, 'PATCH', route('admin.auth.tenant.update', $tenant->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.tenant.management') }}
                        <small class="text-muted">{{ __('labels.backend.tenant.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.tenant.tenant_name'))->class('col-md-2 form-control-label')->for('tenant_name') }}

                        <div class="col-md-10">
                            {{ html()->text('tenant_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.tenant.tenant_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.tenant.end_subscription'))->class('col-md-2 form-control-label')->for('tenant_name') }}

                        <div class="col-md-10">
                            {{ html()->input('date', 'end_subscription', \Carbon\Carbon::parse($tenant->end_subscription)->format('Y-m-d'))
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.tenant.end_subscription'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="checkbox">
                                {{ html()->label(__('validation.attributes.backend.tenant.active'))->class('col-md-2 form-control-label')->for('active') }}
                                {{ html()->label(
                                        html()->checkbox('active', $tenant->active, $tenant->active)
                                              ->class('switch-input')
                                              ->id('active')
                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                    ->class('switch switch-sm switch-3d switch-primary')
                                    ->for('active') }}
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.tenant.max_users'))->class('col-md-2 form-control-label')->for('max_users') }}

                        <div class="col-md-10">
                            {{ html()->input('number', 'max_users', $tenant->max_users)
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.tenant.max_users'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.tenant.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
