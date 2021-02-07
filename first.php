<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="firstTwo.php?a=submit" name=test>
  <input name="namn" type="text" placeholder="Namn"></br><br/>
    <textarea placeholder="meddelande..." name="meddelande"></textarea></br><br/>
    <label for="color">Favoritfärg:</label><br/>
    <input type="radio" name="color" value="röd">Röd</br>
    <input type="radio" name="color" value="grön">Grön</br>
    <input type="radio" name="color" value="blå">Blå</br><br/>
    <label for="jag_är[]">Jag är:</label><br/>
    <input type="checkbox" name="jag_är[]" value="glad">Glad<br/>
    <input type="checkbox" name="jag_är[]" value="hungrig">Hungrig<br/><br/>

<label for="fav_bil">Faboritbil?</label><br/>
    <select name="fav_bil">
  <option value="Volvo">Volvo</option>
  <option value="Mercedes">Mercedes</option>
  <option value="Audi">Audi</option><br/><br/>

    <input type="submit" value ="Kör"/>
    </form>


    
</body>
</html>