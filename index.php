<?php
// Activar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir config.php (config.php ya define BASE_PATH y las constantes)
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    // Solo definir constantes si no existe config.php
    define('APP_NAME', 'Mi Landing Page');
    if (!defined('BASE_PATH')) {
        define('BASE_PATH', __DIR__);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="Landing page profesional con diseño moderno y responsive">
    <meta name="keywords" content="landing page, diseño web, responsive">
    <meta name="author" content="Cusco Tours Barato">
    
    <title><?php echo APP_NAME; ?> - Aventuras en Perú</title>
    
    <!-- CSS - Estilos independientes por sección -->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/hero.css">
    <link rel="stylesheet" href="assets/css/prueba-social.css">
    <link rel="stylesheet" href="assets/css/tour.css">
    <link rel="stylesheet" href="assets/css/galeria.css">
    <link rel="stylesheet" href="assets/css/beneficios.css">
    <link rel="stylesheet" href="assets/css/urgencias.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/cta.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    
    <style>
        /* Reset básico para evitar conflictos entre secciones */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #ffffff;
        }
        
        /* Variables globales para consistencia */
        :root {
            --primary-color: #00e5b5;
            --primary-dark: #00c4a0;
            --primary-light: #4db8ff;
            --secondary-color: #00b4d8;
            --white: #ffffff;
            --dark-color: #1a1a1a;
            --text-color: #2c3e50;
            --text-light: #6c757d;
            --gray-bg: #f8f9fa;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Estilos para botones globales (por si acaso) */
        .btn-green {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.8rem;
            background: linear-gradient(135deg, #00e5b5, #00c4a0);
            border: none;
            border-radius: 50px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-green:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 229, 181, 0.3);
        }
        
        .btn-outline-green {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.7rem;
            background: transparent;
            border: 2px solid #00e5b5;
            border-radius: 50px;
            color: #00e5b5;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-outline-green:hover {
            background: #00e5b5;
            color: #1a1a1a;
            transform: translateY(-2px);
        }
        
        /* Utilidades */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .mt-2 {
            margin-top: 0.5rem;
        }
        
        .mt-3 {
            margin-top: 1rem;
        }
        
        .mb-2 {
            margin-bottom: 0.5rem;
        }
        
        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
 <!-- ============================================
     HEADER - NAVEGACIÓN SIMPLE
     ============================================ -->
<header class="header">
    <div class="header-container">
        
        <!-- Logo -->
        <a href="#home" class="header-logo">
            <i class="fas fa-mountain"></i>
            <span>MachuPicchu<span class="logo-highlight">Tours</span></span>
        </a>
        
        <!-- Menú Desktop -->
        <nav class="header-nav">
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link active">Inicio</a></li>
                <li><a href="#tour" class="nav-link">El Tour</a></li>
                <li><a href="#galeria" class="nav-link">Galería</a></li>
                <li><a href="#beneficios" class="nav-link">Beneficios</a></li>
                <li><a href="#faq" class="nav-link">FAQ</a></li>
            </ul>
        </nav>
        
        <!-- Botón CTA en header -->
        <button class="header-cta" onclick="openReservaModal()">
            <i class="fas fa-calendar-check"></i> Reservar Ahora
        </button>
        
        <!-- Botón hamburguesa (Mobile) -->
        <button class="header-mobile-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        
    </div>
    
    <!-- Menú Mobile (oculto por defecto) -->
    <div class="header-mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <i class="fas fa-mountain"></i>
            <span>Menú</span>
            <button class="mobile-menu-close" id="closeMobileMenu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="mobile-nav-menu">
            <li><a href="#home" class="mobile-nav-link">Inicio</a></li>
            <li><a href="#tour" class="mobile-nav-link">El Tour</a></li>
            <li><a href="#galeria" class="mobile-nav-link">Galería</a></li>
            <li><a href="#beneficios" class="mobile-nav-link">Beneficios</a></li>
            <li><a href="#faq" class="mobile-nav-link">FAQ</a></li>
        </ul>
        <button class="mobile-cta" onclick="openReservaModal()">
            <i class="fas fa-calendar-check"></i> Reservar Ahora
        </button>
    </div>
</header>

<main>
    <!-- Hero Section - Enfoque Conversión -->
    <section id="home" class="hero">
        <!-- Video de fondo -->
        <video autoplay muted loop playsinline class="hero-video" poster="assets/galeria/logo.png">
            <source src="assets/galeria/animacion_cusco.mp4" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
        
        <div class="container">
            <div class="hero-content">
                
                <!-- Título emocional + claro -->
                <h1 class="hero-title">
                    Descubre <span class="highlight">Machu Picchu</span><br>
                    en 1 día sin complicaciones
                </h1>
                
                <!-- Subtítulo con beneficio concreto -->
                <p class="hero-subtitle">
                    Transporte + guía bilingüe + entradas incluidas. <br>
                    Sin filas, sin estrés, solo disfruta.
                </p>
                
                <!-- ⭐ DATOS RÁPIDOS - Lo más importante ⭐ -->
                <div class="hero-quick-stats">
                    <div class="quick-stat">
                        <span class="stat-icon">⏱️</span>
                        <div class="stat-info">
                            <span class="stat-label">Duración</span>
                            <strong class="stat-value">12 horas</strong>
                        </div>
                    </div>
                    
                    <div class="quick-stat">
                        <span class="stat-icon">💰</span>
                        <div class="stat-info">
                            <span class="stat-label">Precio desde</span>
                            <strong class="stat-value">$89 USD</strong>
                        </div>
                    </div>
                    
                    <div class="quick-stat">
                        <span class="stat-icon">🥾</span>
                        <div class="stat-info">
                            <span class="stat-label">Nivel</span>
                            <strong class="stat-value">Moderado</strong>
                            <span class="stat-hint">(apto principiantes)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Botón CTA principal (el más importante) -->
                <div class="hero-buttons">
                    <a href="javascript:void(0);" class="btn-primary" onclick="openReservaModal()">
                        📅 Reservar ahora
                        <span class="btn-small"> | Cupos limitados</span>
                    </a>
                    <a href="#tour" class="btn-secondary">
                        Ver disponibilidad
                    </a>
                </div>
                
                <!-- Micro-texto de confianza (opcional pero efectivo) -->
                <div class="hero-trust">
                    <span>✨ 4.9/5 (2,500+ reseñas)</span>
                    <span>🎫 Cancelación gratis 24h</span>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ============================================
        SECCIÓN: PRUEBA SOCIAL (CONFIANZA RÁPIDA)
        ============================================ -->
    <section id="social-proof" class="social-proof">
        <div class="container">
            
            <!-- Encabezado directo al punto -->
            <div class="proof-header">
                <span class="proof-badge">✨ Confianza que respalda</span>
                <h2>Únete a <span class="highlight">2,500+ viajeros</span> que ya vivieron esta experiencia</h2>
            </div>
            
            <!-- ⭐ CALIFICACIÓN GENERAL ⭐ -->
            <div class="rating-card">
                <div class="rating-stars">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="rating-number">4.9</span>
                    <span class="rating-total">/ 5</span>
                </div>
                <div class="rating-details">
                    <div class="rating-platform">
                        <i class="fas fa-trophy"></i>
                        <span>4.8 · 1,200 reseñas</span>
                    </div>
                    <div class="rating-platform">
                        <i class="fas fa-star-of-life"></i>
                        <span>4.9 · 850 reseñas</span>
                    </div>
                    <div class="rating-platform">
                        <i class="fas fa-thumbs-up"></i>
                        <span>4.9 · 500 reseñas</span>
                    </div>
                </div>
            </div>
            
            <!-- 📸 RESEÑAS DESTACADAS -->
            <div class="reviews-grid">
                
                <!-- Review 1 -->
                <div class="review-card">
                    <div class="review-user">
                        <div class="user-avatar user-avatar-1">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-info">
                            <h4>María González</h4>
                            <div class="review-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-platform verified">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <p class="review-text">
                        "Increíble experiencia! Todo perfectamente organizado. El guía sabía muchísimo de la historia inca. 
                        ¡Machu Picchu es impresionante!"
                    </p>
                    <div class="review-footer">
                        <span class="review-date"><i class="far fa-calendar-alt"></i> Hace 3 días</span>
                        <span class="review-location"><i class="fas fa-map-marker-alt"></i> Machu Picchu</span>
                    </div>
                </div>
                
                <!-- Review 2 -->
                <div class="review-card">
                    <div class="review-user">
                        <div class="user-avatar user-avatar-2">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-info">
                            <h4>Carlos Rodríguez</h4>
                            <div class="review-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-platform verified">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <p class="review-text">
                        "Super recomendado! El transporte cómodo, puntuales en todo. La comida del almuerzo espectacular. 
                        Volvería sin dudarlo."
                    </p>
                    <div class="review-footer">
                        <span class="review-date"><i class="far fa-calendar-alt"></i> Hace 1 semana</span>
                        <span class="review-location"><i class="fas fa-map-marker-alt"></i> Valle Sagrado</span>
                    </div>
                </div>
                
                <!-- Review 3 -->
                <div class="review-card">
                    <div class="review-user">
                        <div class="user-avatar user-avatar-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-info">
                            <h4>Laura Fernández</h4>
                            <div class="review-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-platform verified">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <p class="review-text">
                        "Excelente servicio desde la reserva hasta el final. El guía hablaba perfecto inglés y español. 
                        ¡Una experiencia mágica!"
                    </p>
                    <div class="review-footer">
                        <span class="review-date"><i class="far fa-calendar-alt"></i> Hace 5 días</span>
                        <span class="review-location"><i class="fas fa-map-marker-alt"></i> Machu Picchu</span>
                    </div>
                </div>
            </div>
            
            <!-- 📊 ESTADÍSTICAS RÁPIDAS (Para agencia de viajes) -->
            <div class="trust-stats">
                <div class="trust-stat">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Años de experiencia</div>
                </div>
                <div class="trust-stat">
                    <div class="stat-icon"><i class="fas fa-smile"></i></div>
                    <div class="stat-number">2,500+</div>
                    <div class="stat-label">Viajeros felices</div>
                </div>
                <div class="trust-stat">
                    <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Recomiendan</div>
                </div>
                <div class="trust-stat">
                    <div class="stat-icon"><i class="fas fa-headset"></i></div>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Soporte en español</div>
                </div>
            </div>
            
            <!-- 🏆 CERTIFICACIONES para Agencia de Viajes -->
            <div class="certifications">
                <div class="cert-item">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <strong>Seguro incluido</strong>
                        <span>Asistencia al viajero</span>
                    </div>
                </div>
                <div class="cert-item">
                    <i class="fas fa-ticket-alt"></i>
                    <div>
                        <strong>Entradas garantizadas</strong>
                        <span>Sin filas ni esperas</span>
                    </div>
                </div>
                <div class="cert-item">
                    <i class="fas fa-bus"></i>
                    <div>
                        <strong>Transporte VIP</strong>
                        <span>Buses modernos</span>
                    </div>
                </div>
                <div class="cert-item">
                    <i class="fas fa-language"></i>
                    <div>
                        <strong>Guías bilingües</strong>
                        <span>Español/Inglés</span>
                    </div>
                </div>
                <div class="cert-item">
                    <i class="fas fa-credit-card"></i>
                    <div>
                        <strong>Pago seguro</strong>
                        <span>Tarjetas y PayPal</span>
                    </div>
                </div>
                <div class="cert-item">
                    <i class="fas fa-undo-alt"></i>
                    <div>
                        <strong>Cancelación gratis</strong>
                        <span>Hasta 24h antes</span>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action sutil -->
            <div class="proof-cta">
                <p><i class="fas fa-star"></i> <strong>2,500+ viajeros</strong> ya confían en nosotros</p>
                <a href="#tour" class="btn-outline">Ver disponibilidad <i class="fas fa-arrow-right"></i></a>
            </div>
            
        </div>
    </section>

    <!-- ============================================
        SECCIÓN: DESCRIPCIÓN DEL TOUR CON SIDEBAR
        ============================================ -->
    <section id="tour" class="tour-section">
        <div class="container">
            
            <!-- Encabezado simple -->
            <div class="section-header">
                <span class="section-subtitle">LA EXPERIENCIA</span>
                <h2>¿Qué vas a <span class="highlight">vivir?</span></h2>
                <p>Conoce en detalle cada aspecto de tu aventura en Machu Picchu</p>
            </div>

            <!-- GRID PRINCIPAL: CONTENIDO IZQUIERDO + SIDEBAR DERECHO -->
            <div class="tour-wrapper">
                
                <!-- COLUMNA IZQUIERDA - Contenido del Tour -->
                <div class="tour-main">
                    
                    <!-- Qué vas a hacer -->
                    <div class="experience-card">
                        <h3><i class="fas fa-eye"></i> ¿Qué vas a hacer?</h3>
                        <p>Este tour está diseñado para viajeros que buscan vivir la magia del Valle Sagrado y Machu Picchu sin complicaciones. Disfrutarás de paisajes impresionantes, aprenderás de nuestra historia y te llevarás recuerdos inolvidables.</p>
                        
                        <div class="highlights">
                            <div class="highlight-item">
                                <i class="fas fa-mountain"></i>
                                <span>Vistas panorámicas del Valle Sagrado</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-history"></i>
                                <span>Guía experto en historia Inca</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-camera"></i>
                                <span>Fotos en los mejores miradores</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-clock"></i>
                                <span>Horarios estratégicos sin multitudes</span>
                            </div>
                        </div>
                    </div>

                    <!-- Qué Incluye -->
                    <div class="includes-card">
                        <div class="card-header green">
                            <i class="fas fa-check-circle"></i>
                            <h3>Qué Incluye</h3>
                        </div>
                        <ul class="includes-list">
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Transporte</strong>
                                    <span>Ida y vuelta desde tu hotel en Cusco</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Guía profesional</strong>
                                    <span>Bilingüe (español/inglés) - Certificado</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Entradas turísticas</strong>
                                    <span>Machu Picchu + circuito completo</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Comidas</strong>
                                    <span>1 desayuno + 1 almuerzo en restaurante local</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Agua de por vida</strong>
                                    <span>Botella de agua reutilizable</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <div>
                                    <strong>Asistencia 24/7</strong>
                                    <span>Soporte en español durante todo el tour</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Qué NO Incluye -->
                    <div class="excludes-card">
                        <div class="card-header red">
                            <i class="fas fa-times-circle"></i>
                            <h3>Qué No Incluye</h3>
                        </div>
                        <ul class="excludes-list">
                            <li>
                                <i class="fas fa-times"></i>
                                <div>
                                    <strong>Seguro de viaje</strong>
                                    <span>Recomendamos contratar uno</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-times"></i>
                                <div>
                                    <strong>Propinas</strong>
                                    <span>Para guía y conductor (voluntario)</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-times"></i>
                                <div>
                                    <strong>Entrada a Huayna Picchu</strong>
                                    <span>Disponible por $75 adicional</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-times"></i>
                                <div>
                                    <strong>Extras no mencionados</strong>
                                    <span>Bebidas alcohólicas, snacks adicionales</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Itinerario -->
                    <div class="itinerario-card">
                        <h3><i class="fas fa-route"></i> Itinerario del Día</h3>
                        <div class="itinerario-timeline">
                            <div class="timeline-step">
                                <div class="step-time">04:30 AM</div>
                                <div class="step-content">
                                    <strong>Recogida en tu hotel</strong>
                                    <p>Pasamos por ti para iniciar la aventura</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-time">06:30 AM</div>
                                <div class="step-content">
                                    <strong>Llegada a Ollantaytambo</strong>
                                    <p>Toma del tren hacia Aguas Calientes</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-time">08:30 AM</div>
                                <div class="step-content">
                                    <strong>Llegada a Machu Picchu</strong>
                                    <p>Subida en bus y visita guiada (2 horas)</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-time">12:00 PM</div>
                                <div class="step-content">
                                    <strong>Almuerzo</strong>
                                    <p>Restaurante local con vista a la montaña</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="step-time">04:00 PM</div>
                                <div class="step-content">
                                    <strong>Retorno a Cusco</strong>
                                    <p>Tren de regreso y traslado al hotel</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================
                    COLUMNA DERECHA - SIDEBAR (Sticky)
                    ============================================ -->
                <div class="tour-sidebar">
                    <div class="sidebar-card">
                        
                        <!-- Precio -->
                        <div class="sidebar-price">
                            <span class="price-label">Precio por persona</span>
                            <div class="price-value">
                                <span class="old-price">$650 USD</span>
                                <span class="current-price">$520 USD</span>
                            </div>
                            <span class="price-save">✨ ¡Ahorra $130!</span>
                        </div>

                        <!-- Detalles rápidos del tour -->
                        <div class="sidebar-details">
                            <div class="sidebar-detail">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <span>Duración</span>
                                    <strong>12 horas aprox.</strong>
                                </div>
                            </div>
                            <div class="sidebar-detail">
                                <i class="fas fa-hiking"></i>
                                <div>
                                    <span>Dificultad</span>
                                    <strong>Moderada</strong>
                                    <small>(apto principiantes)</small>
                                </div>
                            </div>
                            <div class="sidebar-detail">
                                <i class="fas fa-users"></i>
                                <div>
                                    <span>Tamaño de grupo</span>
                                    <strong>Máx 12 personas</strong>
                                    <small>Experiencia más personalizada</small>
                                </div>
                            </div>
                            <div class="sidebar-detail">
                                <i class="fas fa-language"></i>
                                <div>
                                    <span>Idiomas</span>
                                    <strong>Español / Inglés</strong>
                                </div>
                            </div>
                            <div class="sidebar-detail">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <span>Disponibilidad</span>
                                    <strong>Todos los días</strong>
                                    <small>Confirmación inmediata</small>
                                </div>
                            </div>
                        </div>

                        <!-- Separador -->
                        <div class="sidebar-divider"></div>

                        <!-- Botones de acción -->
                        <div class="sidebar-buttons">
                            <button class="btn-reservar" onclick="openReservaModal()">
                                <i class="fas fa-calendar-check"></i> Reservar Ahora
                            </button>
                            <button class="btn-consultar" onclick="openConsultaModal()">
                                <i class="fas fa-envelope"></i> Consultar
                            </button>
                        </div>

                        <!-- Garantías -->
                        <div class="sidebar-guarantees">
                            <div class="guarantee-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Mejor precio garantizado</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-undo-alt"></i>
                                <span>Cancelación gratis 24h antes</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-lock"></i>
                                <span>Pago 100% seguro</span>
                            </div>
                        </div>

                        <!-- Confianza adicional -->
                        <div class="sidebar-trust">
                            <div class="trust-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>4.9/5 · 2,500+ reseñas</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================
        SECCIÓN: GALERÍA (EXPERIENCIA REAL)
        ============================================ -->
    <section id="galeria" class="galeria-section">
        <div class="container">
            
            <!-- Encabezado -->
            <div class="section-header">
                <span class="section-subtitle">MOMENTOS REALES</span>
                <h2>Vive la <span class="highlight">experiencia</span> a través de nuestros viajeros</h2>
                <p>Imágenes y videos reales de viajeros como tú. Esto es lo que te espera.</p>
            </div>

            <!-- Filtros de categoría -->
            <div class="galeria-filters">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <button class="filter-btn" data-filter="aventura">🏔️ Aventura</button>
                <button class="filter-btn" data-filter="cultura">🏛️ Cultura</button>
                <button class="filter-btn" data-filter="gastronomia">🍜 Gastronomía</button>
                <button class="filter-btn" data-filter="atardecer">🌅 Atardeceres</button>
            </div>

            <!-- Grid de Galería -->
            <div class="galeria-grid">
                
                <!-- Item 1 - Foto Aventura -->
                <div class="galeria-item" data-category="aventura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/aventura-trekking.jpg" alt="Viajeros en el Salkantay Trek">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user1.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>María y Carlos</h4>
                                    <span>Viajeros de España</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"La mejor experiencia de nuestras vidas. El Salkantay es simplemente mágico."</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Salkantay Trek</span>
                                <span><i class="fas fa-heart"></i> 234</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 - Video Experiencia -->
                <div class="galeria-item video" data-category="aventura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <video class="galeria-video" poster="assets/galeria/video-poster.jpg" preload="metadata">
                                <source src="assets/galeria/experiencia-machupicchu.mp4" type="video/mp4">
                            </video>
                            <div class="video-play-btn">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="galeria-overlay">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user2.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Laura Fernández</h4>
                                    <span>Travel Blogger</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"Llegar a Machu Picchu al amanecer es indescriptible 🇵🇪✨"</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Machu Picchu</span>
                                <span><i class="fas fa-play-circle"></i> Video</span>
                                <span><i class="fas fa-heart"></i> 567</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 - Foto Cultura -->
                <div class="galeria-item" data-category="cultura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/cultura-inca.jpg" alt="Guía explicando historia Inca">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user3.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Familia Rodríguez</h4>
                                    <span>De México</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"Nuestro guía Juan nos enseñó cada rincón con tanta pasión. Increíble!"</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Valle Sagrado</span>
                                <span><i class="fas fa-heart"></i> 189</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 4 - Foto Atardecer -->
                <div class="galeria-item" data-category="atardecer">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/atardecer-montana.jpg" alt="Atardecer en las montañas">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user4.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Ana Sofía</h4>
                                    <span>Colombia</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"El atardecer desde el campamento... un sueño hecho realidad."</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Soraypampa</span>
                                <span><i class="fas fa-heart"></i> 342</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 5 - Video Grupal -->
                <div class="galeria-item video" data-category="aventura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <video class="galeria-video" poster="assets/galeria/grupo-poster.jpg" preload="metadata">
                                <source src="assets/galeria/grupo-feliz.mp4" type="video/mp4">
                            </video>
                            <div class="video-play-btn">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="galeria-overlay">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <div class="group-avatars">
                                    <img src="assets/avatars/user5.jpg" alt="">
                                    <img src="assets/avatars/user6.jpg" alt="">
                                    <img src="assets/avatars/user7.jpg" alt="">
                                    <span>+8</span>
                                </div>
                                <div>
                                    <h4>Grupo de Amigos</h4>
                                    <span>Argentina 🇦🇷</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"La mejor decisión fue hacer este tour juntos. Volveremos!"</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Machu Picchu</span>
                                <span><i class="fas fa-play-circle"></i> Video</span>
                                <span><i class="fas fa-heart"></i> 892</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 6 - Foto Gastronomía -->
                <div class="galeria-item" data-category="gastronomia">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/comida-local.jpg" alt="Comida peruana en el tour">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user8.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Chef viajero</h4>
                                    <span>Perú</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"El almuerzo en el restaurante local: ¡Cuy, Lomo Saltado y más!"</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Aguas Calientes</span>
                                <span><i class="fas fa-heart"></i> 421</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 7 - Foto Aventura -->
                <div class="galeria-item" data-category="aventura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/caminata-grupo.jpg" alt="Grupo caminando">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user9.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Pedro y equipo</h4>
                                    <span>Chile</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"Subiendo al punto más alto a 4,600m. El esfuerzo vale la pena!"</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Paso Salkantay</span>
                                <span><i class="fas fa-heart"></i> 567</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 8 - Foto Cultura -->
                <div class="galeria-item" data-category="cultura">
                    <div class="galeria-card">
                        <div class="galeria-image">
                            <img src="assets/galeria/mercado-local.jpg" alt="Mercado local">
                            <div class="galeria-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="galeria-info">
                            <div class="user-info">
                                <img src="assets/avatars/user10.jpg" alt="Usuario" class="user-avatar">
                                <div>
                                    <h4>Sarah</h4>
                                    <span>Inglaterra</span>
                                </div>
                            </div>
                            <p class="galeria-caption">"Conociendo el mercado local de Chinchero. La cultura viva del Perú."</p>
                            <div class="galeria-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Chinchero</span>
                                <span><i class="fas fa-heart"></i> 234</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Invitación a compartir -->
            <div class="share-invite">
                <div class="share-content">
                    <i class="fas fa-camera-retro"></i>
                    <h4>¿Ya viviste esta experiencia?</h4>
                    <p>Comparte tus fotos y videos con nosotros usando <strong>#MiAventuraPerú</strong></p>
                    <div class="share-social">
                        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                        <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                        <a href="#"><i class="fab fa-tiktok"></i> TikTok</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Lightbox para ver imágenes grandes -->
        <div id="lightbox" class="lightbox">
            <span class="lightbox-close">&times;</span>
            <img class="lightbox-image" src="">
            <div class="lightbox-caption"></div>
            <button class="lightbox-prev"><i class="fas fa-chevron-left"></i></button>
            <button class="lightbox-next"><i class="fas fa-chevron-right"></i></button>
        </div>

        <!-- Modal de Video -->
        <div id="videoModal" class="video-modal">
            <div class="video-modal-content">
                <span class="video-modal-close">&times;</span>
                <video id="modalVideo" controls>
                    <source src="" type="video/mp4">
                </video>
            </div>
        </div>
    </section>

    <!-- ============================================
        SECCIÓN: BENEFICIOS CLAVE (¿POR QUÉ ELEGIRNOS?)
        ============================================ -->
    <section id="beneficios" class="beneficios-section">
        <div class="container">
            
            <!-- Encabezado -->
            <div class="section-header">
                <span class="section-subtitle">¿POR QUÉ ELEGIRNOS?</span>
                <h2>La<span class="highlight"> diferencia</span> que hace tu experiencia</h2>
                <p>No solo ofrecemos tours, creamos experiencias memorables con estándares de calidad superiores.</p>
            </div>

            <!-- Grid de Beneficios -->
            <div class="beneficios-grid">
                
                <!-- Beneficio 1 - Guías Certificados -->
                <div class="beneficio-card">
                    <div class="beneficio-icon">
                        <i class="fas fa-certificate"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <h3>Guías Certificados</h3>
                    <p>Nuestros guías son profesionales titulados, bilingües y con más de 10 años de experiencia. Apasionados por compartir la historia y cultura Inca.</p>
                    <div class="beneficio-badge">
                        <i class="fas fa-check-circle"></i> 100% certificados
                    </div>
                </div>

                <!-- Beneficio 2 - Grupos Pequeños -->
                <div class="beneficio-card">
                    <div class="beneficio-icon">
                        <i class="fas fa-users"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <h3>Grupos Pequeños</h3>
                    <p>Máximo 12 personas por grupo. Esto garantiza una atención personalizada, mayor comodidad y una experiencia más íntima y auténtica.</p>
                    <div class="beneficio-badge">
                        <i class="fas fa-user-friends"></i> Máx. 12 viajeros
                    </div>
                </div>

                <!-- Beneficio 3 - Atención Personalizada -->
                <div class="beneficio-card">
                    <div class="beneficio-icon">
                        <i class="fas fa-headset"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <h3>Atención Personalizada</h3>
                    <p>Desde tu primera consulta hasta el final del tour, tendrás un asesor dedicado para resolver todas tus dudas y necesidades específicas.</p>
                    <div class="beneficio-badge">
                        <i class="fas fa-clock"></i> Soporte 24/7
                    </div>
                </div>

                <!-- Beneficio 4 - Cancelación Flexible -->
                <div class="beneficio-card">
                    <div class="beneficio-icon">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <h3>Cancelación Flexible</h3>
                    <p>Cancelación gratuita hasta 24 horas antes del tour. Tu tranquilidad es nuestra prioridad, sin preocupaciones por imprevistos.</p>
                    <div class="beneficio-badge">
                        <i class="fas fa-undo-alt"></i> Cancelación gratis
                    </div>
                </div>

            </div>

            <!-- Beneficios Adicionales (Grid 2) -->
            <div class="beneficios-adicionales">
                <div class="section-subtitle-center">Y también...</div>
                <div class="adicionales-grid">
                    
                    <div class="adicional-item">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Seguro incluido</strong>
                            <span>Asistencia médica básica durante el tour</span>
                        </div>
                    </div>
                    
                    <div class="adicional-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Puntualidad garantizada</strong>
                            <span>Llegamos siempre a tiempo, respetamos tu itinerario</span>
                        </div>
                    </div>
                    
                    <div class="adicional-item">
                        <i class="fas fa-ticket-alt"></i>
                        <div>
                            <strong>Entradas aseguradas</strong>
                            <span>Nos encargamos de toda la gestión de boletos</span>
                        </div>
                    </div>
                    
                    <div class="adicional-item">
                        <i class="fas fa-hand-holding-heart"></i>
                        <div>
                            <strong>Turismo responsable</strong>
                            <span>Operamos con respeto a las comunidades locales</span>
                        </div>
                    </div>
                    
                    <div class="adicional-item">
                        <i class="fas fa-wifi"></i>
                        <div>
                            <strong>Comunicación constante</strong>
                            <span>Asistencia vía WhatsApp durante todo el viaje</span>
                        </div>
                    </div>
                    
                    <div class="adicional-item">
                        <i class="fas fa-gem"></i>
                        <div>
                            <strong>Experiencias auténticas</strong>
                            <span>Tour diseñado por locales que aman su tierra</span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Comparación vs Competencia -->
            <div class="comparison-table">
                <div class="comparison-header">
                    <h3><i class="fas fa-chart-line"></i> ¿Por qué somos diferentes?</h3>
                    <p>Comparamos nuestra oferta con el mercado tradicional</p>
                </div>
                
                <div class="table-wrapper">
                    <table class="comparison-grid">
                        <thead>
                            <tr>
                                <th>Característica</th>
                                <th>Nosotros</th>
                                <th>Otras agencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Guías certificados</td>
                                <td><i class="fas fa-check-circle"></i> Sí, titulados</td>
                                <td><i class="fas fa-times-circle"></i> Sin certificación</td>
                            </tr>
                            <tr>
                                <td>Tamaño del grupo</td>
                                <td><i class="fas fa-check-circle"></i> Máx 12 personas</td>
                                <td><i class="fas fa-clock"></i> 20-30 personas</td>
                            </tr>
                            <tr>
                                <td>Atención personalizada</td>
                                <td><i class="fas fa-check-circle"></i> Dedicada 24/7</td>
                                <td><i class="fas fa-times-circle"></i> Limitada</td>
                            </tr>
                            <tr>
                                <td>Cancelación flexible</td>
                                <td><i class="fas fa-check-circle"></i> Gratis 24h antes</td>
                                <td><i class="fas fa-times-circle"></i> Penalidades</td>
                            </tr>
                            <tr>
                                <td>Mejor precio garantizado</td>
                                <td><i class="fas fa-check-circle"></i> Sí</td>
                                <td><i class="fas fa-question-circle"></i> No siempre</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CTA Final -->
            <div class="beneficios-cta">
                <div class="cta-content">
                    <i class="fas fa-medal"></i>
                    <h4>¿Listo para vivir la diferencia?</h4>
                    <p>Únete a los viajeros que ya confían en nuestra experiencia</p>
                    <a href="#reservar" class="btn-cta" onclick="openReservaModal()">
                        Reserva tu plaza <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================
        SECCIÓN: URGENCIA / ESCASEZ
        ============================================ -->
    <section id="urgencia" class="urgencia-section">
        <div class="container">
            
            <!-- Banner Principal de Urgencia -->
            <div class="urgencia-banner">
                <div class="urgencia-badge">
                    <i class="fas fa-fire"></i> Oferta por tiempo limitado
                </div>
                
                <div class="urgencia-content">
                    <div class="urgencia-texto">
                        <h2>⚠️ ¡Últimos <span class="highlight">cupos disponibles</span>!</h2>
                        <p>No dejes pasar esta oportunidad única. Los cupos para esta temporada se agotan rápidamente.</p>
                    </div>
                    
                    <!-- Contador Regresivo -->
                    <div class="countdown-container">
                        <div class="countdown-title">
                            <i class="fas fa-hourglass-half"></i> Oferta válida hasta:
                        </div>
                        <div class="countdown" id="countdownTimer">
                            <div class="countdown-block">
                                <div class="countdown-number" id="dias">00</div>
                                <div class="countdown-label">Días</div>
                            </div>
                            <div class="countdown-separator">:</div>
                            <div class="countdown-block">
                                <div class="countdown-number" id="horas">00</div>
                                <div class="countdown-label">Horas</div>
                            </div>
                            <div class="countdown-separator">:</div>
                            <div class="countdown-block">
                                <div class="countdown-number" id="minutos">00</div>
                                <div class="countdown-label">Minutos</div>
                            </div>
                            <div class="countdown-separator">:</div>
                            <div class="countdown-block">
                                <div class="countdown-number" id="segundos">00</div>
                                <div class="countdown-label">Segundos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid de Escasez -->
            <div class="escasez-grid">
                
                <!-- Cupos Limitados -->
                <div class="escasez-card">
                    <div class="escasez-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h3>Cupos Limitados</h3>
                    <div class="cupos-bar">
                        <div class="cupos-progress" style="width: 85%">
                            <span>85% ocupado</span>
                        </div>
                    </div>
                    <div class="cupos-info">
                        <span class="cupos-restantes">
                            <i class="fas fa-users"></i> ¡Solo 8 cupos restantes!
                        </span>
                        <span class="cupos-total">Capacidad: 50 viajeros/mes</span>
                    </div>
                    <div class="escasez-alerta">
                        <i class="fas fa-chart-line"></i> Esta semana: 12 reservas confirmadas
                    </div>
                </div>

                <!-- Precio Promocional -->
                <div class="escasez-card highlight">
                    <div class="escasez-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h3>Precio Promocional</h3>
                    <div class="precio-promo">
                        <span class="precio-antiguo">$650 USD</span>
                        <span class="precio-nuevo">$520 USD</span>
                        <span class="descuento">-20%</span>
                    </div>
                    <div class="promo-timer">
                        <i class="fas fa-clock"></i> Válido por: <strong>2 días 14 horas</strong>
                    </div>
                    <div class="escasez-bonus">
                        <i class="fas fa-gift"></i> + Descuento especial para grupos de 4+
                    </div>
                </div>

                <!-- Reservas Recientes -->
                <div class="escasez-card">
                    <div class="escasez-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Actividad Reciente</h3>
                    <div class="reservas-recientes" id="reservasRecientes">
                        <div class="reserva-item">
                            <i class="fas fa-user-check"></i>
                            <div>
                                <strong>María G.</strong> reservó hace <span class="tiempo">5 minutos</span>
                            </div>
                        </div>
                        <div class="reserva-item">
                            <i class="fas fa-user-check"></i>
                            <div>
                                <strong>Carlos R.</strong> reservó hace <span class="tiempo">15 minutos</span>
                            </div>
                        </div>
                        <div class="reserva-item">
                            <i class="fas fa-user-check"></i>
                            <div>
                                <strong>Laura F.</strong> reservó hace <span class="tiempo">32 minutos</span>
                            </div>
                        </div>
                        <div class="reserva-item">
                            <i class="fas fa-user-check"></i>
                            <div>
                                <strong>Pedro S.</strong> reservó hace <span class="tiempo">1 hora</span>
                            </div>
                        </div>
                    </div>
                    <div class="ver-mas-reservas">
                        <i class="fas fa-chart-simple"></i> 28 personas han reservado hoy
                    </div>
                </div>

            </div>

            <!-- Banner de Urgencia Adicional -->
            <div class="urgencia-alerta">
                <div class="alerta-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alerta-contenido">
                    <strong>⚠️ Atención:</strong> La demanda supera la oferta. ¡No esperes al último momento!
                </div>
                <a href="#reservar" class="alerta-boton" onclick="openReservaModal()">
                    Reservar ahora <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Testimonio de Urgencia -->
            <div class="urgencia-testimonio">
                <i class="fas fa-quote-left"></i>
                <p>"Iba a esperar una semana más para reservar, pero cuando vi que los cupos se agotaban, resolví hacerlo de inmediato. ¡Fue la mejor decisión! El tour superó mis expectativas."</p>
                <div class="testimonio-autor">
                    <strong>— Ana Sofía</strong>
                    <span>Viajó con nosotros en Enero 2024</span>
                </div>
            </div>

            <!-- CTA Final con Urgencia -->
            <div class="urgencia-cta">
                <div class="cta-urgencia">
                    <div class="cta-texto">
                        <i class="fas fa-gem"></i>
                        <div>
                            <h4>¿Esperar o reservar?</h4>
                            <p>Los cupos se agotan cada semana. Asegura tu lugar hoy.</p>
                        </div>
                    </div>
                    <button class="btn-urgencia" onclick="openReservaModal()">
                        <i class="fas fa-luggage-cart"></i> Reservar mi cupo ahora
                        <span>¡Últimos!</span>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================
        SECCIÓN: PREGUNTAS FRECUENTES (FAQ)
        ============================================ -->
    <section id="faq" class="faq-section">
        <div class="container">
            
            <!-- Encabezado -->
            <div class="section-header">
                <span class="section-subtitle">RESUELVE TUS DUDAS</span>
                <h2>Preguntas <span class="highlight">frecuentes</span></h2>
                <p>Todo lo que necesitas saber antes de vivir esta aventura</p>
            </div>

            <div class="faq-wrapper">
                <!-- Columna Izquierda - Resumen rápido -->
                <div class="faq-sidebar">
                    <div class="faq-stats">
                        <div class="stat-item">
                            <i class="fas fa-headset"></i>
                            <div>
                                <strong>Atención 24/7</strong>
                                <span>Resolvemos tus dudas</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Respuesta rápida</strong>
                                <span>Menos de 2 horas</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-users"></i>
                            <div>
                                <strong>+2,500 viajeros</strong>
                                <span>Ya confían en nosotros</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="faq-contact">
                        <i class="fas fa-comment-dots"></i>
                        <h4>¿No encontraste respuesta?</h4>
                        <p>Contáctanos directamente y te ayudaremos</p>
                        <button class="faq-contact-btn" onclick="openConsultaModal()">
                            <i class="fab fa-whatsapp"></i> Chatear ahora
                        </button>
                    </div>
                </div>

                <!-- Columna Derecha - Acordeón FAQ -->
                <div class="faq-accordion">
                    
                    <!-- Categoría: Seguridad -->
                    <div class="faq-category">
                        <div class="category-header">
                            <i class="fas fa-shield-alt"></i>
                            <span>Seguridad y Confianza</span>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🔒 ¿Es seguro realizar este tour?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>¡Totalmente seguro! Trabajamos con operadores turísticos certificados y todas nuestras actividades cuentan con: estándares internacionales, seguimiento permanente, asistencia médica básica y guías capacitados en primeros auxilios. Además, más de 2,500 viajeros ya han disfrutado esta experiencia sin incidentes.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🆘 ¿Qué pasa en caso de emergencia médica?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>Contamos con un protocolo de emergencia establecido. Todos nuestros guías tienen certificación en primeros auxilios y llevamos un botiquín completo. Además, tenemos coordinación con centros médicos en cada destino. Recomendamos contratar un seguro de viaje adicional para mayor tranquilidad.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🏔️ ¿Hay riesgo de mal de altura?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>El mal de altura puede afectar a algunas personas. Recomendamos: llegar a Cusco 1-2 días antes para aclimatarte, hidratarte constantemente, evitar comidas pesadas antes del tour. Nuestros guías llevan oxígeno portátil y hojas de coca para aliviar síntomas leves.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Categoría: Preparación -->
                    <div class="faq-category">
                        <div class="category-header">
                            <i class="fas fa-backpack"></i>
                            <span>Preparación y Equipaje</span>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🎒 ¿Qué debo llevar al tour?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p><strong>Imprescindible:</strong> Documento de identidad/pasaporte, ropa cómoda y en capas, zapatos para caminar, bloqueador solar, gorro, agua. <strong>Recomendado:</strong> Cámara, dinero extra para souvenirs, repelente de insectos, impermeable ligero. <strong>Opcional:</strong> Bastones de trekking (alquiler disponible).</p>
                                <div class="faq-tags">
                                    <span class="tag">📄 Documentos</span>
                                    <span class="tag">👕 Ropa cómoda</span>
                                    <span class="tag">☀️ Bloqueador</span>
                                    <span class="tag">🎒 Mochila</span>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>👕 ¿Cómo es el clima? ¿Qué ropa llevar?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>El clima en Cusco/Machu Picchu varía: mañanas soleadas (15-20°C), tardes con posible lluvia, noches frías (5-10°C). Recomendamos vestirte en capas: camiseta térmica, polar/casaca, chaqueta impermeable. ¡No olvides gorro y bufanda para la mañana temprano!</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🍴 ¿Hay opciones para dietas especiales?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>Sí. Aceptamos solicitudes para vegetarianos, veganos, celíacos, sin lactosa, etc. Solo debes notificarlo al momento de reservar. Nuestros chefs locales preparan opciones deliciosas adaptadas a tu necesidad.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Categoría: Políticas -->
                    <div class="faq-category">
                        <div class="category-header">
                            <i class="fas fa-file-contract"></i>
                            <span>Políticas y Reservas</span>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>❌ ¿Cuál es la política de cancelación?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p><strong>Cancelación gratuita hasta 24 horas antes del tour</strong> - Reembolso 100%. Cancelación entre 24-12 horas: 50% de reembolso. Menos de 12 horas o no presentación: no hay reembolso. Si la cancelación es por nuestra parte (clima extremo, etc.), reembolso 100% o reprogramación sin costo.</p>
                                <div class="faq-highlight">
                                    <i class="fas fa-check-circle"></i> Cancelación GRATIS hasta 24h antes
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>💰 ¿Cómo se realiza el pago?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>Aceptamos varios métodos de pago: Tarjetas de crédito/débito (Visa, Mastercard), PayPal, transferencia bancaria, Yape, Plin. Todos los pagos son 100% seguros con encriptación SSL. Puedes pagar el 100% o una reserva del 30% (saldo restante en efectivo el día del tour).</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>📅 ¿Puedo cambiar la fecha después de reservar?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>Sí, puedes cambiar la fecha hasta 7 días antes sin costo adicional. Si es dentro de los 7 días, sujeto a disponibilidad con un cargo administrativo mínimo de $15. Contáctanos con al menos 24 horas de anticipación para gestionar el cambio.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Categoría: Viajeros -->
                    <div class="faq-category">
                        <div class="category-header">
                            <i class="fas fa-family"></i>
                            <span>Viajeros y Grupos</span>
                        </div>
                        
                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>👶 ¿Niños pueden participar?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p><strong>Sí, niños mayores de 6 años pueden participar</strong> acompañados de un adulto. Para niños de 6-12 años hay descuento especial. Recomendamos evaluar la condición física del niño. Menores de 6 años: consultar disponibilidad para tours privados adaptados. ¡Pregunta por nuestras tarifas infantiles!</p>
                                <div class="faq-tags">
                                    <span class="tag">👧 6-12 años: -20%</span>
                                    <span class="tag">👶 -6 años: consultar</span>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🚶 ¿Cuál es el nivel de dificultad?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>Nivel <strong>moderado</strong>. El tour incluye caminatas de 2-3 horas en total con algunas pendientes suaves. Es apto para principiantes activos. No se requiere experiencia previa en trekking. Personas con movilidad reducida: consultar para opciones adaptadas.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-question">
                                <span>🐕 ¿Puedo llevar mi mascota?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-answer">
                                <p>No se permiten mascotas en la mayoría de tours por restricciones de los sitios arqueológicos y transporte. Para tours privados especiales, consulta disponibilidad y requisitos adicionales para tu mascota de apoyo emocional.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ¿Aún con dudas? -->
            <div class="faq-footer">
                <div class="footer-content">
                    <i class="fas fa-headset"></i>
                    <div>
                        <h4>¿Aún tienes preguntas?</h4>
                        <p>Estamos aquí para ayudarte. Resolvemos todas tus dudas en menos de 2 horas.</p>
                    </div>
                    <button class="footer-btn" onclick="openConsultaModal()">
                        Contactar soporte <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================
        CTA FLOTANTE INFERIOR - SIMPLE Y ELEGANTE
        ============================================ -->
    <div id="floatingCTA" class="floating-cta">
        <div class="floating-cta-container">
            
            <!-- Icono de oferta -->
            <div class="floating-icon">
                <i class="fas fa-fire"></i>
            </div>
            
            <!-- Texto de oferta -->
            <div class="floating-text">
                <span class="floating-badge">🔥 Oferta por tiempo limitado</span>
                <strong>Últimos 8 cupos · $520 USD</strong>
            </div>
            
            <!-- Botón CTA -->
            <button class="floating-button" onclick="scrollToTour()">
                <i class="fas fa-calendar-check"></i> Reservar
                <i class="fas fa-arrow-right"></i>
            </button>
            
            <!-- Botón cerrar -->
            <button class="floating-close" onclick="closeFloatingCTA()">
                <i class="fas fa-times"></i>
            </button>
            
        </div>
    </div>
        
    <!-- ============================================
        FOOTER SIMPLE
        ============================================ -->
    <footer class="footer">
        <div class="footer-container">
            
            <!-- Fila principal -->
            <div class="footer-main">
                
                <!-- Logo y descripción -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <i class="fas fa-mountain"></i>
                        <span><?php echo APP_NAME; ?></span>
                    </div>
                    <p class="footer-description">
                        Experiencias únicas en Machu Picchu con los mejores estándares de calidad.
                    </p>
                </div>
                
                <!-- Enlaces rápidos -->
                <div class="footer-links">
                    <h4>Explorar</h4>
                    <ul>
                        <li><a href="#home">Inicio</a></li>
                        <li><a href="#tour">El Tour</a></li>
                        <li><a href="#galeria">Galería</a></li>
                        <li><a href="#faq">Preguntas</a></li>
                    </ul>
                </div>
                
                <!-- Contacto -->
                <div class="footer-contact">
                    <h4>Contacto</h4>
                    <ul>
                        <li><i class="fab fa-whatsapp"></i> +51 999 888 777</li>
                        <li><i class="far fa-envelope"></i> info@michicchutours.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Cusco - Perú</li>
                    </ul>
                </div>
                
                <!-- Redes Sociales -->
                <div class="footer-social">
                    <h4>Síguenos</h4>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
            </div>
            
            <!-- Fila inferior -->
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Todos los derechos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Términos y condiciones</a>
                    <span class="separator">|</span>
                    <a href="#">Política de privacidad</a>
                    <span class="separator">|</span>
                    <a href="#">Libro de reclamaciones</a>
                </div>
            </div>
            
        </div>
    </footer>

    <!-- ============================================
        MODAL DE CONSULTA (Formulario Simple)
        ============================================ -->
    <div id="enquiryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEnquiryModal()">&times;</span>
            <div class="modal-header">
                <i class="fas fa-question-circle"></i>
                <h3>Consultar sobre <span id="modalTourName">Machu Picchu Tour</span></h3>
            </div>
            
            <form id="enquiryForm" class="enquiry-form" onsubmit="submitEnquiry(event)">
                <input type="hidden" id="enquiryTourName" name="tour">
                
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Nombre completo *</label>
                    <input type="text" id="enquiryName" name="name" placeholder="Ej: Juan Carlos Pérez" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email *</label>
                    <input type="email" id="enquiryEmail" name="email" placeholder="ejemplo@correo.com" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fab fa-whatsapp"></i> WhatsApp / Teléfono *</label>
                    <input type="tel" id="enquiryPhone" name="phone" placeholder="+51 999 888 777" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> Fecha preferida</label>
                        <input type="date" id="enquiryDate" name="date" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-users"></i> Personas</label>
                        <select id="enquiryPeople" name="people">
                            <option value="1">1 persona</option>
                            <option value="2" selected>2 personas</option>
                            <option value="3">3 personas</option>
                            <option value="4">4 personas</option>
                            <option value="5">5 personas</option>
                            <option value="6">6 personas</option>
                            <option value="7+">7+ personas</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Mensaje</label>
                    <textarea id="enquiryMessage" name="message" rows="4" placeholder="¿Tienes alguna pregunta específica? ¿Alguna condición especial?"></textarea>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Enviar consulta
                    </button>
                    <button type="button" class="btn-cancel" onclick="closeEnquiryModal()">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================
        MODAL DE RESERVA (3 Pasos)
        ============================================ -->
    <div id="reservaModal" class="modal">
        <div class="modal-content modal-reserva">
            <span class="close-modal" onclick="closeReservaModal()">&times;</span>
            
            <div class="modal-header">
                <i class="fas fa-calendar-check"></i>
                <h3>Reservar: <span id="modalTourNameReserva">Machu Picchu Tour</span></h3>
            </div>
            
            <!-- Progress Bar -->
            <div class="reserva-progress">
                <div class="progress-steps">
                    <div class="progress-step active" id="step1">
                        <div class="step-number">1</div>
                        <div class="step-label">Datos Personales</div>
                    </div>
                    <div class="progress-line" id="line1"></div>
                    <div class="progress-step" id="step2">
                        <div class="step-number">2</div>
                        <div class="step-label">Detalles del Tour</div>
                    </div>
                    <div class="progress-line" id="line2"></div>
                    <div class="progress-step" id="step3">
                        <div class="step-number">3</div>
                        <div class="step-label">Pago</div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de Reserva -->
            <form id="reservaForm" class="reserva-form" onsubmit="submitReserva(event)">
                <input type="hidden" id="tourReservaName" name="tour_name">
                
                <!-- PASO 1: DATOS DEL CLIENTE -->
                <div class="reserva-paso active" id="paso1">
                    <h4><i class="fas fa-user-circle"></i> Información Personal</h4>
                    
                    <div class="form-group">
                        <label>Tipo de documento *</label>
                        <select id="tipo_documento" name="tipo_documento" required>
                            <option value="">Seleccione...</option>
                            <option value="DNI">DNI (Perú)</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Número de documento</label>
                        <input type="text" id="documento" name="documento" placeholder="Opcional">
                    </div>
                    
                    <div class="form-group">
                        <label>Nombre completo *</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" required placeholder="Ej: Juan Carlos Pérez Gómez">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Edad *</label>
                            <input type="number" id="edad" name="edad" min="1" max="120" required placeholder="25">
                        </div>
                        <div class="form-group">
                            <label>Sexo *</label>
                            <select id="sexo" name="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>País de residencia *</label>
                        <select id="pais" name="pais" required onchange="actualizarCodigoPais()">
                            <option value="">Seleccione su País</option>
                            <option value="Perú" data-codigo="+51">Perú (+51)</option>
                            <option value="Argentina" data-codigo="+54">Argentina (+54)</option>
                            <option value="Bolivia" data-codigo="+591">Bolivia (+591)</option>
                            <option value="Brasil" data-codigo="+55">Brasil (+55)</option>
                            <option value="Chile" data-codigo="+56">Chile (+56)</option>
                            <option value="Colombia" data-codigo="+57">Colombia (+57)</option>
                            <option value="Costa Rica" data-codigo="+506">Costa Rica (+506)</option>
                            <option value="Cuba" data-codigo="+53">Cuba (+53)</option>
                            <option value="Ecuador" data-codigo="+593">Ecuador (+593)</option>
                            <option value="El Salvador" data-codigo="+503">El Salvador (+503)</option>
                            <option value="España" data-codigo="+34">España (+34)</option>
                            <option value="Estados Unidos" data-codigo="+1">Estados Unidos (+1)</option>
                            <option value="Guatemala" data-codigo="+502">Guatemala (+502)</option>
                            <option value="Honduras" data-codigo="+504">Honduras (+504)</option>
                            <option value="México" data-codigo="+52">México (+52)</option>
                            <option value="Nicaragua" data-codigo="+505">Nicaragua (+505)</option>
                            <option value="Panamá" data-codigo="+507">Panamá (+507)</option>
                            <option value="Paraguay" data-codigo="+595">Paraguay (+595)</option>
                            <option value="Uruguay" data-codigo="+598">Uruguay (+598)</option>
                            <option value="Venezuela" data-codigo="+58">Venezuela (+58)</option>
                            <option value="Otro" data-codigo="">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group" style="flex: 0.3;">
                            <label>Código país</label>
                            <input type="text" id="codigo_pais" name="codigo_pais" value="-" readonly>
                        </div>
                        <div class="form-group" style="flex: 0.7;">
                            <label>Teléfono / WhatsApp *</label>
                            <input type="tel" id="telefono" name="telefono" required placeholder="999 888 777">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo electrónico *</label>
                        <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
                    </div>
                </div>
                
                <!-- PASO 2: DETALLES DEL TOUR -->
                <div class="reserva-paso" id="paso2">
                    <h4><i class="fas fa-hiking"></i> Detalles del Tour</h4>
                    
                    <div class="tour-resumen-card" id="tourResumen">
                        <!-- Se llena con JS -->
                    </div>
                    
                    <div class="form-group">
                        <label>Fecha de salida *</label>
                        <input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Fecha alternativa (opcional)</label>
                        <input type="date" id="fecha_alternativa" name="fecha_alternativa" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        <small>En caso la fecha principal no esté disponible</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de servicio *</label>
                        <div class="servicio-opciones">
                            <label class="servicio-option">
                                <input type="radio" name="tipo_servicio" value="grupal" checked onchange="actualizarPrecioServicio()">
                                <i class="fas fa-users"></i>
                                <div>
                                    <strong>Servicio Grupal</strong>
                                    <span>$520 USD / persona</span>
                                </div>
                            </label>
                            <label class="servicio-option">
                                <input type="radio" name="tipo_servicio" value="privado" onchange="actualizarPrecioServicio()">
                                <i class="fas fa-user-friends"></i>
                                <div>
                                    <strong>Servicio Privado</strong>
                                    <span>$850 USD / persona</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Número de personas *</label>
                        <div class="people-selector">
                            <button type="button" class="people-btn minus" onclick="updatePeopleCount(-1)">-</button>
                            <input type="number" id="personas" name="personas" value="1" min="1" max="12" readonly>
                            <button type="button" class="people-btn plus" onclick="updatePeopleCount(1)">+</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Requerimientos especiales</label>
                        <textarea id="requerimientos" name="requerimientos" rows="3" placeholder="Alergias, condiciones médicas, dieta especial, etc."></textarea>
                    </div>
                </div>
                
                <!-- PASO 3: PAGO -->
                <div class="reserva-paso" id="paso3">
                    <h4><i class="fas fa-credit-card"></i> Método de Pago</h4>
                    
                    <div class="total-pago-card" id="totalPagoCard">
                        <div class="total-label">Total a pagar:</div>
                        <div class="total-amount" id="totalAmount">$520 USD</div>
                        <div class="total-note">*Precio por persona</div>
                    </div>
                    
                    <div class="payment-methods">
                        <h5>Selecciona tu método de pago</h5>
                        <div class="payment-options-grid">
                            <label class="payment-option" data-method="tarjeta">
                                <input type="radio" name="metodo_pago" value="Tarjeta" checked onchange="showPaymentDetail('tarjeta')">
                                <i class="fas fa-credit-card"></i>
                                <span>Tarjeta</span>
                            </label>
                            <label class="payment-option" data-method="paypal">
                                <input type="radio" name="metodo_pago" value="PayPal" onchange="showPaymentDetail('paypal')">
                                <i class="fab fa-paypal"></i>
                                <span>PayPal</span>
                            </label>
                            <label class="payment-option" data-method="yape">
                                <input type="radio" name="metodo_pago" value="Yape" onchange="showPaymentDetail('yape')">
                                <i class="fas fa-mobile-alt"></i>
                                <span>Yape</span>
                            </label>
                            <label class="payment-option" data-method="plin">
                                <input type="radio" name="metodo_pago" value="Plin" onchange="showPaymentDetail('plin')">
                                <i class="fas fa-bolt"></i>
                                <span>Plin</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Detalles de pago según método -->
                    <div id="paymentDetails">
                        <!-- Tarjeta -->
                        <div class="payment-detail active" id="detail-tarjeta">
                            <div class="form-group">
                                <label>Número de tarjeta</label>
                                <input type="text" id="numero_tarjeta" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Vencimiento</label>
                                    <input type="text" id="vencimiento" placeholder="MM/AA" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label>CVV</label>
                                    <input type="text" id="cvv" placeholder="123" maxlength="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nombre en la tarjeta</label>
                                <input type="text" id="nombre_tarjeta" placeholder="Como aparece en la tarjeta">
                            </div>
                        </div>
                        
                        <!-- PayPal -->
                        <div class="payment-detail" id="detail-paypal">
                            <div class="payment-info-box">
                                <i class="fab fa-paypal"></i>
                                <p>Serás redirigido a PayPal para completar el pago de forma segura.</p>
                                <div class="security-badge">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Pago protegido por PayPal</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Yape -->
                        <div class="payment-detail" id="detail-yape">
                            <div class="form-group">
                                <label>Número de celular (Yape)</label>
                                <div class="phone-input-group">
                                    <span class="country-code">+51</span>
                                    <input type="tel" id="yape_phone" placeholder="999 888 777">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Código de verificación Yape</label>
                                <input type="text" id="yape_code" placeholder="Código de 6 dígitos" maxlength="6">
                            </div>
                        </div>
                        
                        <!-- Plin -->
                        <div class="payment-detail" id="detail-plin">
                            <div class="form-group">
                                <label>Número de celular (Plin)</label>
                                <div class="phone-input-group">
                                    <span class="country-code">+51</span>
                                    <input type="tel" id="plin_phone" placeholder="999 888 777">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Código de verificación Plin</label>
                                <input type="text" id="plin_code" placeholder="Código de 6 dígitos" maxlength="6">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Términos y condiciones -->
                    <div class="terminos-condiciones">
                        <input type="checkbox" id="terminos_reserva" required>
                        <label for="terminos_reserva">
                            Acepto los <a href="#" onclick="verTerminos(event)">términos y condiciones</a>
                        </label>
                    </div>
                </div>
                
                <!-- Botones de navegación -->
                <div class="reserva-botones">
                    <button type="button" class="btn-prev" id="btnPrev" onclick="prevPaso()" style="display: none;">
                        <i class="fas fa-arrow-left"></i> Anterior
                    </button>
                    <button type="button" class="btn-next" id="btnNext" onclick="nextPaso()">
                        Siguiente <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="btn-submit" id="btnSubmit" style="display: none;">
                        <i class="fas fa-check-circle"></i> Confirmar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

    <!-- JavaScript -->
    <script src="assets/js/header.js"></script>
    <script src="assets/js/hero.js"></script>
    <script src="assets/js/prueba-social.js"></script>
    <script src="assets/js/tour.js"></script>
    <script src="assets/js/galeria.js"></script>
    <script src="assets/js/beneficios.js"></script>
    <script src="assets/js/urgencias.js"></script>
    <script src="assets/js/components/modal.js"></script>
    <script src="assets/js/faq.js"></script>
    <script src="assets/js/cta.js"></script>
    <script src="assets/js/footer.js"></script>

</body>
</html>