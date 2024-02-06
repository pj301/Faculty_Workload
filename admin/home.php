<?php include 'db_connect.php' ?>
<style>
 span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    color: #ffffff96;
}

.imgs {
    margin: .5em;
    max-width: calc(100%);
    max-height: calc(100%);
}

.imgs img {
    max-width: calc(100%);
    max-height: calc(100%);
    cursor: pointer;
}

#imagesCarousel,
#imagesCarousel .carousel-inner,
#imagesCarousel .carousel-item {
    height: 60vh !important;
    background: black;
}

#imagesCarousel .carousel-item.active {
    display: flex !important;
}

#imagesCarousel .carousel-item-next {
    display: flex !important;
}

#imagesCarousel .carousel-item img {
    margin: auto;
}

#imagesCarousel img {
    width: auto !important;
    height: auto !important;
    max-height: calc(100%) !important;
    max-width: calc(100%) !important;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

.container {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.body-container {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-left: 30px;
}

.left-container {
    width: 120%; /* Updated to 200% */
   /* transform: translateX(-400px); */
     transform: translateX(-50px); 
 
}

.right-container {
  background:#213440 !important;
  border: 2px solid;
  /* transform: translateX(370px); */
   transform: translateX(70px);
    background-color: #f2f2f2;
    /* width: 160%; */
    width: 100%;
    height: 100%;
    /* margin-top: 80px; */
  margin-top: 15px;

}

/* Rest of your styles remain unchanged */

/* Rest of your styles remain unchanged */

/* Style the individual sections */
.facultyloadTable-container,
.subjectTable-container,
.collegeTable-container {
  background: #f2f2f2; /* Add background color as needed */
  border: 1px solid #ddd; /* Add border as needed */
  padding: 10px;
  margin-bottom: 10px;
  box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

/*CARDS CONTAINER HERE*/
/* Add this CSS to your existing styles or create a new CSS file */
.cards-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 40px; /* Set the desired space between cards */
   max-width: 100%;
   padding-top: 30px;
  margin-left: 30px;
  transition: margin-left 0.5s ease; /* Add smooth transition */
}

/* ... Other styles ... */

.Card a {
  text-decoration: none;
  color: inherit; /* This inherits the color from the parent, adjust as needed */
}

.Card {
  width: 180px;
  height: 200px; /* Set the height for a box size */
  background-color: rgba(52, 152, 219, 0.7); /* Transparent blue color, adjust as needed */
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
  padding: 20px;
  margin-top: 20px;
  transition: transform 0.3s ease-in-out;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}



    .Card:hover {
      transform: scale(1.05);
    }

    .Category {
      font-size: 18px;
      margin-top: 10px;
    }

    .Card img {
      width: 50px;
      height: 50px;
      padding: 10px;
    }



/* Customize the styles based on your design preferences */
.Card:nth-child(1) {
  background-color: #d0db34bb; /* Transparent blue color for the first card */
  color: #ffffff; /* Set the text color for the first card */
}
.Card:nth-child(1) img {
  width: 70px;
  height: 70px;
  color: #ffffff; /* Set the text color for the first card */
  background-color: #f0ec00; /* Your background color */
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
}


.Card:nth-child(2) {
  background-color: #e74d3ca4; /* Transparent red color for the second card */
  color: #ffffff; /* Set the text color for the second card */
}
.Card:nth-child(2) img {
  width: 70px;
  height: 70px;
  color: #ffffff; /* Set the text color for the first card */
  background-color: #f00000; /* Your background color */
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
}

.Card:nth-child(3) {
  background-color: #0ff15394; /* Transparent green color for the third card */
  color: #ffffff; /* Set the text color for the third card */
}
.Card:nth-child(3) img {
  width: 70px;
  height: 70px;
  color: #ffffff; /* Set the text color for the first card */
  background-color: #00f020; /* Your background color */
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
}

/* Example icon styles (replace with your own icons) */
.Card:nth-child(1)::before {
  font-size: 40px;
  background-color: darkblue;
}

.Card:nth-child(2)::before {
  font-size: 40px;
  background-color: red;
}
.Card:nth-child(3)::before {
  font-size: 40px;
  background-color: orange; /* Adjust background color as needed */
}


/*END OF CARDS CONTAINER HERE*/

/* TABLES CONTAINER HERE */
.subjectTable-container {
  height: 50vh;
  background-color: gray;
  display: grid;
  grid-template-columns: 1fr;
  margin-top: 40px;
  transition: max-width 0.5s ease; /* Add smooth transition */


}

.collegeTable-container {
  height: 50vh;
  background-color: gray;
  display: grid;
  grid-template-columns: 1fr;
  margin-top: 40px;
  transition: max-width 0.5s ease; /* Add smooth transition */

  /* Center the container within the left-container */

}

.facultyloadTable-container {
  height: 50vh;
  background-color: gray;
  display: grid;
  grid-template-columns: 1fr;
  margin-top: 40px;
  transition: max-width 0.5s ease; /* Add smooth transition */

}

/* Add this CSS to your stylesheet or in a <style> tag in your HTML */
.swiper-button-next, .swiper-button-prev {
    
    position: absolute;
      top: 30%;
      transform: translateY(50%);
      font-size: 24px;
      color: white;
      cursor: pointer;
      z-index: 3; /* Place the arrow buttons above the overlay text container */
}

.swiper-button-next {
    right: 10px; /* Adjust the right distance as needed */
}

.swiper-button-prev {
    left: 10px; /* Adjust the left distance as needed */
}
  /* Style the container */
  .slider-container {
  position: relative;
  width: 100%;
  height: 20vh;
  margin-left: 0 auto; /* Adjust margin as needed */
  overflow: hidden;
}

.image-container {
  display: flex;
  margin-left: 0; /* Adjust margin as needed */
  transition: transform 0.5s ease-in-out;
}


    /* Style the image */
    .image-container img {
      width: 150px;
      height: 50%;
      display: block;
    }

    /* Style the overlay text container */
    .overlay-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      z-index: 2; /* Place the overlay text container above the image container */
    }
    .summary_icon {
  color: #00f020;
  font-size: 25px;
  font-weight: bold;
  border: 2px solid #00f020; /* Border color */
  border-radius: 50%; /* Make it circular */
  padding: 5px; /* Adjust padding for spacing */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a shadow effect for a 3D look */
}
 
