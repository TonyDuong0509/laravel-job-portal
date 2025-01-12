@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Blog</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Blog Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box">
        <div class="archive-header pt-40">
            <div class="container">
                <div class="box-white">
                    <!-- <div class="max-width-single"><a class="btn btn-tag" href="#">Job Tips</a> -->
                    <h2 class="mb-30 mt-20">{{ $blog->title }}</h2>
                    <div class="post-meta text-muted d-flex mx-auto">
                        <div class="author d-flex mr-30"><span>{{ $blog->author->name }}</span></div>
                        <div class="date"><span class="font-xs color-text-paragraph-2 mr-20 d-inline-block"><img
                                    class="img-middle mr-5"
                                    src="{{ asset('frontend/assets/imgs/page/blog/calendar.svg') }}">{{ $blog->created_at }}</span>
                            {{-- <span class="font-xs color-text-paragraph-2 d-inline-block"><img class="img-middle mr-5"
                                    src="{{ asset('frontend/assets/imgs/template/icons/time.svg') }}"> 8 mins to
                                read</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <div class="post-loop-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="single-body">
                        <figure><img style="height: 400px; width: 100%; object-fit: cover" src="{{ $blog->image }}"
                                alt="{{ $blog->title }}"></figure>
                        <div class="">
                            <div class="content-single">
                                <p>{!! $blog->description !!}</p>
                            </div>
                            <div class="single-apply-jobs mt-20">
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-7 text-lg-end social-share">
                                        <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                                        <a data-social="facebook" class="mr-5 d-inline-block d-middle" href="#"><img
                                                alt="joblist"
                                                src="{{ asset('frontend/assets/imgs/template/icons/share-fb.svg') }}">
                                        </a>
                                        <a data-social="twitter" class="mr-5 d-inline-block d-middle" href="#"><img
                                                alt="joblist"
                                                src="{{ asset('frontend/assets/imgs/template/icons/share-tw.svg') }}">
                                        </a>
                                        <a data-social="reddit" class="mr-5 d-inline-block d-middle" href="#"><img
                                                alt="joblist"
                                                src="{{ asset('frontend/assets/imgs/template/icons/share-red.svg') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="single-apply-jobs mt-20">
                                <div class="row">
                                    <div class="col-lg-7"><a class="btn btn-border-3 mr-10 hover-up" href="#">#
                                            Nature</a><a class="btn btn-border-3 mr-10 hover-up" href="#">#
                                            Beauty</a><a class="btn btn-border-3 hover-up" href="#"># Travel tips</a>
                                    </div>
                                </div>
                            </div>
                            <h3>Comments</h3>
                            <ul class="list-comments">
                                <li>
                                    <div class="author-bio mt-40 bg-white">
                                        <div class="author-image mb-15"><a href="author.html"><img class="avatar"
                                                    src="../../../public/frontend/assets/imgs/page/candidates/user2.png"
                                                    alt=""></a>
                                            <div class="author-infor">
                                                <h6 class="mt-0 mb-0">Robert Fox</h6>
                                                <p class="mb-0 color-text-paragraph-2 font-sm">August 25, 2022</p>
                                            </div>
                                        </div>
                                        <div class="author-des">
                                            <p class="font-md color-text-paragraph">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit.
                                                Sed ultricies interdum massa nec fermentum. Phasellus interdum dignissim
                                                rhoncus. Nam vitae
                                                semper magna. Donec massa enim</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="author-bio mt-40 bg-white">
                                        <div class="author-image mb-15"><a href="author.html"><img class="avatar"
                                                    src="../../../public/frontend/assets/imgs/page/candidates/user1.png"
                                                    alt=""></a>
                                            <div class="author-infor">
                                                <h6 class="mt-0 mb-0">Jenny Wilson</h6>
                                                <p class="mb-0 color-text-paragraph-2 font-sm">August 25, 2022</p>
                                            </div>
                                        </div>
                                        <div class="author-des">
                                            <p class="font-md color-text-paragraph">White white dreamy drama tically place
                                                everything
                                                although. Place out apartment afternoon whimsical kinder, little romantic
                                                joy we flowers
                                                handmade. Nullam vestibulum semper ultrices.</p>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="author-bio mt-40 bg-white">
                                                <div class="author-image mb-15"><a href="author.html"><img class="avatar"
                                                            src="../../../public/frontend/assets/imgs/page/candidates/user3.png"
                                                            alt=""></a>
                                                    <div class="author-infor">
                                                        <h6 class="mt-0 mb-0">Eleanor Pena</h6>
                                                        <p class="mb-0 color-text-paragraph-2 font-sm">August 25, 2022</p>
                                                    </div>
                                                </div>
                                                <div class="author-des">
                                                    <p class="font-md color-text-paragraph">White white dreamy drama tically
                                                        place everything
                                                        although. Place out apartment afternoon whimsical kinder, little
                                                        romantic joy we flowers
                                                        handmade. Nullam vestibulum semper ultrices.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="border-bottom mt-50 mb-50"></div>
                            <div class="mt-30 mb-80">
                                <h3>Leave a comment</h3>
                                <div class="form-comment">
                                    <form action="#">
                                        <div class="form-group">
                                            <textarea class="input-comment" placeholder="Write a comment"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-7 mb-30">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-5 text-end">
                                                <button class="btn btn-default font-bold">Post comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
