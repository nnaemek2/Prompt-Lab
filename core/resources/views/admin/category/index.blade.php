@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            {{ __($category->name) }}
                                        </td>

                                        <td>
                                            @php echo $category->statusBadge; @endphp
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="d-flex justify-content-end flex-wrap gap-1">
                                                    <button class="btn btn-outline--primary editBtn cuModalBtn btn-sm"
                                                        data-modal_title="@lang('Update Category')"
                                                        data-resource="{{ $category }}">
                                                        <i class="las la-pen"></i>@lang('Edit')
                                                    </button>

                                                    @if ($category->status == Status::ENABLE)
                                                        <button class="btn btn-outline--danger btn-sm confirmationBtn"
                                                            data-question="@lang('Are you sure to disable this category?')"
                                                            data-action="{{ route('admin.category.status', $category->id) }}">
                                                            <i class="la la-eye-slash"></i>@lang('Disable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-outline--success btn-sm confirmationBtn"
                                                            data-question="@lang('Are you sure to enable this category?')"
                                                            data-action="{{ route('admin.category.status', $category->id) }}">
                                                            <i class="la la-eye"></i>@lang('Enable')
                                                        </button>
                                                    @endif

                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($categories->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($categories) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--Cu Modal -->
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" name="name" type="text" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Category')">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/cu-modal.js') }}"></script>
@endpush

