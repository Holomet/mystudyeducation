@extends('layouts.admin')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col pt-md-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{__('New Plan')}}</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <form method="post" action="{{ route('admin.plans.create') }}" autocomplete="off">
                        @csrf
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-amount">{{ __('Plan Amount') }}</label>
                                <input type="text" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Plan Amount') }}" value="{{ old('amount') }}" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('commission') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-commission">{{ __('Plan Commission') }}</label>
                                <input type="text" name="commission" id="input-commission" class="form-control form-control-alternative{{ $errors->has('commission') ? ' is-invalid' : '' }}" placeholder="{{ __('Plan Commission') }}" value="{{ old('commission') }}" required autofocus>

                                @if ($errors->has('commission'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('tax') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-tax">{{ __('Plan Tax') }}</label>
                                <input type="text" name="tax" id="input-tax" class="form-control form-control-alternative{{ $errors->has('tax') ? ' is-invalid' : '' }}" placeholder="{{ __('Plan Tax') }}" value="{{ old('tax') }}" required autofocus>

                                @if ($errors->has('tax'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('total') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-total">{{ __('Plan Total') }}</label>
                                <input type="text" name="total" id="input-total" class="form-control form-control-alternative{{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="{{ __('Plan Total') }}" value="{{ old('total') }}" required autofocus>

                                @if ($errors->has('total'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('item_count') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-item_count">{{ __('Allowed Items') }}</label>
                                <input type="text" name="item_count" id="input-item_count" class="form-control form-control-alternative{{ $errors->has('item_count') ? ' is-invalid' : '' }}" placeholder="{{ __('Item Count') }}" value="{{ old('item_count') }}" required autofocus>

                                @if ($errors->has('item_count'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('item_count') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('payout_amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-payout_amount">{{ __('Payout Amount') }}</label>
                                <input type="text" name="payout_amount" id="input-payout_amount" class="form-control form-control-alternative{{ $errors->has('payout_amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Payout Amount') }}" value="{{ old('payout_amount') }}" required autofocus>

                                @if ($errors->has('payout_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payout_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('maximum_visits') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-maximum_visits">{{ __('Payout Amount') }}</label>
                                <input type="text" name="maximum_visits" id="input-maximum_visits" class="form-control form-control-alternative{{ $errors->has('maximum_visits') ? ' is-invalid' : '' }}" placeholder="{{ __('Maximum visit count') }}" value="{{ old('maximum_visits') }}" required autofocus>

                                @if ($errors->has('maximum_visits'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('maximum_visits') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('product_images') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-product_images">{{ __('Product Images count') }}</label>
                                <input type="text" name="product_images" id="input-product_images" class="form-control form-control-alternative{{ $errors->has('product_images') ? ' is-invalid' : '' }}" placeholder="{{ __('Maximum visit count') }}" value="{{ old('product_images') }}" required autofocus>

                                @if ($errors->has('product_images'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_images') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('storage') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-storage">{{ __('Storage') }}</label>
                                <input type="text" name="storage" id="input-storage" class="form-control form-control-alternative{{ $errors->has('storage') ? ' is-invalid' : '' }}" placeholder="{{ __('Storage') }}" value="{{ old('storage') }}" required autofocus>

                                @if ($errors->has('storage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('storage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('count_product_categories') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-count_product_categories">{{ __('Number of product/service catagories') }}</label>
                                <input type="text" name="count_product_categories" id="input-count_product_categories" class="form-control form-control-alternative{{ $errors->has('count_product_categories') ? ' is-invalid' : '' }}" placeholder="{{ __('Number of product/service catagories') }}" value="{{ old('count_product_categories') }}" required autofocus>

                                @if ($errors->has('count_product_categories'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('count_product_categories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('status')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <option>Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
                            <a href="{{ route('admin.users') }}" class="btn mt-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
</script>
@endpush