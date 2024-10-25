
<?php 

include('dbh.inc.php'); 

?>  
<?php
//Our variable name for each member
   $name1 = "Joanne Bosogon";
   $name2 = "Monica Masangya";
   $name3 = "Danielle Celecio";
   $name4 = "Angel Cuevas";
   $name5 = "Reymark Malabarbas";
   $name6 = "John Karl Diaz";

   $joanne_image2 = "images/Joanne2.jpg";
   $monica_image2 = 'images/monica-img2.jpg';
   $danielle_image2 = 'images/dani-img2.jpg';
   $angel_image2 = 'images/angel1.jpg';
   $reymark_image2 = 'images/marky-img2.png';
   $karl_image2 = 'images/Karl2.jpg';

//Our php  associative array that contains another associative array inside it.
$profiles = [
    [
        'name' => $name1,   //Joanne
        'age' => 20,
        'birthday' => 'May 31, 2004',
        'birthplace' => 'San Antonio Northern Samar',
        'address' => 'Udings Coumpound Alabang, Muntinlupa City',
        'pronouns' => 'She/Her',
        'image' => $joanne_image2,
        'favorites' => [
            'images/hopya-removebg-preview.png',
            'images/ice-cream1-removebg-preview.png',
            'images/fries-removebg-preview.png'
        ]
    ],
    [
        'name' => $name2,    //Monica
        'age' => 20,
        'birthday' => 'December 7, 2003',
        'birthplace' => 'Malvar, Batangas Province',
        'address' => 'Tunasan, Muntinlupa',
        'pronouns' => 'She/Her',
        'image' => $monica_image2,
        'favorites' => [
            'images/chocolate-removebg-preview.png',
            'images/chicken-removebg-preview.png',
            'images/fries-removebg-preview.png'
        ]
    ],

    [
        'name' => $name3,   //Danielle
        'age' => 21,
        'birthday' => 'September 26, 2002',
        'birthplace' => 'Muntinlupa City',
        'address' => 'Poblacion, Muntinlupa City',
        'pronouns' => 'She/Her',
        'image' => $danielle_image2,
        'favorites' => [
            "images/ice-cream1-removebg-preview.png",
            "images/milktea2-removebg-preview.png",
            "images/coffee-removebg-preview.png"
        ]
    ],
    
    [
        'name' => $name4,     //Angel
        'age' => 20,
        'birthday' => 'October 13, 2003',
        'birthplace' => 'Malvar, Batangas Province',
        'address' => 'Tunasan, Muntinlupa City',
        'pronouns' => 'She/Her',
        'image' => $angel_image2,
        'favorites' => [
            "images/pizza-removebg-preview.png",
            "images/milktea2-removebg-preview.png",
            "images/fries-removebg-preview.png"
        ]
    ],

    [
        'name' => $name5,    //Reymark
        'age' => 21,
        'birthday' => 'June 2, 2003',
        'birthplace' => 'Almanza,Las Piñas City',
        'address' => 'Almanza Dos, Las Piñas City',
        'pronouns' => 'His/Him',
        'image' => $reymark_image2,
        'favorites' => [
            "images/pizza-removebg-preview.png",
            "images/chicken-removebg-preview.png",
            "images/coffee-removebg-preview.png"
        ]
    ],

    [
        'name' => $name6,       //John Karl
        'age' => 20,
        'birthday' => 'April 25, 2002',
        'birthplace' => 'Poblacion, Muntinlupa City',
        'address' => 'Poblacion Muntinlupa, City',
        'pronouns' => 'His/Him',
        'image' => $karl_image2,
        'favorites' => [
            "images/adobo-removebg-preview.png",
            "images/macaroni-removebg-preview.png",
            "images/fruit_salad-removebg-preview.png"
        ]
    ],
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Coffee Website</title>
    <link rel ="stylesheet" href = "ideaProfile.css">
    <link rel = "stylesheet"
    href = "https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
 
</head>
<body>
<style>
.error {color: #FF0000; font-size:12px}

.success {
    color: rgb(230, 85, 193);
    font-size: 12px;
    margin-top: 7px;
    display: flex; /* Make it a flex container */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically (optional) */
}
</style>
<header>


<?php 
session_start(); // Start the session at the beginning of the script

// Initialize error and notification variables
$usernameError = "";
$passwordError = "";
$notifySuccess = "";
$notifyError = "";
$loginNotify = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { 
   // $username = trim($_POST['username']);
   // $password = trim($_POST['password']);
   $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
   $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $rememberMe = isset($_POST['remember-me']); 
    

     // OUr a regular expression pattern for the username
     $usernamePattern = "/^[a-zA-Z0-9_]+$/";


    

    // Validate username
    if (empty($username) || strlen($username) < 3) {
        $usernameError = "Username must be at least 3 characters long.";
    }

   // Validate username format
   if (!filter_var($username, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $usernamePattern]])) {
    $usernameError = "Username can only contain letters, numbers, and underscores.";
}

    // Validate password
    if (empty($password) || strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters long.";
    }

   

    // If no validation errors
    if (empty($usernameError) && empty($passwordError)) {
        if ($rememberMe) {
            // If "Remember Me" is checked, store the username in a cookie
            setcookie("username", $username, time() + (7 * 24 * 60 * 60), "/");  //Username will be store for 7 days
        } else {
            // Otherwise, store the username in the session
            $_SESSION['username'] = $username;
        }
        $loginNotify = "Login successful!";
      

    }


    } elseif (isset($_POST['submitComment'])) { // Comment Form

       // $name = trim($_POST['name']);
       // $message = trim($_POST['message']);
       $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
       $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);


        // Validate comment fields
        if (empty($name) || strlen($name) < 2) {
            $notifyError = "Name must be at least 2 characters long.";
        } elseif (empty($message)) {
            $notifyError = "Message cannot be empty.";
        } else {
            // Prepare our SQL statement to insert into the connected database
            $stmt = $conn->prepare("INSERT INTO comments (author, message) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $message);

            // Execute the statement
            if ($stmt->execute()) {
                $notifySuccess = "Comment added successfully.";
            } else {
                $notifyError = "Failed to add comment.";
            }
            $stmt->close();
        }
    }

