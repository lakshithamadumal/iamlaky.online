<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Me - Lakshitha Madumal</title>
        <!--favicon icon-->
        <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
        <!-- 🧠 Description for Google/SEO -->
        <meta name="description" content="Get in touch with Laky – Software Engineer, Web Developer & AI Enthusiast. Let’s collaborate on projects, ideas, and innovations.">
        <!-- 🪪 Author -->
        <meta name="author" content="Lakshitha Madumal">
        <!-- 🔗 Social Media (Open Graph for link previews) -->
        <meta property="og:title" content="Contact Laky | Let's Connect">
        <meta property="og:description" content="Reach out to me for collaborations, projects, or just to say hi! I’m always open to creative ideas and opportunities.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://www.iamlaky.online/contact-me.php">
        <meta property="og:image" content="https://iamlaky.online/assets/favicon.png">

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/cursor-contact.css">
        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <!-- React Lenis for smooth scrolling -->
        <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/bundled/lenis.min.js"></script>
        <style>
      body {
        font-family: "Poppins", sans-serif;
        overflow: hidden;
      }
      * {
        scrollbar-width: none;
        -ms-overflow-style: none;
      }

      *::-webkit-scrollbar {
        display: none;
      }
        </style>
    </head>
    <body class="bg-[#c6fca6] page-transition">
        <!-- cursor-->
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
        <!-- Scroll Progress Indicator -->
        <div class="scroll-progress" id="scrollProgress"></div>
        <section class="h-screen flex flex-col min-h-[80vh] relative">
            <!-- Header / Back Button -->
            <div class="py-20 px-10 flex-col flex min-h-[60vh] justify-center">
                <div class="flex flex-col">
                    <!-- Back Button -->
                    <div class="slide-in-left">
                        <a href="index.php" class="inline-flex items-center gap-2 transition-all duration-300 border-black h-10 rounded-[10px] border-2 border-opacity-0 text-black bg-black/10 px-4 hover:bg-black hover:text-white btn-animate hover-lift">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            Home
                        </a>
                    </div>
                    <!-- Main Title -->
                    <h1 class="text-[3em] md:text-[6em] font-semibold text-[#1e1e1e] text-center md:text-start mt-6 fade-in-section gradient-text">
                        Let's Talk
                    </h1>
                    <!-- Subtitle -->
                    <h4 class="text-[1.5em] md:text-[2em] font-medium text-[#1e1e1e] mt-[1em] text-center md:text-start slide-in-right">
                        Connect with me to build tailor-made solutions.
                    </h4>
                </div>
            </div>
            <!-- Contact Links -->
            <div class="py-20 px-10">
                <div class="flex flex-col items-center md:items-start">
                    <div class="flex gap-10 mt-[1em] stagger-animation">
                        <!-- Email -->
                        <a href="mailto:mandujayaweera2003@gmail.com" target="_blank" class="flex gap-2 items-center btn-animate hover-lift">
                            <span class="text-[16px] font-bold">Email</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/in/lakshitha-madumal/" target="_blank" class="flex gap-2 items-center btn-animate hover-lift">
                            <span class="text-[16px] font-bold">LinkedIn</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>
                        <!-- GitHub -->
                        <a href="https://github.com/lakshithamadumal" target="_blank" class="flex gap-2 items-center btn-animate hover-lift">
                            <span class="text-[16px] font-bold">GitHub</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <script>
      lucide.createIcons();
        </script>
        <!-- React Lenis Smooth Scrolling -->
        <script>
      // Initialize Lenis for smooth scrolling
      const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: "vertical",
        gestureDirection: "vertical",
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
      });

      function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
      }

      requestAnimationFrame(raf);

      // Scroll progress indicator
      const scrollProgress = document.getElementById("scrollProgress");

      window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.offsetHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        scrollProgress.style.width = scrollPercent + "%";
      });

      // View Transitions API support
      if (document.startViewTransition) {
        // Handle navigation with View Transitions API
        document.addEventListener("click", (e) => {
          const link = e.target.closest("a");
          if (
            link &&
            link.href &&
            link.href.startsWith(window.location.origin)
          ) {
            e.preventDefault();

            document.startViewTransition(() => {
              window.location.href = link.href;
            });
          }
        });
      }
        </script>
        <!-- Advanced Animations and Interactions -->
        <script src="assets/js/animations.js"></script>
        <script src="assets/js/cursor.js"></script>
    </body>
</html>
