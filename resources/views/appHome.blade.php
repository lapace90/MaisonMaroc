<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison d'Hôte</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Maison d'Hôte</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="hamburger">
                <span class="hamburger-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Activités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nos Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Jumbotron -->
    <header class="bg pt-3">
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1 class="display-4">{{ __('messages.welcome') }}</h1>
                <p class="lead">Découvrez la beauté du désert marocain dans notre charmante maison d'hôte.</p>
                <a class="btn btn-lg" href="#" role="button">Réservez maintenant</a>
            </div>
        </div>
        <!-- Carrousel -->
        <div class="container">
            <div id="activityCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#activityCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#activityCarousel" data-slide-to="1"></li>
                    <li data-target="#activityCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="Activité 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Activité 1</h5>
                            <p>Description de l'activité 1.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="Activité 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Activité 2</h5>
                            <p>Description de l'activité 2.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/1200x500" class="d-block w-100" alt="Activité 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Activité 3</h5>
                            <p>Description de l'activité 3.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#activityCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#activityCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>

    </header>

    <!-- Section Activités -->
    <main class="container mt-4">
        <section class="mb-4">
            <h2>Activités proposées</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Activité 1">
                        <div class="card-body">
                            <h5 class="card-title">Activité 1</h5>
                            <p class="card-text">Description de l'activité 1.</p>
                            <a href="#" class="btn">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Activité 2">
                        <div class="card-body">
                            <h5 class="card-title">Activité 2</h5>
                            <p class="card-text">Description de l'activité 2.</p>
                            <a href="#" class="btn">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="Activité 3">
                        <div class="card-body">
                            <h5 class="card-title">Activité 3</h5>
                            <p class="card-text">Description de l'activité 3.</p>
                            <a href="#" class="btn">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="container mt-4">
        <div id="contact" class=" class="mb-4"">
            <h2 class="mb-5 text-center">{{ __('messages.contact_us') }}</h2>
            <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg">Envoyer</button>
                </div>
            </form>
        </div>
    </section>

    <section class="container text-center my-5">
        <div class="social-icons">
            <h4>Suivez-nous</h4>
            <a href="#" class="mr-3"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="mr-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="mr-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="mr-3"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg py-4" id="footer">
        <div class="container text-center">
            <p>&copy; 2024 Maison d'Hôte. Tous droits réservés.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Politique de confidentialité</a></li>
                <li class="list-inline-item"><a href="#">Conditions d'utilisation</a></li>
                <li class="list-inline-item"><a href="#">Contactez-nous</a></li>
            </ul>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
