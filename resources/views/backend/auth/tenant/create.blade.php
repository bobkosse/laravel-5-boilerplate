@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.tenant.management'))

@section('content')
    {{ html()->modelForm('tenant', 'POST', route('admin.auth.tenant.store'))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.tenant.management') }}
                        <small class="text-muted">{{ __('labels.backend.tenant.create') }}</small>
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
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.tenant.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