</style>
<style>
    /* Your existing styles */

    /* Media query for small screens */
    @media (max-width: 576px) {
        .cards-container {
            grid-template-columns: 1fr; /* Change to a single column layout for small screens */
            gap: 20px; /* Adjust the gap as needed */
        }

        .Card {
            width: 100%; /* Make each card take the full width */
        }
    }

    /* Media query for medium screens */
    @media (min-width: 577px) and (max-width: 992px) {
        .cards-container {
            grid-template-columns: repeat(2, 1fr); /* Change to a two-column layout for medium screens */
            gap: 30px; /* Adjust the gap as needed */
        }

        .Card {
            width: calc(50% - 15px); /* Adjust the width and margin as needed */
        }
    }

    /* Media query for large screens */
    @media (min-width: 1000x) {
        .cards-container {
            grid-template-columns: repeat(3, 1fr); /* Keep the three-column layout for large screens */
            gap: 40px; /* Adjust the gap as needed */
        }

        .Card {
            width: calc(100%); /* Adjust the width and margin as needed */
        }
    }
     


/* Adjust content width when the sidebar is collapsed */
/* Adjust content width when the sidebar is collapsed */
#view-panel.collapsed {
  margin-left: 90px;
  transition: margin-left 0.3s ease; /* Add transition for smooth width change */
  width: 100%;
}

/* Adjust content width when the sidebar is collapsed */
#sidebar.collapsed{

    transition: margin-left 0.3s ease; /* Add transition for smooth width change */
    width: 5% !important;
}



