@extends('layouts.app')

@section('title', 'CAKES - Edit Profile')

@section('content')

    <section id="log" class="section section_profile">
        <div class="log_container profile">

            <h2 class="section_title"><i class="ri-user-settings-line"></i> Profile Edit</h2>

            <div class="profile_content">
                <form action="{{ route('profile.update') }}" method="POST" class="log_form">

                    @csrf
                    @method('PUT')
                    
                    <div class="form_group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="form_group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="text" id="email" name="email" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    
                    <div class="form_group">
                        <label for="phone"><strong>Phone Number:</strong></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                    </div>

                    <div class="form_group">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" id="address" name="address" value="{{ old('address', auth()->user()->address) }}">
                    </div>

                    <button type="submit" class="log_button">Update Profile</button>

                </form>
            </div>
        </div>
    </section>

    <script src="/js/header-scrolled.js"></script>

@endsection