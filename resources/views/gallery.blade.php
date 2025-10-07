<x-layouts.public>
    <!-- 3D Rotating Gallery CSS -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        :root {
            --head-font: "Teko";
            --body-font: "Poppins";
            --white: #ffffff;
            --white04: rgba(255, 255, 255, 0.04);
            --black: #000000;
            --hover: darkorange;
            --yellow: #eaf259;
            --gold: #ecbd22;
            --blue: #2faee8;
            --green: #23fa7d;
            --pink: #f629cb;
            --purple: #b520ff;
        }

        .animated-3d-gallery-sec {
            background-color: #1b1b1b;
            padding-top: 80px;
            padding-bottom: 8px;
        }

        .gallery-title {
            text-align: center;
            margin-bottom: 0px;
        }

        .gallery-title h1 {
            font-family: var(--head-font);
            font-size: 48px;
            color: #fff;
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

    <section class="animated-3d-gallery-sec">
        <div class="">
          
            
            <div class="anim-3d-gallery-wrapper">
                  <div class="gallery-title">
                <h1>Hit the Ground Memories</h1>
            </div>
                <div class="anim-3d-gallery-wrap" style="--qty: 12">
                    <div class="anim-3d-gallery-card" style="--position: 1">
                        <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Match">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 2">
                        <img src="https://plus.unsplash.com/premium_photo-1685056533706-5af828d13dc3?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Action">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 3">
                        <img src="https://images.unsplash.com/photo-1570498839593-e565b39455fc?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Stadium">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 4">
                        <img src="https://images.unsplash.com/photo-1543351611-58f69d7c1781?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Team">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 5">
                        <img src="https://images.unsplash.com/photo-1560272564-c83b66b1ad12?q=80&w=749&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Victory">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 6">
                        <img src="https://images.unsplash.com/photo-1603291697926-7e5822ed1ac5?q=80&w=688&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Celebration">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 7">
                        <img src="https://plus.unsplash.com/premium_photo-1684888759266-ce3768052c80?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Tournament">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 8">
                        <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?q=80&w=686&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Championship">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 9">
                        <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Ground">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 10">
                        <img src="https://images.unsplash.com/photo-1552318965-6e6be7484ada?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Players">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 11">
                        <img src="https://plus.unsplash.com/premium_photo-1685231505268-c8f27c4e8870?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Memories">
                    </div>
                    <div class="anim-3d-gallery-card" style="--position: 12">
                        <img src="https://images.unsplash.com/photo-1516567727245-ad8c68f3ec93?q=80&w=749&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cricket Awards">
                    </div>
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