</style>

<div class="container">
        <div class="left-container">
            <div class="container-fluid">
                <div class="row mt-3 ml-3 mr-3">
                    <div class="col-lg-12">

                        <!-- Your existing left container content goes here -->

                        <!-- Slider Container -->
                        <div class="slider-container">
                            <!-- ... Your slider content ... -->
                            <div class="overlay-container">Welcome back <?php echo $_SESSION['login_name']; ?>!</div>
                        <div class="image-container">
                        <img src="../admin/assets/img/image3.jpg" alt="Slide 3"style="width: 150%;">
                            <img src="../admin/assets/img/image3.jpg" alt="Slide 3"style="width: 150%;">
                            <img src="../admin/assets/img/image3.jpg" alt="Slide 3"style="width: 150%;">
                          
                        </div>
                        <div class="swiper-button-next">&rarr;</div>
                        <div class="swiper-button-prev">&larr;</div>
                        </div>

                        <!-- Cards Container -->
                        <div class="cards-container">
                            <!-- ... Your card content ... -->
                            <div class="Card">
                            <a href="">
                                <img src="../admin/assets/images/menu-unscreen.gif" alt="">
                                <div class="Category">TOTAL SUBJECT</div>
                            </a>
                        </div>
                        <div class="Card">
                            <a href="">
                                <img src="../admin/assets/images/mortarboard-unscreen.gif" alt="">
                                <div class="Category">TOTAL COLLEGE</div>
                            </a>
                        </div>
                        <?php
                        // Function to get the total number of rooms
                        function getTotalRooms() {
                            global $conn; // Assuming $conn is your database connection variable

                            // Query to get the count of rooms from the 'roomlist' table
                            $query = "SELECT COUNT(*) as total_rooms FROM room";

                            // Execute the query
                            $result = mysqli_query($conn, $query);

                            // Check if the query was successful
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                return $row['total_rooms'];
                            } else {
                                return "Error fetching total rooms: " . mysqli_error($conn);
                            }
                        }

                        // Call the function to get the total number of rooms
                        $totalRooms = getTotalRooms();
                        ?>
                        <div class="Card">
                            <a href="#">
                                <img src="../admin/assets/images/school-unscreen.gif" alt="">
                                <div class="Category">TOTAL ROOM</div>
                                <span class="float-center summary_icon"><?php echo $totalRooms; ?></span>
                            </a>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Body Container -->
            <div class="body-container">
                <div class="facultyloadTable-container">
                    <a>FACULTY WORKLOAD HERE</a>
                </div>
                <div class="subjectTable-container">
                    <a>SUBJECT TABLE HERE</a>
                </div>
                <div class="collegeTable-container">
                    <a>COLLEGE TABLE HERE</a>
                </div>
            </div>
        </div>

        <!-- Right Container -->
        <div class="right-container">
            <!-- Additional content for the right container goes here -->
        </div>

    </div>



<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>

<script>
    // JavaScript code for sliding the images
    var imageContainer = document.querySelector('.image-container');
    var imageWidth = document.querySelector('.image-container img').clientWidth;
    var currentIndex = 0;

    function slideImages(direction) {
      if (direction === 'next') {
        currentIndex = (currentIndex + 1) % imageContainer.children.length;
      } else if (direction === 'prev') {
        currentIndex = (currentIndex - 1 + imageContainer.children.length) % imageContainer.children.length;
      }

      var translateValue = -currentIndex * imageWidth + 'px';
      imageContainer.style.transform = 'translateX(' + translateValue + ')';
    }

    setInterval(function () {
      slideImages('next');
    }, 3000); // Adjust the interval as needed (in milliseconds)

    // Add click event listeners to arrow buttons
    document.querySelector('.swiper-button-next').addEventListener('click', function () {
      slideImages('next');
    });

    document.querySelector('.swiper-button-prev').addEventListener('click', function () {
      slideImages('prev');
    });
  </script>