?>

<!-- Display the username or a fallback message -->
<a href="#" class="title">
    <h3>
    <?php
    // Only display the username if it exists in the session
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo htmlspecialchars($_SESSION['username']);
    } else {
        echo "personal.Details";
    }
    ?>
    </h3>
</a>



    
   <!-- <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#members">Members</a></li>
        <li><a href="#profile" id="show-profile">Profile</a></li>
        <li><a href="#others" id="show-others">Others</a></li>
        <li><a href="#rate" id="rate">Comment</a></li>
        <li><a href="#login" id="login">Login</a></li>
    </ul>-->
    <ul class="navbar">
    <li><a href="#home">Home</a></li>
    <li><a href="#members">Members</a></li>
    <li class="hidden" id="profile-link"><a href="#profile" id="show-profile">Profile</a></li>
    <li class="hidden" id="others-link"><a href="#others" id="show-others">Others</a></li>
    <li class="hidden" id="comment-link"><a href="#rate" id="rate">Comment</a></li>
    <li id="login-link"><a href="#login" id="login">Login</a></li>
    <li class="hidden" id="logout-link"><a href="connection_file/logout.php" id="login">Logout</a></li>  <!--When click this proceed to logout.php which in logout.php will just navigate back here but back to start where user need to login-->

   </ul>

    <div class="hamburger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</header>
<script>
    // PHP variable to check if the user is logged in
    var isLoggedIn = <?php echo isset($_SESSION['username']) && !empty($_SESSION['username']) ? 'true' : 'false'; ?>;

  
    if (isLoggedIn) {
        document.getElementById('profile-link').classList.remove('hidden');
        document.getElementById('others-link').classList.remove('hidden');
        document.getElementById('comment-link').classList.remove('hidden');
        document.getElementById('login-link').classList.add('hidden'); 
        document.getElementById('logout-link').classList.remove('hidden'); 

    } else {
        
    }
</script>

<!--Login structure starts here-->
<div class="popup" id="login-popup">
    <div class="close-btn">&times;</div>
    <div class="form">
        <h1>💗</h1>
        <h2>Hello, Friend!</h2>
        <p>Are you ready to know more about us? We can't wait also to know you. Please enter your name and let's get the party started.</p>
        
        <!-- Form starts here/POST METHOD-->
        <form action="ideaProfile.php" method="POST">
            <div class="form-element">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
                <span class="error"> <?php echo $usernameError;?></span>
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
                <span class="error"> <?php echo $passwordError;?></span>
            </div>
            <div class="form-element">
                <button type="submit" name="submit">Sign in</button>
                <span class="success"> <?php echo $loginNotify;?></span>
            </div>
            <div class="form-element">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <small>Don't have an account yet?<a href="profileSignUp.php">Create Account</a></small>
        </form>
        <!-- Form ends here -->
        <h2>˖⁺‧₊˚♡˚₊‧⁺˖♡︎˖⁺‧₊˚♡˚₊‧⁺˖</h2>
    </div>
