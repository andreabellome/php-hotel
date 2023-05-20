<!-- start: PHP -->
<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    /* start: define the minimum vote for the Hotel */
    $minStars = $_GET['votoHotel'];
    if ($minStars == null){
        $minStars = 0;
    }
    /* end: define the minimum vote for the Hotel */
    
    /* start: show hotel parking */
    $showHotelParking = $_GET['showHotelPark'];
    if ( $showHotelParking == null ) {
        $showHotelParking = 'tutti';
    };
    /* end: show hotel parking */

?>
<!-- end: PHP -->

<!-- start: HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- media query -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- title -->
    <title>Hotels</title>
</head>
<body>
    

    <!-- title of the page -->
    <h1 class="text-center mb-5">Hotel</h1>

    <!-- start: include form with conditions -->
    <div class="container mb-3">

        <form action="index.php" method="GET">

            <!-- start: form minimum vote -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Inserire il minimo voto dell'hotel (es. 2)" aria-label="Example text with button addon" aria-describedby="button-addon1" name="votoHotel">
            </div>
            <!-- end: form minimum vote -->

            <!-- start: form parking -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Parcheggio? Inserire 'si' o 'no'" aria-label="Example text with button addon" aria-describedby="button-addon1" name="showHotelPark">
            </div>
            <!-- end: form parking -->

            <button class="btn btn-outline-secondary mt-3" type="submit" id="button-addon2">Invio</button>
            <button class="btn btn-outline-secondary mt-3" type="submit" id="button-addon2">Reset</button>

        </form>

    </div>
    <!-- end: include form with conditions -->

    <div class="container mb-3" style="border: 1px solid black;">

        <h5>Filtri: </h5>
        Vuoi l'hotel con il parcheggio? <?php echo $showHotelParking ?>
        <br>

        Voto minimo dell'Hotel: <?php echo $minStars ?>

    </div>

    <!-- start: table -->
    <div class="container" style="border: 1px solid black;">
        
        <h5>Risultati: </h5>

        <table class="table">

            <thead>
                <tr>
                    <th scope="col" class="text-center" style=" width: calc(100% / 4);">Nome</th>
                    <th scope="col" class="text-center" style=" width: calc(100% / 4);">Parcheggio</th>
                    <th scope="col" class="text-center" style=" width: calc(100% / 4);">Voto</th>
                    <th scope="col" class="text-center" style=" width: calc(100% / 4);">Distanza dal centro (km)</th>
                </tr>
            </thead>

            <tbody>

                <?php

                    foreach ($hotels as $hotel){

                        if ( $hotel['vote'] >= $minStars ) { /* filtra per voto minimo */
                        
                            if ( $showHotelParking == 'tutti' ) { /* mostrali tutti */

                                echo "<tr>" .
                                        "<th scope='row' class='text-center'>". $hotel['name'] . "</th>" . 
                                        "<td class='text-center'>". ($hotel['parking'] ? "<i class='fa-solid fa-check'></i>" : "<i class='fa-solid fa-xmark'></i>") . "</td>" .
                                        "<td class='text-center'>". $hotel['vote'] . "</td>" .
                                        "<td class='text-center'>". $hotel['distance_to_center'] . "</td>" . 
                                    "</tr>";

                            } elseif ( $showHotelParking == 'si' ) { /* mostra solo quelli che hanno il parcheggio */
                                echo "<tr" . ' ' . ( ($hotel['parking'] == false) ? "style='display: none;'" : "" ) . ">" .
                                        "<th scope='row' class='text-center'>". $hotel['name'] . "</th>" . 
                                        "<td class='text-center'>". ($hotel['parking'] ? "<i class='fa-solid fa-check'></i>" : "<i class='fa-solid fa-xmark'></i>") . "</td>" .
                                        "<td class='text-center'>". $hotel['vote'] . "</td>" .
                                        "<td class='text-center'>". $hotel['distance_to_center'] . "</td>" . 
                                    "</tr>";
                            } elseif ( $showHotelParking == 'no' ) { /* mostra solo quelli senza parcheggio */
                                echo "<tr" . ' ' . ( ($hotel['parking'] == true) ? "style='display: none;'" : "" ) . ">" .
                                        "<th scope='row' class='text-center'>". $hotel['name'] . "</th>" . 
                                        "<td class='text-center'>". ($hotel['parking'] ? "<i class='fa-solid fa-check'></i>" : "<i class='fa-solid fa-xmark'></i>") . "</td>" .
                                        "<td class='text-center'>". $hotel['vote'] . "</td>" .
                                        "<td class='text-center'>". $hotel['distance_to_center'] . "</td>" . 
                                    "</tr>";

                            };

                        }

                    }

                ?>

            </tbody>
            
        </table>
        <!-- end: table -->

    </div>

    

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>
<!-- end: HTML -->
