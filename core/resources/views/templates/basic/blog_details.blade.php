@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-detials pb-60">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-xl-9 col-lg-8">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', @$blog->data_values->image, '1000x500') }}" class="fit-image"
                                alt="image">
                        </div>
                        <div class="blog-details__content">
                            <span class="blog-item__date mb-2"><span class="blog-item__date-icon"><i
                                        class="las la-clock"></i></span> {{ showDateTime($blog->created_at, 'd M Y') }}</span>
                            <h3 class="blog-details__title">{{ __($blog->data_values->title) }}</h3>
                            <p class="blog-details__desc">@php echo @$blog->data_values->description @endphp</p>

                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <li class="social-list__item"><a
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="social-list__item"><a
                                            href="https://twitter.com/intent/tweet?text= {{ __(strLimit($blog->data_values->title, 150)) }}&amp;url={{ urlencode(url()->current()) }}"
                                            class="social-list__link flex-center"> <i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="social-list__item"><a
                                            href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __(strLimit($blog->data_values->title, 150)) }}&amp;summary={{ __(strLimit(strip_tags(@$blog->data_values->description_nic), 300)) }}"
                                            class="social-list__link flex-center"> <i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li class="social-list__item"><a
                                            href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __(@$blog->data_values->title) }}&media={{ frontendImage('blog', $blog->data_values->image, '1000x500') }}"
                                            class="social-list__link flex-center"> <i class="fab fa-pinterest"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title"> @lang('Latest Blog') </h5>
                            @foreach ($latestBlogs as $latestBlog)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('blog.details', $latestBlog->slug) }}"> <img
                                                src="{{ frontendImage('blog', @$latestBlog->data_values->image, '500x250', thumb:true) }}" class="fit-image" alt="image"></a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title"><a href="{{ route('blog.details', $latestBlog->slug) }}">{{ __(@$latestBlog->data_values->title) }}</a></h6>
                                        <span class="latest-blog__date fs-13">{{ showDateTime($latestBlog->created_at, 'd M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- ============================= Blog Details Sidebar End ======================== -->
                </div>
            </div>
        </div>
    </section>
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
