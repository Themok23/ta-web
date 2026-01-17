@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('All Inquiries') }}</h5>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('product_query.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <label>{{ translate('Status') }}</label>
                        <select class="form-control aiz-selectpicker" name="status" data-live-search="true">
                            <option value="">{{ translate('All Statuses') }}</option>
                            @foreach(\App\Enums\InquiryStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ translate('Category') }}</label>
                        <select class="form-control aiz-selectpicker" name="category_id" data-live-search="true">
                            <option value="">{{ translate('All Categories') }}</option>
                            @foreach(($categories ?? []) as $category)
                                <option value="{{ $category->id }}" {{ (string)request('category_id') === (string)$category->id ? 'selected' : '' }}>
                                    {{ $category->getTranslation('name') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ translate('Product') }}</label>
                        <select class="form-control aiz-selectpicker" name="product_id" data-live-search="true">
                            <option value="">{{ translate('All Products') }}</option>
                            @foreach(($products ?? []) as $product)
                                <option value="{{ $product->id }}" {{ (string)request('product_id') === (string)$product->id ? 'selected' : '' }}>
                                    {{ $product->getTranslation('name') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">{{ translate('Filter') }}</button>
                            <a href="{{ route('product_query.index') }}" class="btn btn-secondary btn-block mt-1">{{ translate('Clear') }}</a>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table aiz-table mb-0" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{ translate('User Name') }}</th>
                        <th>{{ translate('Product Name') }}</th>
                        <th data-breakpoints="lg">{{ translate('Category') }}</th>
                        <th data-breakpoints="lg">{{ translate('Question') }}</th>
                        <th data-breakpoints="lg">{{ translate('Reply') }}</th>
                        <th>{{ translate('Status') }}</th>
                        <th data-breakpoints="lg">{{ translate('Created') }}</th>
                        <th class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($queries as $key => $query)
                        <tr>
                            <td>{{ $queries->firstItem() + $key }}</td>
                            <td>{{ $query->user->name ?? translate('Customer Not Found') }}</td>
                            <td>{{ $query->product != null ? $query->product->getTranslation('name') : translate('Product Not Found') }}</td>
                            <td>
                                @if($query->category)
                                    {{ $query->category->getTranslation('name') }}
                                @elseif($query->product && $query->product->category)
                                    {{ $query->product->category->getTranslation('name') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ Str::limit($query->question, 100) }}</td>
                            <td>{{ Str::limit($query->reply, 100) }}</td>
                            <td>
                                <span class="badge badge-inline {{ $query->status?->badgeClass() ?? 'badge-secondary' }}">
                                    {{ $query->status?->label() ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $query->created_at?->format('Y-m-d') }}</td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                    href="{{ route('product_query.show', encrypt($query->id)) }}"
                                    title="{{ translate('View') }}">
                                    <i class="las la-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $queries->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
