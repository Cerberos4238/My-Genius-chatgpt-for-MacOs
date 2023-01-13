<?php

function chatgpt($search){

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"prompt\": \"$search\",
    \"model\": \"text-davinci-003\",
    \"max_tokens\": 1000,
    \"temperature\": 0
  }");

  curl_setopt($ch, CURLOPT_POST, 1);



  $headers = array();

  $headers[] = "Content-Type: application/json";

  $headers[] = "Authorization: Bearer [your API Key]";

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



  $result = curl_exec($ch);

  if (curl_errno($ch)) {

      echo 'Error:' . htmlentities(curl_error($ch));

  }

  curl_close($ch);


  $result = json_decode($result, true);

  $text = $result['choices'][0]['text'];
  $text = htmlentities($text);
    $text = str_replace("\n", "<br>", $text);
    
    //print_r($result);

  echo "<p class='txt'>".$text."<p>";

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">
<title>PHP chatgpt</title>
<meta name="viewport" content="width=device-width, initial-scale=0">

<link href="/css/login.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style type="text/css">
  
.txt{
  font-family: Poppins;
  text-align: left;
}
.centerdiv{
  justify-content: center;
  display: grid;
}

h1{
  font-family: Poppins;
  font-weight: 500;
  text-align: center;
  margin-top: 80px;
  margin-bottom: 50px;
}

textarea {
  background: #fff;
  box-shadow: 0 0 15px rgba(0,0,0,.25);
  border-radius: 10px;
  color: #111;
  border: 0;
  margin-bottom: 20px;
  height: 100px;
  width: 400px;
  margin-left: 50%;
  transform: translate(-50%);
  padding: 15px;
  font-family: Poppins;
  margin-top: 5px;
}
.btn {
  background: #ff0000;
  color: #ffff;
  font-family: Poppins;
  font-weight: 600;
  font-size: 20px;
  width: max-content;
  border-radius: 15px;
  padding: 5px 15px;
  margin-left: 50%;
  transform: translate(-50%);
  margin-top: 40px;
  cursor: pointer;
  margin-bottom: 20px;
}


</style>
</head>

<body>

<h1>

My Genius

</h1>

<form method="POST" action="">

<textarea name="search"><?= htmlspecialchars(isset($_POST['search']), ENT_QUOTES);?></textarea>

<button class="btn" type="submit">Valider</button>

</form>

<div class="centerdiv">
<?php

if(isset($_POST['search']) && !empty($_POST['search'])){
  chatgpt($_POST['search']);
}
?>
</div>
  

</html>
