<!--main.php-->
<?php
session_start();
include("../backend/Connect.php");
require '../backend/fetchNotifications.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="https://odoocdn.com/web/assets/1/9b636e3/web.assets_frontend.min.css"/>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_index.css" />
    <link rel="stylesheet" href="../style/main.css" />
    <link rel="icon" href="..\img\3.png" />      
</head>
<body id="main1" class="text-white background-slider">
  
<div class="text-white body-home">  
    <?php include '../partials/header.php'; ?>
    
    <div class="p-5 text-white text-center fade-in">
        <section class="welcome-text d-flex justify-content-center align-items-center flex-column">
            <img src="../img/3.png" alt="University Logo" />
            <h4 class="mt-3">Get Your Documents Easily</h4>
        </section>
    </div>

    <div class="section-spacing"></div>

    <h2 class="text-white ps-5">Available Features:</h2>
   
    <div class="background-slider p-5 mt-5 text-white">
        <section>
            <div class="card-group gap-5 reveal">
                <div class="card rounded-3 p-3 mt-3 text-light bg-dark feature-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center" style="font-size: 18px; width: 90%; line-height: 1.6;">
                            <h3>Request Documents:</h3>
                            <p>
                                Easily request school certificates, 
                                good conduct attestations, or grade 
                                appeals by filling out a simple form.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card rounded-3 p-3 mt-3 text-light bg-dark feature-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center" style="font-size: 18px; width: 90%; line-height: 1.6;">
                            <h3>Track Your Requests:</h3>
                            <p>
                                After submitting your request, you can
                                track its status in real time. You'll be
                                notified when your document is ready.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card rounded-3 p-3 mt-3 text-light bg-dark feature-card">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="text-center" style="font-size: 18px; width: 90%; line-height: 1.6;">
                            <h3>Quick Access:</h3>
                            <p>
                                View all your past requests and their
                                current status whether "Requested",
                                "In Progress", or "Ready for Pickup".
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="large-spacing"></div>

    <div class="p-5 text-white .bg-gradient mt-5 text-center fade-in card border rounded-5 p-3 shadow box-area border-white bg-transparent">
        <div class="child">
            <h1 class="pt-5">Student Role:</h1>
            <div class="my-4 line-height-lg">
                <p>
                    Your role is simple: submit your request through the form,
                    track the status of your request, and collect your document
                    when it's ready. This system aims to simplify your
                    administrative procedures and provide clear, transparent tracking.
                </p>
            </div>
        </div>
    </div>

    <div class="p-5 text-white bg-dark mt-5 text-center fade-in card">
        <p class="py-3">
            Thank you for using this service. We encourage you to regularly
            check the status of your requests.
        </p>
    </div>
    
    <div class="large-spacing"></div>

    <div class="p-5 mt-5 bg-dark-subtle text-dark-emphasis .bg-gradient">
        <section>
            <div class="card-group reveal">
                <div class="card">
                    <img class="child" src="..\img\univ1.jpg" class="card-img-top" alt="University campus" style="height: 500px;">
                </div>
                <div class="card">
                    <img class="child" src="..\img\univ2.jpg" class="card-img-top" alt="University library" style="height: 500px;">
                </div>
                <div class="card">
                    <img class="child" src="..\img\univ3.jpg" class="card-img-top" alt="University building" style="height: 500px;">
                </div>
            </div>
        </section>
    </div>

    <div class="text-white section-spacing">
        <div class="text-center pt-5 pb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.8315225947185!2d3.4645986765147962!3d36.75061487049185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e688cf8c7d965%3A0xafc21623adcb278b!2sQF28%2B6VV%2C%20Boumerdes!5e0!3m2!1sen!2sdz!4v1729593546649!5m2!1sen!2sdz" width="1200" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="University Location"></iframe>
        </div>
    </div>

    <h3 class="bg-dark bg-gradient text-light p-4 mb-0" id="Contact">Contact Us</h3>
    <div class="bg-dark text-light p-4 text-center">
        <div class="icons mb-3">
            <a href="" class="me-3">
                <i class="fab fa-google fa-2x text-light"></i>
            </a>
            <a href="" class="me-3">
                <i class="fab fa-facebook fa-2x text-light"></i>
            </a>
            <img class="fade-in ps-5 mt-3" src="..\img\16.webp" alt="University logo" style="width:300px; height:200px;">
        </div>

        <div class="mt-5">
            <p>Phone: 024 79 57 47 | Fax: 024 79 47 48</p>
        </div>
    </div>

    <?php include '../partials/sidebar.php'; ?>
    <?php include '../partials/footer.php'; ?>
</div>
</body>
</html>