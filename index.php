<?php
require_once('getimages.php');
$latest_menu = get_images('menus', true);
$menu_date = date_from_filename($latest_menu);
$gallery = get_images('gallery');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Social share meta tags -->
  <meta property="og:title" content="The Kitchen Treasury">
  <meta property="og:description" content="Cosy cafe with homemade seasonal meals in the heart of Kirkcaldy">
  <meta property="og:type" content="website">
  <meta property="og:image" content="img/foodpic.jpg">
  <meta property="og:site_name" content="The Kitchen Treasury">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="The Kitchen Treasury">
  <meta name="twitter:description" content="Cosy cafe with homemade seasonal meals in the heart of Kirkcaldy">
  <meta name="twitter:image:src" content="img/foodpic.jpg">
  <!-- End social share meta tags -->
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/kt.css">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <title>The Kitchen Treasury</title>
  <meta name="description" content="Cosy cafe with homemade seasonal meals in the heart of Kirkcaldy">
</head>
<body>
  <header>
    <h1><img src="img/kt2.png" alt="The Kitchen Treasury" /></h1>
    <section id="address">
        <p>34 Hunter Street, Kirkcaldy</p>
    </section>
    <section id="hours">
      <h3>Opening times</h3>
      <table>
          <tr><td>Monday:</td><td>closed</td></tr>
          <tr><td>Tuesday:</td><td>10am - 4pm</td></tr>
          <tr><td>Wednesday:</td><td>10am - 4pm</td></tr>
          <tr><td>Thursday:</td><td>10am - 4pm</td></tr>
          <tr><td>Friday:</td><td>10am - 4pm</td></tr>
          <tr><td>Saturday:</td><td>10am - 4pm</td></tr>
          <tr><td>Sunday:</td><td>closed</td></tr>
      </table>
    </section>
  </header>
  <main>
    <section id="intro">
      <p>
Breakfast, lunch, snacks and cakes
      </p>
      <p>
Everything made from scratch
      </p>
      <p>
Local, seasonal ingredients
      </p>
      <p>
Vegan & gluten-free options
      </p>
    </section>
    <section id="picture">
      <img src="img/foodpic.jpg" alt="A green mug containing a foamy latte, on a wooden table in a cosy cafe" />
    </section>

    <section id="menu">
        <h3>Current Menu</h3>
        <img src="<?=$latest_menu?>" />
        <p class="wee"><em>Updated: <?=$menu_date?></em></p>
    </section>

  </main>
  <aside id="gallery">
    <?foreach($gallery as $image):?>
<img src="<?=$image?>" alt="Homemade food from The Kitchen Treasury" />
    <?endforeach?>
  </aside>
  <footer>
    <section id="contact">
      <h3>Contact</h3>
      <p>
You can find us at <strong>34 Hunter Street, Kirkcaldy,</strong> Fife, Scotland. We're right by Kirkcaldy bus station and the High Street, and a short walk from Kirkcaldy train station.</p>
      </p>
      <p>
If you would like to book our homely cafe for a special event, or if you would like us to provide catering for you, please get in touch.
      </p>
    </section>
    <ul>
      <li><a href="tel:+447523 178969"><img src="img/icon_phone.png" alt="Tel:" /> 07523 178969</a></li>
      <li><a href="mailto:hello@kitchentreasury.com"><img src="img/icon_email.png" alt="Email:" /> hello@kitchentreasury.com</a></li>
      <li><a href="https://www.facebook.com/people/The-Kitchen-Treasury/61554324862777/"><img src="img/icon_fb.png" alt="Facebook:" /> The-Kitchen-Treasury</a></li>
    </ul>
    <section id="map">
      <a href="geo:56.117064,-3.159086" id="noscript"><img src="img/map.png" alt="A map of Kirkcaldy with a marker at The Kitchen Treasury's location on Hunter Street" /></a>
      <div id="themap" style="display:none"></div>
    </section>
  </footer>
  <script>
    document.getElementById("themap").style.display = "block";
    document.getElementById("noscript").style.display = "none";
  </script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script>
    var layer = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors"
    });
    var map = new L.Map("themap", {
        center: new L.LatLng(56.110784, -3.161048),
        zoom: 14
    });
    map.addLayer(layer);

    var marker = new L.Marker([56.110784, -3.161048]).addTo(map);
    var popup = L.popup();
    marker.bindPopup("<a href=\"geo:56.110784, -3.161048\">The Kitchen Treasury, 34 Hunter Street, Kirkcaldy</a>")

  </script>
</body>
</html>