</div>
<!--Login structure ends here-->







    <!--Our GET method-->
    <!--Comment structure starts here-->
<div class="popup-comment">
        <div class="close-button">&times;</div>
        <div class="form-comment">
            <h1 class="top">⎛⎝ ≽ > ⩊ < ≼ ⎠⎞</h1>
            <h2>Describe Us</h2>

    <form action="ideaProfile.php" method="POST">
        <div class="form-element-comment">
            <label for="name">Author</label>
            <input type="text" id="name" name="name" placeholder="Enter name" required>
        </div>
        <div class="form-element-comment">
            <label for="text">Comment</label>
            <textarea id="text" name="message" placeholder="Share your insight with us"></textarea>
            </div>
        <div class="form-element-comment">
            <button type="submit" name="submitComment">Post</button>
        </div>
        <small>See comments?<a href="urComment.php">Go to comments</a></small>
        <div class="notif" style="color:red; display:flex; justify-content:center; align-items:center; font-size:13px; margin-top:12px;">
        <p><?php echo $notifySuccess; ?></p>
        <p><?php echo $notifyError; ?></p>
        </div>

      
    </form>
        </div>
</div>


    
    <!--Home Structure starts here-->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Meet and Greet<br>us Juniors</h1>
            <p>Start your day by meeting us, your juniors with fresh faces, Group No. 6. Get to know us by exploring our personal backgrounds, hobbies, and favorites. Be inspired by our mottos and life beliefs, and discover the unique qualities that each of us brings to the table. From our passions to our aspirations, we invite you to delve into the stories that shape who we are</p>
        </div>
    </section>
   

    <!--Members design starts here-->
    <section class="members" id="members">
        <div class="heading">
            <h2>༘⋆🌷🫧💭₊˚ෆMembers༘⋆🌷🫧💭₊˚ෆ</h2>
        </div>
        <!--Container-->
        <div class="members-container"> <!--The products container is the whole container for the products-->
            <div class="box">
                <img src="images/Joanne1.jpg" alt="">
                <h3><?php echo $name1?></h3>
                <button type="button" id="show-container1">See Status</button>
            </div>
            <div class="box">
                <img src="images/IMG_20231206_224132_734.jpg" alt="">
                <h3><?php echo $name2?></h3>
                <button type="button" id="show-container2">See Status</button>
            </div>
            <div class="box">
                <img src="images/Snapchat-2134682068.jpg" alt="">
                <h3><?php echo $name3?></h3>
                <button type="button" id="show-container3">See Status</button>
            </div>
            <div class="box">
                <img src="images/angel2.jpg" alt="">
                <h3><?php echo $name4?></h3>
                <button type="button" id="show-container4">See Status</button>

            </div>
            <div class="box">
                <img src="images/marky1.jpeg" alt="">
                <h3><?php echo $name5?></h3>
                <button type="button" id="show-container5">See Status</button>

            </div>
            <div class="box">
                <img src="images/Karl1.jpeg" alt="">
                <h3><?php echo $name6?></h3>
                <button type="button" id="show-container6">See Status</button>

            </div>
        </div>
    </section>
    


    <!--Profile structure starts-->
    <section class="profile" id="profile">
        <div class="heading">
            <h2>ִֶָ⋆ ˚｡⋆୨🍓୧⋆ ˚｡⋆Profile Informationsִֶָ⋆ ˚｡⋆୨🍓୧⋆ ˚｡⋆</h2>
        </div>


        <div class="profile-container">
        <?php foreach ($profiles as $profile): ?>
            <div class="profile-item">
                <div class="profile-image">
                    <img src="<?php echo $profile['image']; ?>" alt="">
                </div>
                <div class="profile-info">
                    <h3>Name: <?php echo $profile['name']; ?></h3>
                    <h3>Age: <?php echo $profile['age']; ?> years old</h3>
                    <h3>Birthday: <?php echo $profile['birthday']; ?></h3>
                    <h3>Birthplace: <?php echo $profile['birthplace']; ?></h3>
                    <h3>Address: <?php echo $profile['address']; ?></h3>
                    <h3>Pronouns: <?php echo $profile['pronouns']; ?></h3>
                </div>
                <div class="box">
                    <h2>Favorites</h2>
                    <div class="favorites-images">
                        <?php foreach ($profile['favorites'] as $favorite): ?>
                            <img src="<?php echo $favorite; ?>" alt="Favorite Item">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
            
        </div>
    </section>

    <!--Profile structure ends-->
    
    <!--Others structure starts here-->
    <section class="others" id="others">

        <div class="heading">
            <h2>˗ˏˋ ★ ˎˊ˗Others (Beliefs&Motto)˗ˏˋ ★ ˎˊ˗</h2>
        </div>
        <div class="others-container">
            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $joanne_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>"Seize the Day."</h2>
                  <p>The phrase 'Seize the day' always reminds me that 'At least' is better than 'What if.' So, I always strive to do the things I want, but I keep in mind to do them with virtue and honor. I'm a nostalgic person, and I tend to reminisce about the past often. I don't want the past I remember to be full of regrets. I don't want to be burdened by regret or spend sleepless nights thinking about 'what if' scenarios. I want to live my life to the fullest, and those words are my mantra that help me truly live life to its fullest.</p>
                </div>
            </div>

            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $monica_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>"Embrace the struggles and pain, for they are the stepping <br>stones to growth and the path to your true strength."</h2>
                   <p>I've chosen this motto because I've learned that every struggle and pain I've faced has shaped who I am today. Each challenge has taught me resilience and strength, reminding me that growth comes from pushing through the hard times. I know that enduring these difficulties is what will lead me to become a stronger and better version of myself.</p>
                </div>
            </div>

            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $danielle_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>“If you never bleed you’re never gonna grow.”</h2>
                   <p>I've chosen this motto because it encourages me to take risks, face challenges, and push myself out of my comfort zones. It serves as a reminder that growth and success rarely come without obstacles and failure. it suggests that to truly make progress in life, one must be willing to take action and embrace the possibility of failure. It also reminds me that growth often involves difficult experiences, including emotional pain, which can ultimately lead to greater resilience and a more fulfilling life.</p>
                </div>
            </div>

            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $angel_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>"Embrace the journey, not just the destination."</h2>
                   <p>I've chosen this motto because this motto encourages us to focus on the experiences, lessons, and growth that happen along the way, rather than fixating solely on the end goal. Life is full of unexpected twists, challenges, and moments of joy that shape who we are. By embracing the journey, we learn to find meaning and fulfillment in the present, appreciating each step for what it brings. This mindset helps us stay resilient and open-minded, making the destination not just an achievement but a reflection of a rich and well-lived life.</p>
                </div>
            </div>

            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $reymark_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>"Time is gold."</h2>
                   <p>"Time is gold" is my favorite motto since it's a profound statement rather than just a simple one. And the reason I chose it is that 'time' is a very important aspect of life; it's like a valuable resource because our time here on Earth is limited. Additionally, as time passes by so quickly and each day is valuable, we should cherish all aspect of our lives, including our relationships, jobs, families, and education. for us to be able to create a happy memory out of it. Finally, that term teaches us something that will always be with us and cannot be taken away.</p>
                </div>
            </div>

            <div class="others-item">
                <div class="others-image">
                <img src="<?php echo $karl_image2; ?>" alt="">
                </div>
                <div class="others-info">
                   <h2>"Believe in your self" </h2>
                   <p>This word proves that you trust yourself and trust other people as well. Believe in yourself and before others believe you, overcome every challenge in life, never give up, fight what you have to fight for, the time will come when you and only you will benefit from the things in this world. If you're tired, take a break and don't let it stop you, we're not always at the bottom, all of that will be brought about by our efforts. We don't know where we are headed, and choose what makes you happy then what you are good at. Where is it comfortable that no matter where you are you can do it well and you won't panic.</p>
                </div>
            </div>

        </div>
    </section>
    

    <section>
        <!--Joanne-->
        <div class="container-details" id="joanne">
         <div class="info-image">
          <p>˗ˏˋ ★ ˎˊ˗ <img src="images/Joanne2.jpg" alt="Profile picture of Joanne Nofies Bosogon">˗ˏˋ ★ ˎˊ˗</p>
             <div class="info">
                    <h3 class="name"><?php echo $name1?></h3>
                    <h4 class="role">Project Leader</h4>
             </div>
             <div class="social-links">
                <a href="https://web.facebook.com/Senkuhh13/" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                <a href="http://www.linkedin.com/in/joan-bosogon-a6bba9320" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                <a href="#"><i class="bx bxl-instagram" target="_blank"></i></a>
                <a href="https://github.com/jj0a" target="_blank"><i class="bx bxl-github"></i></a>
            </div>
         </div>
            
          <div class="knowledge">
                <h3 class="status">Web Development Knowledge</h3>
                <div class="skill">
                    <h3 class="percent">HTML</h3><span class="bar-per" style="width: 80%;"></span>
                </div>
                <div class="skill">
                    <h3 class="percent">CSS</h3><span class="bar-per" style="width: 40%;"></span>
                </div>
                <div class="skill">
                    <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 30%;"></span>
                </div>
                <div class="skill">
                    <h3 class="percent">PHP</h3><span class="bar-per" style="width: 50%;"></span>
                </div>
            </div>
        </div>

        <!--Monica-->
        <div class="container-details" id="monica">
            <div class="info-image">
            <p>˗ˏˋ ★ ˎˊ˗ <img src="images/monica-img2.jpg" alt="Profile picture of Monica">˗ˏˋ ★ ˎˊ˗</p>
                <div class="info">
                      <h3 class="name"><?php echo $name2?></h3>
                       <h4 class="role">System Analyst</h4>
                </div>
                <div class="social-links">
                    <a href="https://web.facebook.com/monicamasangya.7/?_rdc=1&_rdr" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://www.linkedin.com/in/monica-masangya-b9489930b/" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://www.instagram.com/its_monica07/" target="_blank"><i class="bx bxl-instagram"></i></a>
                    <a href="https://github.com/Monica0717" target="_blank"><i class="bx bxl-github"></i></a>
               </div>
            </div>
               
             <div class="knowledge">
                   <h3 class="status">Web Development Knowledge</h3>
                   <div class="skill">
                       <h3 class="percent">HTML</h3><span class="bar-per" style="width: 80%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">CSS</h3><span class="bar-per" style="width: 40%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 20%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">PHP</h3><span class="bar-per" style="width: 50%;"></span>
                   </div>
               </div>
           </div>

           <!--Danielle-->
           <div class="container-details" id="danielle">
            <div class="info-image">
            <p>˗ˏˋ ★ ˎˊ˗ <img src="images/dani-img2.jpg" alt="Profile picture of Dani">˗ˏˋ ★ ˎˊ˗</p>
                <div class="info">
                       <h3 class="name"><?php echo $name3?></h3>
                       <h4 class="role">Web Designer</h4>
                </div>
                <div class="social-links">
                    <a href="https://www.facebook.com/daniellediocareza.celecio/" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://www.linkedin.com/in/danielle-lauren-celecio-539a29322/" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://www.instagram.com/daniiiluvie/?fbclid=IwY2xjawE-LkFleHRuA2FlbQIxMAABHZ7q2zlHrAXDqTpDC1VUvTk4txMZvbpQzi_EE-uXczr9ONa5VFwnbIxq1w_aem_8azNDoeJfYz9R3rEXDS73w" target="_blank"><i class="bx bxl-instagram"></i></a>
                    <a href="github.com/UrDaniiee" target="_blank"><i class="bx bxl-github" target="_blank"></i></a>
               </div>
            </div>
               
             <div class="knowledge">
                   <h3 class="status">Web Development Knowledge</h3>
                   <div class="skill">
                       <h3 class="percent">HTML</h3><span class="bar-per" style="width: 60%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">CSS</h3><span class="bar-per" style="width: 50%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 30%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">PHP</h3><span class="bar-per" style="width: 30%;"></span>
                   </div>
               </div>
           </div>

           <!--Angel-->
           <div class="container-details" id="angel">
            <div class="info-image">
            <p>˗ˏˋ ★ ˎˊ˗<img src="images/angel1.jpg" alt="Profile picture of Angel"> ˗ˏˋ ★ ˎˊ˗</p>
                <div class="info">
                      <h3 class="name"><?php echo $name4?></h3>
                       <h4 class="role">Front-End Developer</h4>
                </div>
                <div class="social-links">
                    <a href="https://web.facebook.com/cuenca.cuevas.3?mibextid=ZbWKwL&_rdc=1&_rdr" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://www.facebook.com/cuenca.cuevas.3?mibextid=ZbWKwL" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://www.instagram.com/_ig.yuri/?igsh=MWlidmdraHdqMDd0Zg%3D%3D" target="_blank"><i class="bx bxl-instagram"></i></a>
                    <a href="https://github.com/Angeeeeel13"><i class="bx bxl-github" target="_blank"></i></a>
               </div>
            </div>
               
             <div class="knowledge">
                   <h3 class="status">Web Development Knowledge</h3>
                   <div class="skill">
                       <h3 class="percent">HTML</h3><span class="bar-per" style="width: 50%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">CSS</h3><span class="bar-per" style="width: 20%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 30%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">PHP</h3><span class="bar-per" style="width:10%;"></span>
                   </div>
               </div>
           </div>

           <!--Reymark-->
           <div class="container-details " id="reymark">
            <div class="info-image">
            <p>˗ˏˋ ★ ˎˊ˗ <img src="images/marky-img2.png" alt="Profile picture of Reymark">˗ˏˋ ★ ˎˊ˗</p>
                <div class="info">
                       <h3 class="name"><?php echo $name5?></h3>
                       <h4 class="role">Content Creator Writer</h4>
                </div>
                <div class="social-links">
                    <a href="https://web.facebook.com/reymark.malabarbas.7?mibextid=ZbWKwL&_rdc=1&_rdr" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://www.linkedin.com/in/rey-mark-malabarbas-428930322?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://www.instagram.com/_eunoia.cuore/?igsh=MW0yYmZ6cWlwZ2N5Mg%3D%3D" target="_blank"><i class="bx bxl-instagram"></i></a>
                    <a href="https://github.com/malabarbasreymark02"><i class="bx bxl-github" target="_blank"></i></a>
               </div>
            </div>
               
             <div class="knowledge">
                   <h3 class="status">Web Development Knowledge</h3>
                   <div class="skill">
                       <h3 class="percent">HTML</h3><span class="bar-per" style="width: 80%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">CSS</h3><span class="bar-per" style="width: 40%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 30%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">PHP</h3><span class="bar-per" style="width: 50%;"></span>
                   </div>
               </div>
           </div>

           <!--Karl-->
           <div class="container-details" id="karl">
            <div class="info-image">
            <p>˗ˏˋ ★ ˎˊ˗<img src="images/Karl2.jpg" alt="Profile picture of Karl">˗ˏˋ ★ ˎˊ˗</p>
                <div class="info">
                        <h3 class="name"><?php echo $name6?></h3>
                       <h4 class="role">Back-End Developer</h4>
                </div>
                <div class="social-links">
                    <a href="https://web.facebook.com/Gliane9?mibextid=kFxxJD&_rdc=1&_rdr" target="_blank"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://www.linkedin.com/in/john-karl-diaz-282941322" target="_blank"><i class="bx bxl-linkedin-square"></i></a>
                    <a href="https://web.facebook.com/Gliane9?mibextid=kFxxJD&_rdc=1&_rdr" target="_blank"><i class="bx bxl-instagram"></i></a>
                    <a href="https://github.com/JohnKarl110"><i class="bx bxl-github" target="_blank"></i></a>
               </div>
            </div>
               
             <div class="knowledge">
                   <h3 class="status">Web Development Knowledge</h3>
                   <div class="skill">
                       <h3 class="percent">HTML</h3><span class="bar-per" style="width: 10%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">CSS</h3><span class="bar-per" style="width: 40%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">JavaScript</h3><span class="bar-per" style="width: 10%;"></span>
                   </div>
                   <div class="skill">
                       <h3 class="percent">PHP</h3><span class="bar-per" style="width: 50%;"></span>
                   </div>
               </div>
           </div>
    </section>

    <!--Our php include footer code here-->
    <?php 

    $currentPage = basename($_SERVER['SCRIPT_NAME']); // Get current page name

    if ($currentPage == 'ideaProfile.php') {
    include('footer.php'); // Include footer only on index.php
    } else {
    echo "Footer is not displayed on this page.";
    }
    ?>
    <script src="ideaProfile.js"></script>
    
</body>
</html>