@extends('layouts.app')

@section('title', 'CAKES - Profile')

@section('content')

    <section id="log" class="section section_profile">
        <div class="log_container profile">

            <h2 class="section_title"><i class="ri-id-card-line"></i> User Profile</h2>

                <div class="profile_content">

                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p> <br>

                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p> <br>

                    <p><strong>Phone Number:</strong> {{ auth()->user()->phone }}</p> <br>

                    <p><strong>Address:</strong> {{ auth()->user()->address }}</p> <br>

                    <span><a href="{{ route('profile_edit') }}"><button class="log_button">Update</button></a></span>

                </div>
        </div>
    </section> 

    <script src="/js/header-scrolled.js"></script>

@endsection