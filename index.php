<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azrina - Construction Excellence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #333333;
            overflow-x: hidden;
        }
        .header {
            transition: background-color 0.3s ease;
        }
        .header.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .portfolio-item {
            transition: all 0.3s ease;
        }
        .portfolio-filter.active {
            background-color: #FF8C00;
            color: white;
        }
        .typing-text::after {
            content: '|';
            animation: blink 0.7s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="header fixed w-full z-50 py-4 px-6 lg:px-16">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                    <img src="/assets/img/azrina_logo.png" alt="Azrina Logo" class="w-full h-full">     
                </svg>
                <h1 class="ml-2 text-xl font-bold">Azrina</h1>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-8">
                    <li><a href="#home" class="nav-link px-3 py-2 hover:text-orange-600 transition">Home</a></li>
                    <li><a href="#about" class="nav-link px-3 py-2 hover:text-orange-600 transition">About</a></li>
                    <li><a href="#services" class="nav-link px-3 py-2 hover:text-orange-600 transition">Services</a></li>
                    <li><a href="#portfolio" class="nav-link px-3 py-2 hover:text-orange-600 transition">Portfolio</a></li>
                    <li><a href="#contact" class="nav-link px-3 py-2 hover:text-orange-600 transition">Contact</a></li>
                    <li><a href="auth/login.php" class="nav-link px-3 py-2 hover:text-orange-600 transition">Login</a></li>
                </ul>
            </nav>
            <button class="md:hidden text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero min-h-screen flex items-center justify-center text-white pt-20">
        <div class="container mx-auto px-6 lg:px-16 text-center scroll-reveal">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <span class="typing-text">Building Your Future, One Block at a Time</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">Premium construction services with unparalleled craftsmanship and attention to detail.</p>
            <a href="#contact" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-8 rounded-lg inline-block transition duration-300">Get In Touch</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-20 px-6 lg:px-16 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 scroll-reveal">About <span class="text-orange-600">Azrina</span></h2>
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2 scroll-reveal">
                    <h3 class="text-2xl font-semibold mb-4">Our Company</h3>
                    <p class="mb-6 text-gray-700 leading-relaxed">Founded in 2010, Azrina Construction has established itself as a leader in the construction industry. With over a decade of experience, we deliver exceptional quality in every project, blending traditional craftsmanship with modern technology.</p>
                    <p class="text-gray-700 leading-relaxed">Our team of skilled professionals is dedicated to transforming your vision into reality, while maintaining the highest standards of safety, efficiency, and sustainability in every project we undertake.</p>
                </div>
                <div class="lg:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md mb-8 scroll-reveal" style="transition-delay: 0.2s;">
                        <div class="flex items-center mb-4">
                            <div class="bg-orange-100 p-3 rounded-full mr-4">
                                <i class="fas fa-eye text-orange-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold">Our Vision</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">To redefine the construction experience through innovation, integrity, and excellence, becoming the most trusted name in the industry.</p>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-md scroll-reveal" style="transition-delay: 0.4s;">
                        <div class="flex items-center mb-4">
                            <div class="bg-orange-100 p-3 rounded-full mr-4">
                                <i class="fas fa-bullseye text-orange-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold">Our Mission</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">To deliver superior construction services that exceed client expectations through quality craftsmanship, transparent communication, and sustainable practices that stand the test of time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-6 lg:px-16">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 scroll-reveal">Our <span class="text-orange-600">Services</span></h2>
            <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto scroll-reveal">Comprehensive solutions tailored to meet your construction needs with precision and excellence.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white rounded-lg shadow-md p-8 hover:shadow-xl transition duration-300 scroll-reveal">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-home text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">General Construction</h3>
                    <p class="text-gray-700 text-center">From foundations to finish work, we handle all aspects of construction with precision and attention to detail, ensuring structural integrity and aesthetic appeal.</p>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card bg-white rounded-lg shadow-md p-8 hover:shadow-xl transition duration-300 scroll-reveal" style="transition-delay: 0.2s;">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-hammer text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Renovation</h3>
                    <p class="text-gray-700 text-center">Breathing new life into existing spaces with innovative design solutions and quality workmanship that honors the original structure while adding modern functionality.</p>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card bg-white rounded-lg shadow-md p-8 hover:shadow-xl transition duration-300 scroll-reveal" style="transition-delay: 0.4s;">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-paint-roller text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Interior Design</h3>
                    <p class="text-gray-700 text-center">Creating functional and beautiful interior spaces that reflect your personal style while optimizing for comfort, flow, and practical living.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 px-6 lg:px-16 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 scroll-reveal">Our <span class="text-orange-600">Portfolio</span></h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto scroll-reveal">A showcase of our completed projects that demonstrate our expertise and quality craftsmanship.</p>
            
            <div class="flex justify-center mb-12 scroll-reveal">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" class="portfolio-filter active px-4 py-2 text-sm font-medium rounded-l-lg border border-gray-200 hover:bg-gray-50" data-filter="all">
                        All Projects
                    </button>
                    <button type="button" class="portfolio-filter px-4 py-2 text-sm font-medium border-t border-b border-gray-200 hover:bg-gray-50" data-filter="residential">
                        Residential
                    </button>
                    <button type="button" class="portfolio-filter px-4 py-2 text-sm font-medium rounded-r-md border border-gray-200 hover:bg-gray-50" data-filter="commercial">
                        Commercial
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Project 1 -->
                <div class="portfolio-item residential scroll-reveal">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Modern Residence Project" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Modern Residence</h3>
                            <p class="text-gray-300">Residential</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="portfolio-item commercial scroll-reveal" style="transition-delay: 0.1s;">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1486406149866-6264efc7e1fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Office Complex Project" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Office Complex</h3>
                            <p class="text-gray-300">Commercial</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="portfolio-item residential scroll-reveal" style="transition-delay: 0.2s;">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Luxury Villa Project" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Luxury Villa</h3>
                            <p class="text-gray-300">Residential</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project 4 -->
                <div class="portfolio-item commercial scroll-reveal" style="transition-delay: 0.3s;">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Retail Center Project" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Retail Center</h3>
                            <p class="text-gray-300">Commercial</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project 5 -->
                <div class="portfolio-item residential scroll-reveal" style="transition-delay: 0.4s;">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Townhouse Development" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Townhouse Development</h3>
                            <p class="text-gray-300">Residential</p>
                        </div>
                    </div>
                </div>
                
                <!-- Project 6 -->
                <div class="portfolio-item commercial scroll-reveal" style="transition-delay: 0.5s;">
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Hospitality Complex" class="w-full h-64 object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-white text-xl font-semibold">Hospitality Complex</h3>
                            <p class="text-gray-300">Commercial</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 px-6 lg:px-16">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 scroll-reveal">Client <span class="text-orange-600">Testimonials</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md scroll-reveal">
                    <div class="flex items-center mb-4">
                        <div class="text-orange-600 text-2xl mr-2">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="text-gray-700 italic">"Azrina Construction transformed our outdated home into a modern masterpiece. Their attention to detail and commitment to quality is unmatched."</p>
                    </div>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Sarah Johnson</h4>
                            <p class="text-gray-600 text-sm">Homeowner, Brooklyn</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md scroll-reveal" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <div class="text-orange-600 text-2xl mr-2">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="text-gray-700 italic">"The commercial building Azrina constructed for us was completed on time and under budget. Their team was professional and delivered exceptional results."</p>
                    </div>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="Michael Chen" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Michael Chen</h4>
                            <p class="text-gray-600 text-sm">CEO, TechStart Inc.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md scroll-reveal" style="transition-delay: 0.4s;">
                    <div class="flex items-center mb-4">
                        <div class="text-orange-600 text-2xl mr-2">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="text-gray-700 italic">"Working with Azrina was a pleasure from start to finish. They listened to our needs and delivered a home that perfectly fits our family's lifestyle."</p>
                    </div>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lisa Rodriguez" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">Lisa Rodriguez</h4>
                            <p class="text-gray-600 text-sm">Homeowner, Queens</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 lg:px-16 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 scroll-reveal">Get In <span class="text-orange-600">Touch</span></h2>
            <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto scroll-reveal">Reach out to discuss your next project or inquire about our services.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Info 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center scroll-reveal">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-map-marker-alt text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Address</h3>
                    <p class="text-gray-700">123 Construction Avenue<br>New York, NY 10001</p>
                </div>
                
                <!-- Contact Info 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center scroll-reveal" style="transition-delay: 0.2s;">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-envelope text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                    <p class="text-gray-700">info@azrinaconstruction.com<br>projects@azrinaconstruction.com</p>
                </div>
                
                <!-- Contact Info 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center scroll-reveal" style="transition-delay: 0.4s;">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-phone-alt text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                    <p class="text-gray-700">+1 (555) 123-4567<br>+1 (555) 765-4321</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-6 bg-gray-900 text-white">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <svg class="w-8 h-8 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    <h1 class="ml-2 text-xl font-bold">Azrina Construction</h1>
                </div>
                <div class="text-center md:text-right">
                    <p>© 2025 Azrina Construction. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Typing animation
        const typingText = document.querySelector('.typing-text');
        const phrases = [
            "Building Your Future, One Block at a Time",
            "Quality Construction You Can Trust",
            "Transforming Visions into Reality"
        ];
        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function type() {
            const currentPhrase = phrases[phraseIndex];
            
            if (!isDeleting && charIndex <= currentPhrase.length) {
                typingText.textContent = currentPhrase.substring(0, charIndex);
                charIndex++;
                setTimeout(type, 100);
            } else if (isDeleting && charIndex >= 0) {
                typingText.textContent = currentPhrase.substring(0, charIndex);
                charIndex--;
                setTimeout(type, 50);
            } else {
                isDeleting = !isDeleting;
                if (!isDeleting) {
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                }
                setTimeout(type, 1000);
            }
        }
        
        // Header scroll effect
        const header = document.querySelector('.header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.md\\:hidden');
        mobileMenuBtn.addEventListener('click', () => {
            const nav = document.querySelector('nav');
            nav.classList.toggle('hidden');
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Portfolio filtering
        const filterBtns = document.querySelectorAll('.portfolio-filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');
                
                const filter = btn.dataset.filter;
                
                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.classList.contains(filter)) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Scroll reveal animation
        function checkScroll() {
            const scrollReveals = document.querySelectorAll('.scroll-reveal');
            
            scrollReveals.forEach(reveal => {
                const revealTop = reveal.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (revealTop < windowHeight - 100) {
                    reveal.classList.add('active');
                }
            });
        }
        
        window.addEventListener('scroll', checkScroll);
        window.addEventListener('load', checkScroll);
        
        // Initialize typing effect
        window.onload = function() {
            setTimeout(type, 1000);
            checkScroll();
        };
    </script>
</body>
</html>