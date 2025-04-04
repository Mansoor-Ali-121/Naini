@extends('template')

@section('main_section')

    @include('dashboard.includes.alerts')

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 mx-auto" style="font-family: 'Dancing Script', cursive; font-weight: bold;">Edit Category</h4>
                <a href="{{ route('category.show') }}" class="btn btn-outline-light" style="font-family: 'Dancing Script', cursive;">Back</a>
            </div>

            <div class="card-body">

                <form action="{{ route('category.update', ['id' => $cat->id]) }}" method="POST">

                    @csrf
                    @method('PATCH') <!-- This is needed to make the form use PUT instead of POST -->

                    <!-- Category Name -->
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-dark" style="font-family: 'Dancing Script', cursive;">Category Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" required
                               placeholder="Enter the name of the dish" value="{{ old('name', $cat->name) }}"
                               style="font-family: 'Dancing Script', cursive;">
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category Description -->
                    <div class="form-group mb-4">
                        <label for="description" class="font-weight-bold text-dark" style="font-family: 'Dancing Script', cursive;">Category Description</label>
                        <input type="text" class="form-control form-control-lg" id="description" name="description" required 
                               placeholder="Describe the food to your customer's" value="{{ old('description', $cat->description) }}"
                               style="font-family: 'Dancing Script', cursive;">
                        @error('description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-4 py-2 rounded-pill" style="font-family: 'Dancing Script', cursive;">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
@endsection
