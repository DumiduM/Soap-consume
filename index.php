<?php
session_start();

$url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
$client = new SoapClient($url);

// $fcs = $client->__getFunctions();
// $types = $client->__getTypes();
// var_dump($fcs);
// var_dump($types);

$CountryPhone = "null";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Country Details</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<script>
	function var setPath(name1) {
	    var str = "https://www.google.lk/maps/place/"+name1; 
	    var res = str.replace(" ", "");
	     return str;
	}
	</script>
</head>
<body>
	<div class="container">
		<div>
		<h1>Country Details</h1><br>
		<form class="form-inline" action="" method="post">
		    <div class="form-group">
		      <label for="name">Country Name: </label>
		      <input type="text" class="form-control" id="email" placeholder="Enter country name" name="cName" style="margin-right: 12px;">
		    </div>
		   
		    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  		</form>
  		</div>
  		<div>
<!--   			<form>
  				<div class="form-group">
  					<label for="name">ISO Code: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>

  				<div class="form-group">
  					<label for="name">Name: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>
  				
  				<div class="form-group">
  					<label for="name">Capital City: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>

  				<div class="form-group">
  					<label for="name">Phone Code: </label>
  					<input type="text" class="form-control" value="<?php echo $_SESSION["conPhone"]; ?>" id="conPhone" name="cName" style="margin-right: 12px;">
  				</div>

  				<div class="form-group">
  					<label for="name">Continect Code: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>

  				<div class="form-group">
  					<label for="name">Currency: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>

				<div class="form-group">
  					<label for="name">Language: </label>
  					<input type="text" class="form-control" id="email" name="cName" style="margin-right: 12px;">
  				</div>
  			</form> -->
  		</div>


  		<?php 
  		if(isset($_POST['submit'])){
        
  			
  			if (!empty($_POST['cName'])){
              $countryName = $_POST['cName'];
         	  
              $CountryISOCode = $client -> CountryISOCode(array('sCountryName' => "$countryName"));
              $CountryCode = $CountryISOCode-> CountryISOCodeResult;


     //     	  $CountryIntPhoneCode = $client -> CountryIntPhoneCode(array('sCountryISOCode' => "$CountryCode"));
			  // $CountryPhone = $CountryIntPhoneCode-> CountryIntPhoneCodeResult;


			  // $CountryIntPhoneCode = $client -> CountryIntPhoneCode(array('sCountryISOCode' => "$CountryCode"));
			  // $CountryPhone = $CountryIntPhoneCode-> CountryIntPhoneCodeResult;

			  $CountryInfo = $client -> FullCountryInfo(array('sCountryISOCode' => "$CountryCode"));
			  $ConCode = $CountryInfo-> FullCountryInfoResult->sISOCode;
			  $ConName = $CountryInfo-> FullCountryInfoResult->sName;
			  $ConCity = $CountryInfo-> FullCountryInfoResult->sCapitalCity;
			  $ConPhone = $CountryInfo-> FullCountryInfoResult->sPhoneCode;
			  $ConCont = $CountryInfo-> FullCountryInfoResult->sContinentCode;
			  $ConCurr = $CountryInfo-> FullCountryInfoResult->sCurrencyISOCode;
			  $ConFlag = $CountryInfo-> FullCountryInfoResult->sCountryFlag;
			  $ConLang = $CountryInfo-> FullCountryInfoResult->Languages->tLanguage->sISOCode;
			  $ConLangName = $CountryInfo-> FullCountryInfoResult->Languages->tLanguage->sName;

			  $CountrycurrNa = $client -> CountryCurrency(array('sCountryISOCode' => "$ConCurr"));
			  $ConCurrName = $CountrycurrNa-> CountryCurrencyResult->sName;

			  $CountrycurrNa = $client -> CountryCurrency(array('sCountryISOCode' => "$ConCurr"));
			  $ConCurrName = $CountrycurrNa-> CountryCurrencyResult->sName;

			  
			 //  	echo "$ConCode";
				// echo "$ConName"; 
				// echo "$ConCity";
				// echo "$ConPhone";
				// echo "$ConCont";
				// echo "$ConCurr";
				// echo "$ConCurrName";
				// echo "$ConLang";
				// echo "$ConLangName";
	
			  
			  
			}
          	else
          		echo "no data added";
  		?>

  		<div>
  			<br>
  			<img src="<?php echo "$ConFlag"; ?>"><br><br>
  			<h5><strong>ISO Code :</strong> <?php echo "$ConCode"; ?></h5>
  			<h5><strong>Name :</strong> <?php echo "$ConName"; ?></h5> 
  			<h5><strong>Capital City :</strong> <?php echo "$ConCity"; ?></h5> 
  			<h5><strong>Phone Code :</strong> <?php echo "$ConPhone"; ?></h5> 
  			<h5><strong>Continent Code :</strong> <?php echo "$ConCont"; ?></h5> 
  			<h5><strong>Currency ISO Code :</strong> <?php echo "$ConCurr"; ?></h5>
  			<h5><strong>Currency Name :</strong> <?php echo "$ConCurrName"; ?></h5> 
  			<h5><strong>Language ISO Code :</strong> <?php echo "$ConLang"; ?></h5> 
  			<h5><strong>Language Name :</strong> <?php echo "$ConLangName"; ?></h5>
  			<script>setPath("<?php echo"$ConName";?>");</script>


  		</div>
<?php
      }

  
      ?>


  		<style>
  			strong{
  				color: red;
  			}
  		</style>
	</div>

</body>
</html>