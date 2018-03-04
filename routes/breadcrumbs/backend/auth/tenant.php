<?php

Breadcrumbs::register('admin.auth.tenant.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.tenant.management'), route('admin.auth.tenant.index'));
});

Breadcrumbs::register('admin.auth.tenant.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.tenant.management'), route('admin.auth.tenant.edit', $id));
});

Breadcrumbs::register('admin.auth.tenant.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.tenant.management'), route('admin.auth.tenant.create'));
});