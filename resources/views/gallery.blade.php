<x-layouts.public>
    <!-- 3D Rotating Gallery CSS -->
    <style>
        .animated-3d-gallery-sec {
            padding-top: 80px;
            padding-bottom: 8px;
        }

        .gallery-title {
            text-align: center;
            margin-bottom: 0px;
        }

        .gallery-title h1 {
            font-size: 48px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        .anim-3d-gallery-wrapper {
            width: 100%;
            height: 100vh;
        
            overflow: hidden;
            position: relative;
        }

        .anim-3d-gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .anim-3d-gallery-wrap {
            position: absolute;
            transform-style: preserve-3d;
            aspect-ratio: 3 / 4;
            width: 100%;
            max-width: 12%;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%) perspective(22vw) scale(2) rotateY(0);
            animation: rotation3dcardZoom 60s linear infinite;
        }

        @keyframes rotation3dcardZoom{
            0%{
                transform: translate(-50%,-50%) perspective(22vw) scale(2) rotateY(0);
            }
            100%{
                transform: translate(-50%,-50%) perspective(22vw) scale(2) rotateY(360deg);
            }
        }

        .anim-3d-gallery-card {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: rotateY(calc((var(--position) - 1)*(360/var(--qty)) * 1deg)) translateZ(23vw);
        }

        @media (max-width: 768px) {
            .gallery-title h1 {
                font-size: 36px;
            }

            .anim-3d-gallery-wrapper {
                height: 100vh;
            }

            .anim-3d-gallery-wrap {
                transform: translate(-50%,-50%) perspective(30vw) scale(1.5) rotateY(0);
                animation: rotation3dcardZoomMobile 60s linear infinite;
            }
            
            @keyframes rotation3dcardZoomMobile{
                0%{
                    transform: translate(-50%,-50%) perspective(30vw) scale(1.5) rotateY(0);
                }
                100%{
                    transform: translate(-50%,-50%) perspective(30vw) scale(1.5) rotateY(360deg);
                }
            }
            
            .anim-3d-gallery-card {
                transform: rotateY(calc((var(--position) - 1)*(360/var(--qty)) * 1deg)) translateZ(30vw);
            }
        }
    </style>

    <section class="animated-3d-gallery-sec relative">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/hero.avif'); z-index: 0;"></div>
        <div class="backdrop-blur-md h-full w-full">
            <div class="anim-3d-gallery-wrapper">
                  <div class="gallery-title">
                <h1>Hit the Ground Memories</h1>
            </div>
                @php
                    $galleryPath = public_path('storage/gallery');
                    $images = [];

                    if (is_dir($galleryPath)) {
                        $files = glob($galleryPath . '/*.avif');
                        sort($files, SORT_NATURAL);
                        $images = array_map(function($file) {
                            return basename($file);
                        }, $files);
                    }

                    $imageCount = count($images);
                @endphp

                <div class="anim-3d-gallery-wrap" style="--qty: {{ $imageCount }}">
                    @foreach($images as $index => $image)
                        <div class="anim-3d-gallery-card" style="--position: {{ $index + 1 }}">
                            <img src="{{ asset('storage/gallery/' . $image) }}" alt="Gallery Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/CustomEase.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js'></script>
    <script>
        gsap.registerPlugin(CustomEase);
    </script>

</x-layouts.public>
